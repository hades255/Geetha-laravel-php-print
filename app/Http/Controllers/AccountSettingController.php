<?php

namespace App\Http\Controllers;

use App\Account;
use App\AccountGroup;
use App\AccountSetting;
use App\AccountTransaction;
use App\AccountType;
use App\Utils\ModuleUtil;
use App\Utils\ProductUtil;
use App\Utils\TransactionUtil;
use App\Utils\Util;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\TransactionPayment;
use App\Transaction;
use App\BusinessLocation;

class AccountSettingController extends Controller
{
    protected $commonUtil;
    protected $moduleUtil;
    protected $productUtil;
    protected $transactionUtil;

    /**
     * Constructor
     *
     * @param Util $commonUtil
     * @return void
     */
    public function __construct(Util $commonUtil, ModuleUtil $moduleUtil, ProductUtil $productUtil, TransactionUtil $transactionUtil)
    {
        $this->commonUtil = $commonUtil;
        $this->moduleUtil =  $moduleUtil;
        $this->productUtil =  $productUtil;
        $this->transactionUtil =  $transactionUtil;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // echo '<pre>'; print_r($request->toarray()); die();
        if (request()->ajax()) {
            $business_id = request()->session()->get('user.business_id');

            // account_type
            // account_sub_type

            $brands = AccountSetting::leftjoin('account_groups', 'account_settings.group_id', 'account_groups.id')
                ->leftjoin('accounts', 'account_settings.account_id', 'accounts.id')
                ->leftjoin('account_types', 'accounts.account_type_id', 'account_types.id')
                ->leftjoin('users', 'account_settings.created_by', 'users.id')
                ->where('account_settings.business_id', $business_id)
                ->where( function($q) use($request){
                    if(isset($request->date) && !empty($request->date)){
                        $request->date = date('Y-m-d',strtotime($request->date));
                        $q->where('account_settings.date' , $request->date);
                    }
                    if(isset($request->account_type) && !empty($request->account_type)){
                        $q->where('account_types.parent_account_type_id' , $request->account_type);
                    }
                    if(isset($request->account_sub_type) && !empty($request->account_sub_type)){
                        $q->where('accounts.account_type_id' , $request->account_sub_type);
                    }
                    if(isset($request->account_id) && !empty($request->account_id)){
                        $q->where('account_settings.account_id' , $request->account_id);
                    }
                    if(isset($request->group_id) && !empty($request->group_id)){
                        $q->where('account_settings.group_id' , $request->group_id);
                    }
                })
                ->select('account_settings.date', 'account_groups.name as account_group', 'accounts.name', 'account_settings.amount', 'users.username as created_by', 'account_settings.id');

            return datatables()::of($brands)
                ->addColumn(
                    'action',
                    '@can("account.settings.edit")
                    <button data-href="{{action(\'AccountSettingController@edit\', [$id])}}" class="btn btn-xs btn-primary btn-modal" data-container=".view_modal"><i class="glyphicon glyphicon-edit"></i> @lang("messages.edit")</button>
                        &nbsp;
                    @endcan'
                )
                ->editColumn('amount', '{{@num_format($amount)}}')
                ->editColumn('date', '{{@format_date($date)}}')
                ->removeColumn('id')
                ->rawColumns(['action'])
                ->make(true);
        }
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
            DB::beginTransaction();

            $account_id = $request->account_id;
            $amount = $request->amount;
            $date = $this->transactionUtil->uf_date($request->date);
            
            $cheque_data = $request->only([
                'cheque_number', 'cheque_date','bank_name','customer_id','cheque_amount'
            ]);
            
            // dd($cheque_data);
            
            if (!empty($account_id) && !empty($amount)) {
                if (!empty($account_id)) {
                    $this->addAccountOpeningBalance($amount, $account_id, $date, null, true,$cheque_data);
                }
            }

            DB::commit();
            $output = [
                'success' => 1,
                'msg' => __('lang_v1.success')
            ];
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong')
            ];
        }
        return redirect()->back()->with('status', $output);
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
        $business_id = request()->session()->get('business.id');
        $account_settings = AccountSetting::find($id);

        $account_groups = AccountGroup::where('business_id', $business_id)->whereIn('name', ['Cash Account', "Cheques in Hand (Customer's)", 'Card', 'Bank Account'])->pluck('name', 'id');

        $accounts = Account::where('business_id', $business_id)->where('asset_type', $account_settings->group_id)->pluck('name', 'id');

        return view('account_settings.edit')->with(compact(
            'account_settings',
            'account_groups',
            'accounts'
        ));
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
            DB::beginTransaction();
            $account_settings = AccountSetting::find($id);
            $account_settings->date = !empty($request->date) ? $this->transactionUtil->uf_date($request->date) : date('Y-m-d');
            $account_settings->amount = $request->amount;
            $account_settings->account_id = $request->account_id;
            $account_settings->created_by = Auth::user()->id;
            $account_settings->save();



            $account_id = $request->account_id;
            $amount = $request->amount;
            $date = $this->transactionUtil->uf_date($request->date);
            if (!empty($account_id) && !empty($amount)) {
                if (!empty($account_id)) {
                    $this->updateAccountOpeningBalance($account_settings, $amount, $account_id, $date, null, true);
                }
            }

            DB::commit();
            $output = [
                'success' => 1,
                'msg' => __('lang_v1.success')
            ];
        } catch (\Exception $e) {
            Log::emergency('File: ' . $e->getFile() . 'Line: ' . $e->getLine() . 'Message: ' . $e->getMessage());
            $output = [
                'success' => 0,
                'msg' => __('messages.something_went_wrong')
            ];
        }
        return redirect()->back()->with('status', $output);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function addAccountOpeningBalance($amount, $account_id, $date = null, $note = null, $is_setting = false,$cheques_data = array())
    {
        
        $business_id = request()->session()->get('business.id');
        $prefix_type = "sell_payment";
        
        
        $chequeId = $this->transactionUtil->account_exist_return_id('Cheques in Hand');
        
        
        if($chequeId == $account_id){
            
            $customersID = $cheques_data['customer_id'];
            $chequeAmounts = explode(',',$cheques_data['cheque_amount']);
            $chequeDates = explode(',',$cheques_data['cheque_date']);
            $chequeBanks = explode(',',$cheques_data['bank_name']);
            $chequeNos = explode(',',$cheques_data['cheque_number']);
            
            $i = 0;
            foreach($chequeAmounts as $one){
               
               $ref_count = $this->transactionUtil->setAndGetReferenceCount($prefix_type);
                $payment_ref_no = $this->transactionUtil->generateReferenceNumber($prefix_type, $ref_count);
                $c_amount = ($chequeAmounts[$i]);
                
                $type = 'debit';
                if ($c_amount > 0) {
                    $type = 'debit';
                } else {
                    $type = 'credit';
                }
                
        
                $ob_transaction_data = [
                    'amount' => abs($this->commonUtil->num_uf($c_amount)),
                    'account_id' => $account_id,
                    'type' => $type,
                    'sub_type' => 'opening_balance',
                    'operation_date' => !empty($date) ? $date : Carbon::now(),
                    'note' => !empty($note) ? $note : null,
                    'created_by' => Auth::user()->id
                ];
                
                $business_location = BusinessLocation::where('business_id', $business_id)
                ->first();
                
                $ob_data = [
    
                    'business_id' => $business_id,
    
                    'location_id' => $business_location->id,
    
                    'type' => 'cheque_opening_balance',
    
                    'status' => 'final',
    
                    'payment_status' => 'paid',
    
                    'contact_id' => $customersID,
    
                    'transaction_date' => !empty($date) ? $date : Carbon::now(),
    
                    'total_before_tax' => $c_amount,
    
                    'final_total' => $c_amount,
    
                    'created_by' => request()->session()->get('user.id')
    
                ];
                
                $transaction = Transaction::create($ob_data);
                
                $cheque_TP = array(
                    "account_id" => $this->transactionUtil->account_exist_return_id('Cheques in Hand'),
                    "payment_ref_no" => $payment_ref_no,
                    "created_by" => Auth::user()->id,
                    "payment_for" => $customersID,
                    "bank_name" => $chequeBanks[$i],
                    "cheque_date" => $chequeDates[$i],
                    "cheque_number" => $chequeNos[$i],
                    "card_type" => "credit",
                    "transaction_no" => 'cheque',
                    "method" => 'cheque',
                    "amount" => $c_amount,
                    "business_id" => $business_id,
                    "transaction_id" => $transaction->id,
                    "paid_on" => !empty($date) ? $date : Carbon::now()
                    );
                
                
                
                $tp = TransactionPayment::create($cheque_TP);
                
                
                $ob_transaction_data['transaction_payment_id'] = $tp->id;
                $ob_transaction_data['transaction_id'] = $transaction->id;
                $ob_transaction_data['sub_type'] = "ledger_show";
                
                $at_asset_transaction = AccountTransaction::createAccountTransaction($ob_transaction_data);
        
                unset($ob_transaction_data['sub_type']);
        
                $opening_balance_equity_id = $this->transactionUtil->account_exist_return_id('Opening Balance Equity Account');
              
                if ($c_amount > 0) {
                    $type = 'credit';
                } else {
                    $type = 'debit';
                }
                $ob_transaction_data['account_id'] = $opening_balance_equity_id;
                $ob_transaction_data['type'] = $type;
                $ob_transaction_data['amount'] = abs($this->commonUtil->num_uf($c_amount));
                $at_obe_transaction = AccountTransaction::createAccountTransaction($ob_transaction_data);
                
                
                
               
               $i++; 
               
            }
            
            
        }else{
            
            $amount = ($amount);
                
            $type = 'debit';
            if ($amount > 0) {
                $type = 'debit';
            } else {
                $type = 'credit';
            }
                
        
            $ob_transaction_data = [
                'amount' => abs($this->commonUtil->num_uf($amount)),
                'account_id' => $account_id,
                'type' => $type,
                'sub_type' => 'opening_balance',
                'operation_date' => !empty($date) ? $date : Carbon::now(),
                'note' => !empty($note) ? $note : null,
                'created_by' => Auth::user()->id
            ];
            
            
            $at_asset_transaction = AccountTransaction::createAccountTransaction($ob_transaction_data);
        
            $opening_balance_equity_id = $this->transactionUtil->account_exist_return_id('Opening Balance Equity Account');
          
            if ($amount > 0) {
                $type = 'credit';
            } else {
                $type = 'debit';
            }
            $ob_transaction_data['account_id'] = $opening_balance_equity_id;
            $ob_transaction_data['type'] = $type;
            $ob_transaction_data['amount'] = abs($this->commonUtil->num_uf($amount));
            $at_obe_transaction = AccountTransaction::createAccountTransaction($ob_transaction_data);
            
        }

        if ($is_setting) {
            $setting_date = [
                'business_id' => $business_id,
                'date' => $date,
                'account_id' => $account_id,
                'amount' => $amount,
                'group_id' => request()->group_id,
                'at_asset_id' => $at_asset_transaction->id,
                'at_obe_id' => $at_obe_transaction->id,
                'created_by' => Auth::user()->id
            ];

            AccountSetting::create($setting_date);
        }

        return true;
    }
    public function updateAccountOpeningBalance($account_settings, $amount, $account_id, $date = null, $note = null, $is_setting = false)
    {
        $business_id = request()->session()->get('business.id');

        $type = 'debit';
        if ($amount > 0) {
            $type = 'debit';
        } else {
            $type = 'credit';
        }
        $amount = ($amount);

        $ob_transaction_data = [
            'amount' => abs($this->commonUtil->num_uf($amount)),
            'account_id' => $account_id,
            'type' => $type,
            'sub_type' => 'opening_balance',
            'operation_date' => !empty($date) ? $date : Carbon::now(),
            'note' => !empty($note) ? $note : null,
            'created_by' => Auth::user()->id
        ];

        AccountTransaction::where('id', $account_settings->at_asset_id)->update($ob_transaction_data);

        $opening_balance_equity_id = $this->transactionUtil->account_exist_return_id('Opening Balance Equity Account');
        if ($amount > 0) {
            $type = 'credit';
        } else {
            $type = 'debit';
        }
        $ob_transaction_data['account_id'] = $opening_balance_equity_id;
        $ob_transaction_data['amount'] = abs($this->commonUtil->num_uf($amount));
        $ob_transaction_data['type'] = $type;
        AccountTransaction::where('id', $account_settings->at_obe_id)->update($ob_transaction_data);

        return true;
    }
}
