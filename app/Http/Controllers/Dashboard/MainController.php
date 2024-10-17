<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Expenses\Expense;
use Illuminate\Http\Request;
// Models
use App\Models\Invoices\Invoice;
use Illuminate\Support\Facades\DB;

class MainController extends Controller {

    public function index() {
        $this_year = now()->year;
        if(request()->has('year') && !empty(request('year'))){
            $this_year = request('year');
        }
        // Retrieve all relevant orders for the current year in a single query
        $invoices = Invoice::query()->whereYear('invoices.created_at', $this_year)->where('invoices.status', 'paid')
            ->join('invoices_activities', 'invoices.id', '=', 'invoices_activities.invoice_id')
            ->select(
                DB::raw('MONTH(invoices.created_at) as invoice_month'),
                DB::raw('SUM(invoices_activities.price) as total_price')
            )->groupBy('invoice_month')->get();

        $expenses = Expense::query()->whereYear('created_at', $this_year)->where('status', 'paid')
            ->select(
                DB::raw('MONTH(created_at) as expense_month'),
                DB::raw('SUM(price) as total_price')
            )->groupBy('expense_month')->get();

        $all_months = [
            '1'=>__('January'), '2'=>__('February'), '3'=>__('March'),
            '4'=>__('April'), '5'=>__('May'), '6'=>__('June'),
            '7'=>__('July'), '8'=>__('August'), '9'=>__('September'),
            '10'=>__('October'), '11'=>__('November'), '12'=>__('December')
        ];

        $invoicesCharts = [];

        foreach ($all_months as $key => $value) {
            $monthInvoice = $invoices->firstWhere('invoice_month', $key);
            $monthExpenses = $expenses->firstWhere('expense_month', $key);
            $invoicesCharts[$key]['month'] = __($value);
            $invoicesCharts[$key]['invoices_total'] = $monthInvoice ? $monthInvoice->total_price : 0;
            $invoicesCharts[$key]['expense_month'] = $monthExpenses ? $monthExpenses->total_price : 0;
            $invoicesCharts[$key]['net_month'] = $invoicesCharts[$key]['invoices_total'] - $invoicesCharts[$key]['expense_month'];
        }
        $years = range(2022, now()->year);
        return view('admin.index',get_defined_vars());
    }
    public function maintenance() {
        return view('admin.maintenance',get_defined_vars());
    }
}
