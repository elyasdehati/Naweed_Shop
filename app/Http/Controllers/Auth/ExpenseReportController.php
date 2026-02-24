<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use DateTime;
use Illuminate\Http\Request;

class ExpenseReportController extends Controller
{

    public function AllReport() {
        return view('backend.report.all_report');
    }

    public function SearchByDate(Request $request)
{
    $date = new DateTime($request->date);
    $formatDate = $date->format('Y-m-d');

    $expenses = Expense::with('employee')
        ->whereDate('date', $formatDate)   // ← IMPORTANT PART
        ->get();

    return view('backend.report.search_by_data', compact('expenses'));
}

    public function AllInvoice($id)
{
    $expense = Expense::with('employee')->findOrFail($id);

    return view('backend.report.all_invoice', compact('expense'));
}

public function AllByMonth(Request $request)
{
    $request->validate([
        'month' => 'required'
    ]);

    $expenses = Expense::with('employee')
        ->whereMonth('date', $request->month)
        ->get();

    return view('backend.report.search_all_month', compact('expenses'));
}

public function AllByYear(Request $request)
{
    $request->validate([
        'year' => 'required'
    ]);

    $expenses = Expense::with('employee')
        ->selectRaw('employee_id, COUNT(*) as total_expenses, SUM(amount) as total_amount')
        ->whereYear('date', $request->year)
        ->groupBy('employee_id')
        ->get();

    return view('backend.report.search_all_year', compact('expenses'));
}
    
}
