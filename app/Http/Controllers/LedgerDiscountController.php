<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Utils\Util;
use App\Contact;
use App\ContactLedger;
use App\Account;
use App\AccountType;

class LedgerDiscountController extends Controller
{
    protected $commonUtil;

    /**
     * Constructor
     *
     * @param Util $commonUtil
     * @return void
     */
    public function __construct(
        Util $commonUtil
    ) {
        $this->commonUtil = $commonUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $business_id = $request->session()->get('user.business_id');
            $input = $request->only(['date', 'amount', 'note', 'contact_id','account_type','account_sub_type','discount_account']);

            $contact = Contact::find($input['contact_id']);

            $sub_type = 'sell_discount';
            $ledger_type = 'credit';
            $account = Account::find($input['discount_account']);
            if ($contact->type == 'customer') {
                $sub_type = 'sell_discount';
                if($account->name !='Accounts Receivable'){
                    $ledger_type = 'debit';
                }
            } else if ($contact->type == 'supplier') {
                $sub_type = 'purchase_discount';
                if($account->name =='Accounts Payable'){
                    $ledger_type = 'debit';
                }
            } else {
                $sub_type = $request->input('sub_type');
            }
            $transaction_data = [
                'business_id' => $business_id,
                'final_total' => $this->commonUtil->num_uf($input['amount']),
                'total_before_tax' => $this->commonUtil->num_uf($input['amount']),
                'status' => 'final',
                'type' => 'ledger_discount',
                'sub_type' => $sub_type,
                'contact_id' => $input['contact_id'],
                'created_by' => auth()->user()->id,
                'additional_notes' => $input['note'],
                'transaction_date' => $this->commonUtil->uf_date($input['date'], true),
                'acc_type_id' => $input['account_type'],
                'acc_sub_type_id' => $input['account_sub_type'],
                'discount_acc_id' => $input['discount_account']
            ];

            $transaction = Transaction::create($transaction_data);
            #identify ledger type 
          
            $this->createContactLedger($transaction, $ledger_type);
            
            $output = ['success' => true, 'msg' => __('lang_v1.success')];

        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => 0,
                            'msg' => __('messages.something_went_wrong')
                        ];
        }

        return $output;  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $business_id = request()->session()->get('user.business_id');
        $is_admin = $this->commonUtil->is_admin(auth()->user(),$business_id);

        if (!$is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');
        
        $discount = Transaction::where('business_id', $business_id)
                    ->where('type', 'ledger_discount')
                    ->find($id);

        $contact = Contact::find($discount->contact_id);
        $account_types = AccountType::where('business_id', $business_id)->whereNull('parent_account_type_id')->pluck('name','id');
        $account_sub_types = AccountType::where('business_id', $business_id)
                            ->where('parent_account_type_id', $contact->acc_type_id)
                            ->pluck('name','id');
        $discount_accounts = Account::whereNull('deleted_at')
                        ->where('disabled',0)
                        ->pluck('name','id');

        return view('ledger_discount.edit')->with(compact('discount', 'contact','account_types','account_sub_types','discount_accounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      
        try {
            $business_id = $request->session()->get('user.business_id');
            $input = $request->only(['date', 'amount', 'note', 'contact_id','account_type','account_sub_type','discount_account']);
            $contact = Contact::find($input['contact_id']);
            $ledger_type = 'credit';
            $account = Account::find($input['discount_account']);
            if ($contact->type == 'customer') {
                if($account->name !='Accounts Receivable'){
                    $ledger_type = 'debit';
                }
            } else if ($contact->type == 'supplier') {
                if($account->name =='Accounts Payable'){
                    $ledger_type = 'debit';
                }
            } 

            $transaction_data = [
                'business_id' => $business_id,
                'final_total' => $this->commonUtil->num_uf($input['amount']),
                'total_before_tax' => $this->commonUtil->num_uf($input['amount']),
                'additional_notes' => $input['note'],
                'transaction_date' => $this->commonUtil->uf_date($input['date'], true),
                'acc_type_id' => $input['account_type'],
                'acc_sub_type_id' => $input['account_sub_type'],
                'discount_acc_id' => $input['discount_account']
            ];
            $contact_ledger_data = [
                'type' => $ledger_type,
                'amount' => $this->commonUtil->num_uf($input['amount']),
                'operation_date' => $this->commonUtil->uf_date($input['date'], true)
            ];
            if ($request->has('sub_type')) {
                $transaction_data['sub_type'] = $request->input('sub_type');
            }
            Transaction::where('business_id', $business_id)
                    ->where('type', 'ledger_discount')
                    ->where('id', $id)
                    ->update($transaction_data);

            ContactLedger::where('transaction_id', $id)
            ->update($contact_ledger_data);        
            
            $output = ['success' => true, 'msg' => __('lang_v1.success')];

        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => 0,
                            'msg' => __('messages.something_went_wrong')
                        ];
        }

        return $output;  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $business_id = request()->session()->get('user.business_id');
        $is_admin = $this->commonUtil->is_admin(auth()->user(),$business_id);

        if (!$is_admin) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = request()->session()->get('user.business_id');
        
        try {
            #delete from transaction
            Transaction::where('business_id', $business_id)
                    ->where('type', 'ledger_discount')
                    ->where('id', $id)
                    ->delete();
                    #delete from contact ledger
            ContactLedger::where('transaction_id', $id)
                    ->delete();        

            
            $output = ['success' => true, 'msg' => __('lang_v1.success')];

        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());
            
            $output = ['success' => 0,
                            'msg' => "File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage()
                        ];
        }

        return $output;
    }
    public function createContactLedger($transaction, $type)
    {
        $account_transaction_data = [
            'contact_id' => !empty($transaction) ? $transaction->contact_id : null,
            'amount' => $transaction->final_total,
            'type' => $type,
            'operation_date' =>  $transaction->transaction_date,
            'created_by' => $transaction->created_by,
            'transaction_id' => $transaction->id,
            'transaction_payment_id' =>  null
        ];
        ContactLedger::createContactLedger($account_transaction_data);
    }

}
