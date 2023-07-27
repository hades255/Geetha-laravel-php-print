<?php  
namespace App\Http\Controllers\Chequer;
use App\Http\Models\PrintedChequeDetailt;

   class ChequerDashboardController extends Controller
   {
  public function chequerDashboard()
    {        
        // $date=date('Y-m-d');
        $current_week = PrintedChequeDetailt::select("*")->whereBetween('created_at',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $current_month = PrintedChequeDetailt::select('*')->whereMonth('created_at', Carbon::now()->month)->get();
        
        $current_day = PrintedChequeDetailt::whereDate('created_at', Carbon::today())->get();

        $previous_month = PrintedChequeDetailt::whereMonth('created_at', '=', Carbon::now()->subMonth()->month);
        $current_year=PrintedChequeDetailt::whereYear('created_at', date('Y'))->get();
        $current_year = PrintedChequeDetailt::whereYear('created_at', now()->subYear()->year)->get();

        return view('chequer/chequer_dashboard/chequer_dashboard');
    }
}