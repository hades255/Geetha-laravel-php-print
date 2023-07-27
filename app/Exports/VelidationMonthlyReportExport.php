<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class VelidationMonthlyReportExport implements FromView,WithTitle
{
    public $period;
    public $total_sales;
    public $sales_income_amount;
    public $income_accounts;
    public $received_payments;
    public $excess_total;
    public $shortage_total;
    public $credit_sales;
    public $expense_in_settlement;
    public $direct_expens;
    public $purchase_by_cash;
    public $total_collection;
    public $difference;
    public $credit_received_payments;
    public $today_total_cash;
    public $previous_day_cash_balance;
    public $total_cash_balance;
    public $cash_deposit;
    public $cash_balance_difference;
    public $location_details;
    public $work_shift;
    public $print_s_date;
    public $print_e_date;

    public $data; 

    public $key = [

        'period',

        'total_sales',

        'sales_income_amount',

        'income_accounts',

        'received_payments',

        'excess_total',

        'shortage_total',

        'credit_sales',

        'expense_in_settlement',

        'direct_expens',

        'purchase_by_cash',

        'total_collection',

        'difference',

        'credit_received_payments',

        'today_total_cash',

        'previous_day_cash_balance',

        'total_cash_balance',

        'cash_deposit',

        'cash_balance_difference',

        'location_details',

        'work_shift',

        'print_s_date',

        'print_e_date'
    ]; 
    

    public function __construct(
        $period,
        $total_sales,
        $sales_income_amount,
        $income_account,
        $received_payments,
        $excess_total,
        $shortage_total,
        $credit_sales,
        $expense_in_settlement,
        $direct_expens,
        $purchase_by_cash,
        $total_collection,
        $difference,
        $credit_received_payments,
        $today_total_cash,
        $previous_day_cash_balance,
        $total_cash_balance,
        $cash_deposit,
        $cash_balance_difference,
        $location_details,
        $work_shift,
        $print_s_date,
        $print_e_date
    ){
        $this->period = $period;
        $this->total_sales = $total_sales;
        $this->sales_income_amount =$sales_income_amount ;
        $this->income_accounts = $income_account;
        $this->received_payments = $received_payments;
        $this->excess_total = $excess_total;
        $this->shortage_total = $shortage_total;
        $this->credit_sales = $credit_sales;
        $this->expense_in_settlement = $expense_in_settlement;
        $this->direct_expens = $direct_expens;
        $this->purchase_by_cash = $purchase_by_cash;
        $this->total_collection = $total_collection;
        $this->difference = $difference;
        $this->credit_received_payments = $credit_received_payments;
        $this->today_total_cash = $today_total_cash;
        $this->previous_day_cash_balance = $previous_day_cash_balance;
        $this->total_cash_balance = $total_cash_balance;
        $this->cash_deposit = $cash_deposit;
        $this->cash_balance_difference = $cash_balance_difference;
        $this->location_details = $location_details;
        $this->work_shift = $work_shift;
        $this->print_s_date = $print_s_date;
        $this->print_e_date = $print_e_date;

    }


    public function view(): View
    {  
        return view('report.Export.ValidationMonthlyReportExport',[
            
            'period'=> $this->period ,

            'total_sales'=> $this->total_sales ,

            'sales_income_amount'=> $this->sales_income_amount ,

            'income_accounts'=> $this->income_accounts ,

            'received_payments'=> $this->received_payments ,

            'excess_total'=> $this->excess_total ,

            'shortage_total'=> $this->shortage_total ,

            'credit_sales'=> $this->credit_sales ,

            'expense_in_settlement'=> $this->expense_in_settlement ,

            'direct_expens'=> $this->direct_expens ,

            'purchase_by_cash'=> $this->purchase_by_cash ,

            'total_collection'=> $this->total_collection ,

            'difference'=> $this->difference ,

            'credit_received_payments'=> $this->credit_received_payments ,

            'today_total_cash'=> $this->today_total_cash ,

            'previous_day_cash_balance'=> $this->previous_day_cash_balance ,

            'total_cash_balance'=> $this->total_cash_balance ,

            'cash_deposit'=> $this->cash_deposit ,

            'cash_balance_difference'=> $this->cash_balance_difference ,

            'location_details'=> $this->location_details ,

            'work_shift'=> $this->work_shift ,

            'print_s_date'=> $this->print_s_date,

            'print_e_date'=> $this->print_e_date,
        ]);
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Velidation Monthly Report';
    }
    
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setEncoding('UTF-8');
            },
        ];
    }

}