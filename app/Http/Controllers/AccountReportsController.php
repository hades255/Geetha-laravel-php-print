<?php

namespace App\Http\Controllers;

use App\Account;
use Carbon\Carbon;
use App\AccountType;
use App\AccountGroup;
use App\BusinessLocation;
use App\Utils\ModuleUtil;
use App\AccountTransaction;
use App\TransactionPayment;
use Illuminate\Http\Request;
use App\Utils\TransactionUtil;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Bus;
use Yajra\DataTables\Facades\DataTables;
use Modules\Superadmin\Entities\ModulePermissionLocation;

class AccountReportsController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $transactionUtil;
    protected $moduleUtil;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TransactionUtil $transactionUtil, ModuleUtil $moduleUtil)
    {
        $this->transactionUtil = $transactionUtil;
        $this->moduleUtil = $moduleUtil;
    }
    
    public function getAccountsBalanceByGroup(

    $group_id,
    
    $type,
    
    $start_date,
    
    $end_date,
    
    $location_id

    ) {
    
        $business_id = session()->get('user.business_id');
        
        $accounts = Account::leftjoin('account_transactions as AT', function ($join) {
        
            $join->on('AT.account_id', '=', 'accounts.id');
        
            $join->whereNull('AT.deleted_at');
        })
        
            ->leftjoin('transactions', 'AT.transaction_id', 'transactions.id')
        
            ->where('accounts.business_id', $business_id)
        
            ->where('accounts.asset_type', $group_id)
        
            ->where('transactions.type', 'sell')
        
            ->where('accounts.visible', 1)->notClosed()
        
            ->whereDate('AT.operation_date', '>=', $start_date)
        
            ->whereDate('AT.operation_date', '<=', $end_date)
        
            ->select([
        
                DB::raw("SUM( IF(AT.type='credit', amount, -1*amount) ) as sale_income_balance"),
        
                DB::raw("SUM( IF(AT.type='credit', -1*amount, amount) ) as cogs_balance"),
        
                DB::raw("SUM( IF(AT.type='credit', -1*amount, amount) ) as direct_expense_balance"),
        
            ]);
        
        $accounts->where('disabled', 0);
        
        $accounts = $accounts->first();
        
        if ($type == 'sales_income') {
        
            return $accounts->sale_income_balance;
        }
        
        if ($type == 'cogs') {
        
            return $accounts->cogs_balance;
        }
        
        if ($type == 'direct_expense') {
        
            return $accounts->direct_expense_balance;
        }
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function balanceSheet()
    {
        if (!auth()->user()->can('account.access')) {
            abort(403, 'Unauthorized action.');
        }
        $business_id = session()->get('user.business_id');
        $account_access = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'access_account');
        $location_id = request()->location_id;
        $end_date = !empty(request()->input('end_date')) ? $this->transactionUtil->uf_date(request()->input('end_date')) : Carbon::now()->format('Y-m-d');
        $start_date = Carbon::now()->year . '-' . request()->session()->get('business.fy_start_month') . '-1';
        $start_date_profit = Carbon::createFromFormat('Y-m-d', $start_date)->format('Y-m-d');
        if (request()->ajax()) {

            $assets_accounts = $this->accountQueryBalanceSheet($location_id, $business_id, $start_date, $end_date)->where('ats.name', 'Current Assets')->where('parent_account_id', null)->where('is_main_account', 0)->select([
                'accounts.name', 'ats.name as type_name',
                DB::raw("SUM( IF(AT.type='credit', -1*AT.amount, AT.amount) ) as balance")
            ])->groupBy('accounts.id')->get();
            $assets_accounts_mains = Account::leftjoin('account_types as ats', 'accounts.account_type_id', '=', 'ats.id')->where('accounts.business_id', $business_id)->where('ats.name', 'Current Assets')->where('is_main_account', 1)->select('accounts.name', 'accounts.id')->get();
            $assets_accounts_main_balances = [];
            
            
            foreach ($assets_accounts_mains as $assets_accounts_main) {
                $assets_accounts_main_balances[$assets_accounts_main->name] =  Account::getSubAccountBalanceByMainAccountId($assets_accounts_main->id, $start_date, $end_date);
                
                \Log::debug($assets_accounts_main->name.":".$assets_accounts_main_balances[$assets_accounts_main->name]);
            }


            $equity_accounts_mains = Account::leftjoin('account_types as ats', 'accounts.account_type_id', '=', 'ats.id')->where('accounts.business_id', $business_id)->where('ats.name', 'Equity')->where('is_main_account', 1)->select('accounts.name', 'accounts.id')->get();
            $equity_accounts_main_balances = [];
            //dd($equity_accounts_mains);
            $tl_equity_accounts_main_balances = 0;
            foreach ($equity_accounts_mains as $equity_accounts_main) {
                $equity_accounts_main_balances[$equity_accounts_main->name] =  Account::getSubAccountBalanceByMainAccountId($equity_accounts_main->id, $start_date, $end_date);
                $tl_equity_accounts_main_balances = $equity_accounts_main_balances[$equity_accounts_main->name];
            }
            $fixed_assets_accounts = $this->accountQueryBalanceSheet($location_id, $business_id, $start_date, $end_date)->where('ats.name', 'Fixed Assets')->where('parent_account_id', null)->where('is_main_account', 0)->select([
                'accounts.name', 'ats.name as type_name',
                DB::raw("SUM( IF(AT.type='credit', -1*AT.amount, AT.amount) ) as balance")
            ])->groupBy('accounts.id')->get();
            $fixed_assets_accounts_mains = Account::leftjoin('account_types as ats', 'accounts.account_type_id', '=', 'ats.id')->where('accounts.business_id', $business_id)->where('ats.name', 'Fixed Assets')->where('is_main_account', 1)->select('accounts.name', 'accounts.id')->get();
            $fixed_assets_accounts_main_balances = [];
            foreach ($fixed_assets_accounts_mains as $fixed_assets_accounts_main) {
                $fixed_assets_accounts_main_balances[$fixed_assets_accounts_main->name] =  Account::getSubAccountBalanceByMainAccountId($fixed_assets_accounts_main->id, $start_date, $end_date);
            }

            $liabilities_accounts = $this->accountQueryBalanceSheet($location_id, $business_id, $start_date, $end_date)->where('ats.name', 'Current Liabilities')->select([
                'accounts.name', 'ats.name as type_name',
                DB::raw("SUM( IF(AT.type='credit', AT.amount, -1*AT.amount) ) as balance")
            ])->get();
            $liabilities_accounts_mains = Account::leftjoin('account_types as ats', 'accounts.account_type_id', '=', 'ats.id')->where('accounts.business_id', $business_id)->where('ats.name', 'Current Liabilities')->where('is_main_account', 1)->select('accounts.name', 'accounts.id')->get();
            $liabilities_accounts_main_balances = [];
            foreach ($liabilities_accounts_mains as $liabilities_accounts_main) {
                $liabilities_accounts_main_balances[$liabilities_accounts_main->name] =  Account::getSubAccountBalanceByMainAccountId($liabilities_accounts_main->id, $start_date, $end_date);
            }

            $lt_liabilities_accounts = $this->accountQueryBalanceSheet($location_id, $business_id, $start_date, $end_date)->where('ats.name', 'Long term Liabilities')->where('parent_account_id', null)->where('is_main_account', 0)->select([
                'accounts.name', 'ats.name as type_name',
                DB::raw("SUM( IF(AT.type='credit', AT.amount, -1*AT.amount) ) as balance")
            ])->groupBy('accounts.id')->get();

            $lt_liabilities_accounts_mains = Account::leftjoin('account_types as ats', 'accounts.account_type_id', '=', 'ats.id')->where('accounts.business_id', $business_id)->where('ats.name', 'Long term Liabilities')->where('is_main_account', 1)->select('accounts.name', 'accounts.id')->get();
            $lt_liabilities_accounts_main_balances = [];
            foreach ($lt_liabilities_accounts_mains as $lt_liabilities_accounts_main) {
                $lt_liabilities_accounts_main_balances[$lt_liabilities_accounts_main->name] =  Account::getSubAccountBalanceByMainAccountId($lt_liabilities_accounts_main->id, $start_date, $end_date);
            }

            $equity_accounts = $this->accountQueryBalanceSheet($location_id, $business_id, $start_date, $end_date)->where('ats.name', 'Equity')->where('parent_account_id', null)->where('is_main_account', 0)->select([
                'accounts.name', 'ats.name as type_name',
                DB::raw("SUM( IF(AT.type='credit', AT.amount, -1*AT.amount) ) as balance")
            ])->groupBy('accounts.id')->get();
            // start net profit
            $sell_details = $this->transactionUtil->getSellTotals(
                $business_id,
                $start_date_profit,
                $end_date,
                $location_id
            );
            $total_sell = !empty($sell_details['total_sell_exc_tax']) ? $sell_details['total_sell_exc_tax'] : 0;
            $total_sale_cost = $this->transactionUtil->getSaleCost($business_id, $start_date_profit, $end_date)->total_sale_cost;
            $transaction_types = [
                'purchase_return', 'sell_return', 'expense', 'stock_adjustment', 'sell_transfer', 'purchase', 'sell'
            ];
            $total_expense_balance = $this->getTotalAccountBalanceExpense(
                $start_date_profit,
                $end_date,
                $location_id
            );
            $transaction_totals = $this->transactionUtil->getTransactionTotals(
                $business_id,
                $transaction_types,
                $start_date_profit,
                $end_date,
                $location_id
            );
            
            
            
            
            $sale_income_group = AccountGroup::getGroupByName('Sales Income Group');

            $cogs_group = AccountGroup::getGroupByName('COGS Account Group');
            
            $direct_expense_group = AccountGroup::getGroupByName('Direct Expense');
            $cogs_accounts = Account::leftjoin('account_groups', 'accounts.asset_type', 'account_groups.id')->where('accounts.business_id', $business_id)->where('account_groups.name', 'COGS Account Group')->select('accounts.id')->get()->pluck('id');
                        
            $incomeGrp_accounts = Account::leftjoin('account_groups', 'accounts.asset_type', 'account_groups.id')->where('accounts.business_id', $business_id)->where('account_groups.name', 'Sales Income Group')->select('accounts.id')->get()->pluck('id');
                        
            
            
            
            // GET TOTAL SALE ON COST
            $sales_on_cost = AccountTransaction::whereDate('account_transactions.operation_date','>=', $start_date)
                ->join('transactions', 'transactions.id', '=', 'account_transactions.transaction_id')
                ->whereDate('account_transactions.operation_date','<=', $end_date)
                ->whereIn('account_transactions.account_id',$cogs_accounts)
                ->where('account_transactions.type','debit')
                ->get()->sum('amount');
            
            // GET TOTAL SALES INCOME
            $sales_total = AccountTransaction::whereDate('account_transactions.operation_date','>=', $start_date)
                ->join('transactions', 'transactions.id', '=', 'account_transactions.transaction_id')
                ->whereDate('account_transactions.operation_date','<=', $end_date)
                ->whereIn('account_transactions.account_id',$incomeGrp_accounts)
                ->where('account_transactions.type','credit')
                ->get()->sum('amount');
                
            $direct_expense_balance = $this->getAccountsBalanceByGroup(

                $direct_expense_group->id,
                
                'direct_expense',
                
                $start_date,
                
                $end_date,
                
                $location_id
            
            );
            
            
            $profit = $sales_total - $sales_on_cost  - $transaction_totals['total_expense'] - $transaction_totals['settlement_expense'];
            
           
            
            
            $total_expense_balance = !empty($total_expense_balance) ? $total_expense_balance : 0;
            $total_expense =  $transaction_totals['total_expense'] + $transaction_totals['settlement_expense'];
            $gross_profit = ($total_sell - $total_sale_cost) - ($total_expense - $total_expense_balance);
            
            // $net_profit = $gross_profit - $total_expense_balance;
            $net_profit = $profit;
            
            
            
            
            //end net profit
            //dd($gross_profit);
            //dd($equity_accounts_main_balances);
            return view('account_reports.partials.balance_sheet_details')->with(compact(
                'account_access',
                'assets_accounts',
                'liabilities_accounts',
                'fixed_assets_accounts',
                'lt_liabilities_accounts',
                'equity_accounts',
                'assets_accounts_main_balances',
                'fixed_assets_accounts_main_balances',
                'liabilities_accounts_main_balances',
                'lt_liabilities_accounts_main_balances',
                'equity_accounts_main_balances',
                'tl_equity_accounts_main_balances',
                'net_profit'
            ));
            exit;
        }
        $business_locations = BusinessLocation::where('business_id', $business_id)->pluck('name', 'id');

        return view('account_reports.balance_sheet')->with(compact('business_locations', 'account_access'));
    }
    // add additional function for net profit
    public function getTotalAccountBalanceExpense(
        $start_date,
        $end_date,
        $location_id
    ) {
        $business_id = session()->get('user.business_id');
        $expense_account_type_id = AccountType::getAccountTypeIdByName('Expenses', $business_id)->id;
        $cogs_accounts = Account::leftjoin('account_groups', 'accounts.asset_type', 'account_groups.id')->where('accounts.business_id', $business_id)->where('account_groups.name', 'COGS Account Group')->select('accounts.id')->get();
        $direct_expense_accounts = Account::leftjoin('account_groups', 'accounts.asset_type', 'account_groups.id')->where('accounts.business_id', $business_id)->where('account_groups.name', 'Direct Expense')->select('accounts.id')->get();
        $merged_expenses_account = $cogs_accounts->merge($direct_expense_accounts)->pluck('id')->toArray();
        $accounts = Account::leftjoin('account_transactions as AT', function ($join) {
            $join->on('AT.account_id', '=', 'accounts.id');
            $join->whereNull('AT.deleted_at');
        })
            ->where('accounts.business_id', $business_id)
            ->whereDate('AT.operation_date', '>=', $start_date)
            ->whereDate('AT.operation_date', '<=', $end_date)
            ->where('accounts.account_type_id', $expense_account_type_id)
            ->whereNotIn('accounts.id', $merged_expenses_account)
            ->notClosed()
            ->where('accounts.visible', 1)
            ->select([
                DB::raw("SUM( IF(AT.type='credit', -1*AT.amount, AT.amount) ) as balance"),
            ]);
        $accounts->where('disabled', 0);
        $accounts = $accounts->first();
        return $accounts->balance;
    }
    // end add addition for net profit

    public function accountQueryBalanceSheet($location_id = null, $business_id, $start_date, $end_date)
    {
        $query = Account::leftjoin(
            'account_transactions as AT',
            'AT.account_id',
            '=',
            'accounts.id'
        )->leftJoin('transactions', function($join) use ($location_id,$business_id){
                $join->on( 'AT.transaction_id','transactions.id');
                
                if ($location_id != null) {
                    $join->on('transactions.location_id', \DB::raw($location_id));
                } else {
                    $allowed_locations = ModulePermissionLocation::getModulePermissionLocations($business_id, 'accounting_module');
                    if (!empty($allowed_locations)) {
                        if (!empty($allowed_locations->locations)) {
                           
                            foreach($allowed_locations->locations as $allow_location_id => $location){
                                $join->on('transactions.location_id', \DB::raw($allow_location_id));
                            }
                        }
                    }
                }
                
                return $join;
            })
            ->leftjoin(
                'account_types as ats',
                'accounts.account_type_id',
                '=',
                'ats.id'
            )
            ->leftJoin('transaction_payments AS TP', 'AT.transaction_payment_id', '=', 'TP.id')
            // ->NotClosed()
             ->where(function ($query1) {
                $query1->whereNull('AT.transaction_payment_id')
                ->orWhere(function ($query2) {
                    $query2->whereNotNull('AT.transaction_payment_id')
                    ->whereNotNull('TP.id');
                });
            })
            ->whereNull('AT.deleted_at')
            ->where('accounts.business_id', $business_id)
            ->whereDate('AT.operation_date', '>=', $start_date)
            ->whereDate('AT.operation_date', '<=', $end_date);
            
        return $query;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function trialBalance()
    {
        if (!auth()->user()->can('account.access')) {
            abort(403, 'Unauthorized action.');
        }
        $business_id = session()->get('user.business_id');
        $account_access = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'access_account');
        if (request()->ajax()) {
            $end_date = request()->input('end_date');
            $start_date = request()->input('start_date');
            $location_id = request()->input('location_id');
          
            // $accounts = AccountTransaction::join(
            //     'accounts as A',
            //     'account_transactions.account_id',
            //     '=',
            //     'A.id'
            //     )->leftJoin('transactions', function($join) use ($location_id,$business_id){
            //         $join->on( 'account_transactions.transaction_id','transactions.id');
                    
            //         if ($location_id != null) {
            //             $join->on('transactions.location_id', \DB::raw($location_id));
            //         } else {
            //             $allowed_locations = ModulePermissionLocation::getModulePermissionLocations($business_id, 'accounting_module');
            //             if (!empty($allowed_locations)) {
            //                 if (!empty($allowed_locations->locations)) {
                                
            //                     foreach($allowed_locations->locations as $allow_location_id => $location){
            //                         $join->on('transactions.location_id', \DB::raw($allow_location_id));
            //                     }
            //                 }
            //             }
            //         }
                    
            //         return $join;
            //     })
            //     ->leftJoin('users AS u', 'account_transactions.created_by', '=', 'u.id')
            //     ->leftjoin(
            //         'account_types as ats',
            //         'A.account_type_id',
            //         '=',
            //         'ats.id'
            //     )
            //     ->leftJoin('transaction_payments AS TP', 'account_transactions.transaction_payment_id', '=', 'TP.id')
            //     ->where(function ($query1) {
            //         $query1->whereNull('account_transactions.transaction_payment_id')
            //         ->orWhere(function ($query2) {
            //             $query2->whereNotNull('account_transactions.transaction_payment_id')
            //             ->whereNotNull('TP.id');
            //         });
            //     })
            //     ->where('A.business_id', $business_id)
            //     ->where('A.is_main_account', 0)
            //     ->select([
            //         'A.name', 'A.account_number', 'ats.name as account_type',
            //         DB::raw("SUM( IF(account_transactions.type='debit', account_transactions.amount, -1*account_transactions.amount) ) as ass_exp_balance"),
            //         DB::raw("SUM( IF(account_transactions.type='credit', account_transactions.amount, -1*account_transactions.amount) ) as li_in_eq_balance")
            //         // DB::raw("SUM( IF(account_transactions.type='credit', account_transactions.amount, -1*account_transactions.amount) ) as ass_exp_balance"),
            //         // DB::raw("SUM( IF(account_transactions.type='debit', account_transactions.amount, -1*account_transactions.amount) ) as li_in_eq_balance")

            //     ])->withTrashed()
            //     ->groupBy('A.id');
            
            $accounts = Account::leftjoin('account_types','accounts.account_type_id','account_types.id')
                        ->where('accounts.business_id',$business_id)
                        ->where('accounts.is_main_account',0)
                        ->select(['accounts.id','accounts.name','accounts.account_number','account_types.name as account_type'])
                        ->get();
            
            $start_date = request()->input('start_date');
            $end_date = request()->input('end_date');

            // if (!empty($start_date) && !empty($end_date)) {
            //     $accounts->whereDate('account_transactions.operation_date', '>=', $start_date)
            //         ->whereDate('account_transactions.operation_date', '<=', $end_date);
            // }

            return DataTables::of($accounts)

                ->addColumn('debit', function ($row) use($business_id,$start_date,$end_date){
                    $debit = '';
                    $tot = $this->totalDebitsTotalCredits($business_id,[$row->id],$start_date,$end_date);
                    
                    logger($row->account_type);
                    
                    if ($row->account_type == 'Assets' || $row->account_type == 'Fixed Assets' || $row->account_type == 'Assets' || $row->account_type == 'Current Assets' || $row->account_type == 'Expenses') {
                        $bal = $tot['debit']-$tot['credit'];
                        
                        $debit = '<span class="display_currency debit" data-currency_symbol="true" data-orig-value="' . $bal . '">' . $bal. '</span>';
                    }
                    return $debit;
                })
                ->addColumn('credit', function ($row)  use($business_id,$start_date,$end_date) {
                    $credit = '';
                    $tot = $this->totalDebitsTotalCredits($business_id,[$row->id],$start_date,$end_date);
                    
                    if ($row->account_type == 'Liabilities' || $row->account_type == 'Current Liabilities' || $row->account_type == 'Income' || $row->account_type == 'Equity' || $row->account_type == 'Profit & Loss' || $row->account_type == 'Owners Contribution' ||  $row->account_type =='Long Term Liabilities') {
                        $bal = $tot['credit']-$tot['debit'];
                        $credit = '<span class="display_currency credit" data-currency_symbol="true" data-orig-value="' . $bal . '">' . $bal . '</span>';
                    }
                    return $credit;
                })

                ->rawColumns(['debit', 'credit'])
                ->make(true);
        }




        $business_locations = BusinessLocation::where('business_id', $business_id)->pluck('name', 'id');

        return view('account_reports.trial_balance')->with(compact('business_locations', 'account_access'));
    }
    
    
    public function totalDebitsTotalCredits($business_id,$id,$start_date,$end_date){
                    $accounts = AccountTransaction::join(
                'accounts as A',
                'account_transactions.account_id',
                '=',
                'A.id'
            )
                ->leftJoin('users AS u', 'account_transactions.created_by', '=', 'u.id')
                ->leftjoin(
                    'account_types as ats',
                    'A.account_type_id',
                    '=',
                    'ats.id'
                )
                ->leftJoin('transaction_payments AS TP', 'account_transactions.transaction_payment_id', '=', 'TP.id')
                ->where('A.business_id', $business_id)
                ->whereIn('A.id', $id)
                ->where(function ($query) {
                    $query->whereNull('account_transactions.transaction_payment_id')
                          ->orWhere(function ($query2) {
                                $query2->whereNotNull('account_transactions.transaction_payment_id');
                                        // ->whereNotNull('TP.id');
                          });
                })
                ->with(['transaction', 'transaction.contact', 'transfer_transaction'])
                ->select([
                     'type',
                    'account_transactions.account_id',
                    'account_transactions.amount',
                    'account_transactions.interest',
                    'account_transactions.reconcile_status',
                    'account_transactions.sub_type as at_sub_type',
                    'operation_date', 'account_transactions.note',
                    'journal_deleted',
                    'deleted_by',
                    'journal_entry',
                    'account_transactions.transaction_sell_line_id',
                    'account_transactions.income_type',
                    'account_transactions.attachment',
                    'account_transactions.cheque_number as dep_trans_cheque_number',
                    'account_transactions.transaction_payment_id as tp_id',
                    'TP.cheque_number', 'TP.bank_name', 'TP.cheque_date',
                    'TP.card_type',
                    'TP.method',
                    'TP.paid_on',
                    'TP.payment_ref_no',
                    'TP.account_id as bank_account_id',
                     'updated_type',
                    'updated_by',
                    'account_transactions.updated_at',
                    'A.name as account_name',
                    'sub_type',
                    'transfer_transaction_id',
                    'ats.name as account_type_name',
                    'account_transactions.transaction_id',
                    'account_transactions.id',
                    DB::raw("CONCAT(COALESCE(u.surname, ''),' ',COALESCE(u.first_name, ''),' ',COALESCE(u.last_name,'')) as added_by")
                ])
                ->withTrashed()
                ->orderBy('account_transactions.operation_date', 'asc'); // 
                
            if (!empty($start_date) && !empty($end_date)) {
                $accounts->whereBetween(DB::raw('date(operation_date)'), [$start_date, $end_date]);
            }
            
            $debits = 0;
            $credits = 0;
            foreach($accounts->get()->toArray() as $one){
                
                if($one['type'] == "debit"){
                    $debits += $one['amount'];
                }elseif($one['type'] == "credit"){
                    $credits += $one['amount'];
                }
            }
            
            
            
            return array("debit" => $debits,"credit" => $credits);
    }

    /**
     * Retrives account balances.
     * @return Obj
     */
    private function getAccountBalance($location_id = null, $business_id,  $start_date, $end_date, $account_type = 'others')
    {
        $query = Account::leftjoin(
            'account_transactions as AT',
            'AT.account_id',
            '=',
            'accounts.id'
        )
            ->leftjoin(
                'transactions',
                'AT.transaction_id',
                '=',
                'transactions.id'
            )
            ->leftjoin('account_types', 'accounts.account_type_id', 'account_types.id')
            ->whereNull('AT.deleted_at')
            ->where('accounts.is_main_account', 0)
            ->where('accounts.business_id', $business_id)
            ->whereDate('AT.operation_date', '>=', $start_date)
            ->whereDate('AT.operation_date', '<=', $end_date);
        if (!empty($location_id)) {
            $query->where('transactions.location_id', $location_id);
        } else {
            $allowed_locations = ModulePermissionLocation::getModulePermissionLocations($business_id, 'accounting_module');
            if (!empty($allowed_locations)) {
                if (!empty($allowed_locations->locations)) {
                    $location_ids = array_keys($allowed_locations->locations);
                    $query->whereIn('transactions.location_id',  $location_ids);
                }
            }
        }
        $account_details = $query->select([
            'accounts.name', 'accounts.account_number', 'account_types.name as type_name',
            DB::raw("SUM( IF(AT.type='credit', amount, -1*amount) ) as credit_balance"),
            DB::raw("SUM( IF(AT.type='debit', amount, -1*amount) ) as debit_balance")
        ])
            ->groupBy('accounts.id')
            ->get()->toArray();

        return $account_details;
    }

    /**
     * Displays payment account report.
     * @return Response
     */
    public function paymentAccountReport()
    {
        if (!auth()->user()->can('account.access')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = session()->get('user.business_id');

        if (request()->ajax()) {
            $query = TransactionPayment::leftjoin(
                'transactions as T',
                'transaction_payments.transaction_id',
                '=',
                'T.id'
            )
                ->leftjoin('accounts as A', 'transaction_payments.account_id', '=', 'A.id')
                ->where('transaction_payments.business_id', $business_id)
                ->whereNull('transaction_payments.parent_id')
                ->select([
                    'paid_on',
                    'payment_ref_no',
                    'T.ref_no',
                    'T.invoice_no',
                    'T.type',
                    'T.id as transaction_id',
                    'A.name as account_name',
                    'A.account_number',
                    'transaction_payments.id as payment_id',
                    'transaction_payments.account_id',
                    'transaction_payments.amount as paid_amount',
                    'T.final_total as amount'
                ]);

            $start_date = !empty(request()->input('start_date')) ? request()->input('start_date') : '';
            $end_date = !empty(request()->input('end_date')) ? request()->input('end_date') : '';

            if (!empty($start_date) && !empty($end_date)) {
                $query->whereBetween(DB::raw('date(paid_on)'), [$start_date, $end_date]);
            }

            $account_id = !empty(request()->input('account_id')) ? request()->input('account_id') : '';
            if (!empty($account_id)) {
                $query->where('account_id', $account_id);
            }

            return DataTables::of($query)
                ->editColumn('paid_on', function ($row) {
                    return $this->transactionUtil->format_date($row->paid_on, true);
                })
                /*->addColumn('action', function ($row) {
                    if (auth()->user()->can('account.link_account')) {
                        $action = '<button type="button" class="btn btn-info 
                        btn-xs btn-modal"
                        data-container=".view_modal" 
                        data-href="' . action('AccountReportsController@getLinkAccount', [$row->payment_id]) . '">' . __('account.link_account') . '</button>';
                    } else {
                        $action = '';
                    }
                    return $action;
                }) */
                ->addColumn('account', function ($row) {
                    $account = '';
                    if (!empty($row->account_id)) {
                        $account = $row->account_name . ' - ' . $row->account_number;
                    }
                    return $account;
                })
                ->addColumn('transaction_number', function ($row) {
                    $html = $row->ref_no;
                    if ($row->type == 'sell') {
                        $html = '<button type="button" class="btn btn-link btn-modal"
                                    data-href="' . action('SellController@show', [$row->transaction_id]) . '" data-container=".view_modal">' . $row->invoice_no . '</button>';
                    } elseif ($row->type == 'purchase') {
                        $html = '<button type="button" class="btn btn-link btn-modal"
                                    data-href="' . action('PurchaseController@show', [$row->transaction_id]) . '" data-container=".view_modal">' . $row->ref_no . '</button>';
                    }
                    return $html;
                })
                ->editColumn('type', function ($row) {
                    $type = $row->type;
                    if ($row->type == 'sell') {
                        $type = __('sale.sale');
                    } elseif ($row->type == 'purchase') {
                        $type = __('lang_v1.purchase');
                    } elseif ($row->type == 'expense') {
                        $type = __('lang_v1.expense');
                    }
                    return $type;
                })
                ->editColumn('amount', function ($row) {
                    return '<span class="display_currency" data-currency_symbol="false">' . $row->amount . '</span>';
                })
                ->editColumn('paid_amount', function ($row) {
                    return '<span class="display_currency" data-currency_symbol="false">' . $row->paid_amount . '</span>';
                })
                ->filterColumn('account', function ($query, $keyword) {
                    $query->where('A.name', 'like', ["%{$keyword}%"])
                        ->orWhere('account_number', 'like', ["%{$keyword}%"]);
                })
                ->filterColumn('transaction_number', function ($query, $keyword) {
                    $query->where('T.invoice_no', 'like', ["%{$keyword}%"])
                        ->orWhere('T.ref_no', 'like', ["%{$keyword}%"]);
                })
                ->rawColumns(['transaction_number', 'amount', 'paid_amount'])
                ->make(true);
        }

        $accounts = Account::forDropdown($business_id, false);
        $accounts->prepend(__('messages.all'), '');

        return view('account_reports.payment_account_report')
            ->with(compact('accounts'));
    }

    /**
     * Shows form to link account with a payment.
     * @return Response
     */
    public function getLinkAccount($id)
    {
        if (!auth()->user()->can('account.access')) {
            abort(403, 'Unauthorized action.');
        }

        $business_id = session()->get('user.business_id');
        if (request()->ajax()) {
            $payment = TransactionPayment::where('business_id', $business_id)->findOrFail($id);
            $accounts = Account::forDropdown($business_id, false);

            return view('account_reports.link_account_modal')
                ->with(compact('accounts', 'payment'));
        }
    }

    /**
     * Links account with a payment.
     * @param  Request $request
     * @return Response
     */
    public function postLinkAccount(Request $request)
    {
        if (!auth()->user()->can('account.access')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            $business_id = session()->get('user.business_id');
            if (request()->ajax()) {
                $payment_id = $request->input('transaction_payment_id');
                $account_id = $request->input('account_id');

                $payment = TransactionPayment::with(['transaction'])->where('business_id', $business_id)->findOrFail($payment_id);
                $payment->account_id = $account_id;
                $payment->save();

                $payment_type = !empty($payment->transaction->type) ? $payment->transaction->type : null;
                if (empty($payment_type)) {
                    $child_payment = TransactionPayment::where('parent_id', $payment->id)->first();
                    $payment_type = !empty($child_payment->transaction->type) ? $child_payment->transaction->type : null;
                }

                AccountTransaction::updateAccountTransaction($payment, $payment_type);
            }
            $output = [
                'success' => true,
                'msg' => __("account.account_linked_success")
            ];
        } catch (\Exception $e) {
            \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

            $output = [
                'success' => false,
                'msg' => __("messages.something_went_wrong")
            ];
        }

        return $output;
    }


    /**
     * Income Statement
     * @param  Request $request
     * @return Response
     */
    public function incomeStatement(Request $request)
    {
        if (!auth()->user()->can('account.access')) {
            abort(403, 'Unauthorized action.');
        }
        $business_id = session()->get('user.business_id');
        $account_access = $this->moduleUtil->hasThePermissionInSubscription($business_id, 'access_account');


        if (request()->ajax()) {

            $first_statement_start_date = $request->first_statement_start_date;
            $first_statement_end_date = $request->first_statement_end_date;
            $second_statement_start_date = $request->second_statement_start_date;
            $second_statement_end_date = $request->second_statement_end_date;
            $third_statement_start_date = $request->third_statement_start_date;
            $third_statement_end_date = $request->third_statement_end_date;
            $location_id = $request->location_id;
            $dates['first'] = $first_statement_start_date;
            $dates['second'] = $second_statement_start_date;
            $dates['third'] = $third_statement_start_date;

            /* income section */
            $income_details = [];
            $get_income_type_id = AccountType::getAccountTypeIdOfType('Income', $business_id);
            $income_accounts = Account::where('account_type_id', $get_income_type_id)->get();
            // @eng START 9/2 2359
            $totIncomeFirst = 0;//@eng 9/2 2359
            $totIncomeSecond = 0;
            $totIncomeThird = 0;
            foreach ($income_accounts as $i_account) {
                $income_details[$i_account->name]['first'] =  $this->accountBalanceQuery($location_id, $first_statement_start_date, $first_statement_end_date, $i_account->id);
                $totIncomeFirst+=$income_details[$i_account->name]['first'];
                $income_details[$i_account->name]['second'] =  $this->accountBalanceQuery($location_id, $second_statement_start_date, $second_statement_end_date, $i_account->id);
                $totIncomeSecond += $income_details[$i_account->name]['second'];
                $income_details[$i_account->name]['third'] =  $this->accountBalanceQuery($location_id, $third_statement_start_date, $third_statement_end_date, $i_account->id);
                $totIncomeThird += $income_details[$i_account->name]['third'];
            }
            // @eng END 9/2 2359

            /* cost of sale section */
            $cost_details = [];
            $cog_group_id = AccountGroup::getGroupByName('COGS Account Group');
            $cost_accounts = Account::where('asset_type', $cog_group_id->id)->get();
            // @eng START 9/2 2359
            $cogsFirst = 0;
            $cogsSecond = 0;
            $cogsThird = 0;
            foreach ($cost_accounts as $c_account) {
                $cost_details[$c_account->name]['first'] =  $this->accountBalanceQuery($location_id, $first_statement_start_date, $first_statement_end_date, $c_account->id);
                $cogsFirst += $cost_details[$c_account->name]['first'];
                $cost_details[$c_account->name]['second'] =  $this->accountBalanceQuery($location_id, $second_statement_start_date, $second_statement_end_date, $c_account->id);
                $cogsSecond += $cost_details[$c_account->name]['second'];
                $cost_details[$c_account->name]['third'] =  $this->accountBalanceQuery($location_id, $third_statement_start_date, $third_statement_end_date, $c_account->id);
                $cogsThird += $cost_details[$c_account->name]['third'];
            }
            // @eng END 9/2 2359
            
            /* expense of sale section */
            $expense_details = [];
            $cog_group_id = AccountGroup::getGroupByName('COGS Account Group');
            $get_expense_type_id = AccountType::getAccountTypeIdOfType('Expenses', $business_id);
            $expense_accounts = Account::where('account_type_id', $get_expense_type_id)->where('asset_type', '!=', $cog_group_id->id)->get();
            foreach ($expense_accounts as $e_account) {
                $expense_details[$e_account->name]['first'] =  $this->accountBalanceQuery($location_id, $first_statement_start_date, $first_statement_end_date, $e_account->id);
                $expense_details[$e_account->name]['second'] =  $this->accountBalanceQuery($location_id, $second_statement_start_date, $second_statement_end_date, $e_account->id);
                $expense_details[$e_account->name]['third'] =  $this->accountBalanceQuery($location_id, $third_statement_start_date, $third_statement_end_date, $e_account->id);
            }

            /* direct expense */
            $direct_expenses = [];
            $cog_group_id = AccountGroup::getGroupByName('Direct Expense');
            // $get_direct_type_id = AccountType::getAccountTypeIdOfType('Expenses', $business_id);
            $direct_accounts = Account::where('asset_type',  $cog_group_id->id)->where('business_id', $business_id)->get();
            // @eng START 9/2 2359
            $directExpenseFirst = 0;
            $directExpenseSecond = 0;
            $directExpenseThird = 0;
            foreach ($direct_accounts as $d_account) {
                $direct_expenses[$d_account->name]['first'] =  $this->accountBalanceQuery($location_id, $first_statement_start_date, $first_statement_end_date, $d_account->id);
                $directExpenseFirst += $direct_expenses[$d_account->name]['first'];
                $direct_expenses[$d_account->name]['second'] =  $this->accountBalanceQuery($location_id, $second_statement_start_date, $second_statement_end_date, $d_account->id);
                $directExpenseSecond += $direct_expenses[$d_account->name]['second'];
                $direct_expenses[$d_account->name]['third'] =  $this->accountBalanceQuery($location_id, $third_statement_start_date, $third_statement_end_date, $d_account->id);
                $directExpenseThird += $direct_expenses[$d_account->name]['third'];
            }
            // @eng END 9/2 2359
            
            //gross profit
            //first
            $sell_details_first = $this->transactionUtil->getSellTotals(
                $business_id,
                $first_statement_start_date,
                $first_statement_end_date,
                $location_id
            );
            $total_sell_first = !empty($sell_details_first['total_sell_exc_tax']) ? $sell_details_first['total_sell_exc_tax'] : 0;

            $total_sale_cost_first = $this->transactionUtil->getSaleCost($business_id, $first_statement_start_date, $first_statement_end_date)->total_sale_cost;

            $direct_expense_balance_first = Account::leftjoin('account_transactions as AT', function ($join) {
                $join->on('AT.account_id', '=', 'accounts.id');
                $join->whereNull('AT.deleted_at');
            })
                ->leftjoin('transactions', 'AT.transaction_id', 'transactions.id')
                ->where('accounts.business_id', $business_id)
                ->where('accounts.asset_type', $cog_group_id->id)
                ->where('transactions.type', 'sell')
                ->where('accounts.visible', 1)->notClosed()
                ->whereDate('AT.operation_date', '>=', $first_statement_start_date)
                ->whereDate('AT.operation_date', '<=', $first_statement_end_date)
                ->select([
                    DB::raw("SUM( IF(AT.type='credit', amount, -1*amount) ) as sale_income_balance"),
                    DB::raw("SUM( IF(AT.type='credit', -1*amount, amount) ) as direct_expense_balance"),
                ])->first();
            
            
            // $gross_profit['first'] = $total_sell_first - $total_sale_cost_first - (isset($direct_expense_balance_first) ? $direct_expense_balance_first->direct_expense_balance : 0); // @eng 9/2 2359
            $gross_profit['first'] = $totIncomeFirst - $directExpenseFirst - $cogsFirst; // @eng 9/2 2359
            

            //second
            $sell_details_second = $this->transactionUtil->getSellTotals(
                $business_id,
                $second_statement_start_date,
                $second_statement_end_date,
                $location_id
            );
            $total_sell_second = !empty($sell_details_second['total_sell_exc_tax']) ? $sell_details_second['total_sell_exc_tax'] : 0;

            $total_sale_cost_second = $this->transactionUtil->getSaleCost($business_id, $second_statement_start_date, $second_statement_end_date)->total_sale_cost;

            $direct_expense_balance_second = Account::leftjoin('account_transactions as AT', function ($join) {
                $join->on('AT.account_id', '=', 'accounts.id');
                $join->whereNull('AT.deleted_at');
            })
                ->leftjoin('transactions', 'AT.transaction_id', 'transactions.id')
                ->where('accounts.business_id', $business_id)
                ->where('accounts.asset_type', $cog_group_id->id)
                ->where('transactions.type', 'sell')
                ->where('accounts.visible', 1)->notClosed()
                ->whereDate('AT.operation_date', '>=', $second_statement_start_date)
                ->whereDate('AT.operation_date', '<=', $second_statement_end_date)
                ->select([
                    DB::raw("SUM( IF(AT.type='credit', amount, -1*amount) ) as sale_income_balance"),
                    DB::raw("SUM( IF(AT.type='credit', -1*amount, amount) ) as direct_expense_balance"),
                ])->first();

            //$gross_profit['second']=$total_sell_second - $total_sale_cost_second - (isset($direct_expense_balance_second) ? $direct_expense_balance_second->direct_expense_balance : 0); // @eng 9/2 2359
             $gross_profit['second'] = $totIncomeSecond - $directExpenseSecond - $cogsSecond; // @eng 9/2 2359

            //third
            $sell_details_third = $this->transactionUtil->getSellTotals(
                $business_id,
                $third_statement_start_date,
                $third_statement_end_date,
                $location_id
            );
            $total_sell_third = !empty($sell_details_third['total_sell_exc_tax']) ? $sell_details_third['total_sell_exc_tax'] : 0;

            $total_sale_cost_third = $this->transactionUtil->getSaleCost($business_id, $third_statement_start_date, $third_statement_end_date)->total_sale_cost;

            $direct_expense_balance_third = Account::leftjoin('account_transactions as AT', function ($join) {
                $join->on('AT.account_id', '=', 'accounts.id');
                $join->whereNull('AT.deleted_at');
            })
                ->leftjoin('transactions', 'AT.transaction_id', 'transactions.id')
                ->where('accounts.business_id', $business_id)
                ->where('accounts.asset_type', $cog_group_id->id)
                ->where('transactions.type', 'sell')
                ->where('accounts.visible', 1)->notClosed()
                ->whereDate('AT.operation_date', '>=', $third_statement_start_date)
                ->whereDate('AT.operation_date', '<=', $third_statement_end_date)
                ->select([
                    DB::raw("SUM( IF(AT.type='credit', amount, -1*amount) ) as sale_income_balance"),
                    DB::raw("SUM( IF(AT.type='credit', -1*amount, amount) ) as direct_expense_balance"),
                ])->first();

            // $gross_profit['third'] = $total_sell_third - $total_sale_cost_third - (isset($direct_expense_balance_third) ? $direct_expense_balance_third->direct_expense_balance : 0); // @eng 9/2 2359
            $gross_profit['third'] = $totIncomeThird - $directExpenseThird - $cogsThird; // @eng 9/2 2359


            /* Operating Expenses  */
            $operating_expense_details = [];
             // @eng START 9/2 2307
            // $cog_group_id = AccountGroup::getGroupByName('COGS Account Group')->pluck('id')->first();  // @eng 9/2 2307
            // $tax_group_id = AccountGroup::getGroupByName('Tax')->pluck('id')->first(); // @eng 9/2 2307
            // $direct_group_id = AccountGroup::getGroupByName('Direct Expense')->pluck('id')->first(); // @eng 9/2 2307
            // $get_expense_type_id = AccountType::getAccountTypeIdOfType('Expenses', $business_id); // @eng 9/2 2307
            $get_expense_type_id = AccountType::where('name', '=', 'Expenses')->where('business_id', $business_id)->pluck('id')->first(); // @eng 2307
            $cog_group_id = AccountGroup::where('name', '=', 'COGS Account Group')->where('business_id', $business_id)->pluck('id')->first();
            $tax_group_id = AccountGroup::where('name', '=', 'Tax')->where('business_id', $business_id)->pluck('id')->first();
            $direct_group_id = AccountGroup::where('name', '=', 'Direct Expense')->where('business_id', $business_id)->pluck('id')->first();
            $operating_accounts = Account::where('account_type_id', $get_expense_type_id)
                ->where('business_id', $business_id)
                ->whereNotIn('asset_type', [$cog_group_id, $tax_group_id, $direct_group_id])
                ->get();
            // @eng END 9/2 2307
            foreach ($operating_accounts as $o_account) {
                $operating_expense_details[$o_account->name]['first'] =  $this->accountBalanceQuery($location_id, $first_statement_start_date, $first_statement_end_date, $o_account->id);
                $operating_expense_details[$o_account->name]['second'] =  $this->accountBalanceQuery($location_id, $second_statement_start_date, $second_statement_end_date, $o_account->id);
                $operating_expense_details[$o_account->name]['third'] =  $this->accountBalanceQuery($location_id, $third_statement_start_date, $third_statement_end_date, $o_account->id);
            }


            /* tax group */
            $tax_details = [];
            // $tax_group_id = AccountGroup::getGroupByName('Tax Group'); // @eng 9/2 2359
            $tax_group_id = AccountGroup::where('name', '=', 'Tax')->where('business_id', '=', $business_id)->pluck('id'); // @eng 9/2 2359
            $tax_accounts = Account::where('asset_type', $tax_group_id)->get();
            foreach ($tax_accounts as $t_account) {
                $tax_details[$t_account->name]['first'] =  $this->accountBalanceQuery($location_id, $first_statement_start_date, $first_statement_end_date, $t_account->id);
                $tax_details[$t_account->name]['second'] =  $this->accountBalanceQuery($location_id, $second_statement_start_date, $second_statement_end_date, $t_account->id);
                $tax_details[$t_account->name]['third'] =  $this->accountBalanceQuery($location_id, $third_statement_start_date, $third_statement_end_date, $t_account->id);
            }

            return view('account_reports.partials.income_statement_details')->with(compact(
                'account_access',
                'income_details',
                'cost_details',
                'expense_details',
                'direct_expenses',
                'gross_profit',
                'operating_expense_details',
                'tax_details',
                'dates'
            ));
        }
        
        
        $business_locations = BusinessLocation::where('business_id', $business_id)->pluck('name', 'id');
        
        $selectedbusiness = BusinessLocation::where('business_id', $business_id)->first();
        
        if (!empty($selectedbusiness)) {
            $selectedID = $selectedbusiness->id;
        }else{
            $selectedID = ''; 
        }
        return view('account_reports.income_statement')->with(compact('selectedID',
            'business_locations'
        ));
    }

    public function accountBalanceQuery($location_id = null, $start_date, $end_date, $account_id)
    {
        $business_id = session()->get('user.business_id');

        $account_type_id = Account::where('id', $account_id)->first()->account_type_id;
        $account_type_name = AccountType::where('id', $account_type_id)->first();

        $query = Account::leftjoin('account_transactions as AT', 'AT.account_id', '=', 'accounts.id')
            ->leftjoin(
                'transactions',
                'AT.transaction_id',
                '=',
                'transactions.id'
            )
            ->where('accounts.id', $account_id)
            ->where('accounts.business_id', $business_id)
            ->whereNull('AT.deleted_at')
            ->whereDate('AT.operation_date', '>=', $start_date)
            ->whereDate('AT.operation_date', '<=', $end_date);
        if (!empty($location_id)) {
            //$query->where('transactions.location_id', $location_id);
        }

        if (strpos($account_type_name, "Assets") !== false || strpos($account_type_name, "Expenses") !== false) {
            $query->select([
                DB::raw("SUM( IF(AT.type='credit', -1 * amount, amount) ) as balance")
            ]);
        } else {
            $query->select([
                DB::raw("SUM( IF(AT.type='debit',-1 * amount,  amount) ) as balance")
            ]);
        }

        $account_details =  $query->first();
        if (!empty($account_details)) {
            return $account_details->balance;
        }
        return 0;
    }
}
