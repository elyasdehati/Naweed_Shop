<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Sale;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function AllExpensesReport(){
        return view('backend.pages.reports.expenses.all_expenses');
    }

    public function SearchExpensesByDate(Request $request){
        $request->validate([
            'date' => 'required|date',
        ]);

        $allExpenses = Expense::with('employee')
            ->whereDate('date', $request->date)
            ->get();

        $dailyTotal = $allExpenses->sum('amount');

        $expenses = $allExpenses
            ->groupBy(fn($item) => $item->employee_id ?? 0)
            ->map(function($group) {
                $first = $group->first();
                return (object)[
                    'employee_id' => $first->employee_id ?? 0,
                    'last_date' => $group->max('date'),
                    'total_expenses' => $group->count(),
                    'total_amount' => $group->sum('amount'),
                    'employee' => $first->employee ?? null,
                    'all_expenses' => $group,
                ];
            });

        return view('backend.pages.reports.expenses.search_by_date', compact('expenses','dailyTotal'));
    }

    public function AllExpensesInvoice(Request $request, $employee_id = 0){
        $year = $request->year; 
        $month = $request->month;
        $date = $request->date;
        $query = Expense::query();

        if ($year) {
            $query->whereYear('date', $year); 
        }

        if ($month) {
            $query->whereMonth('date', $month);
        }

        if ($date) {
            $query->whereDate('date', $date); 
        }

        if ($employee_id) {
            $query->where('employee_id', $employee_id);
        } else {
            $query->whereNull('employee_id');
        }

        $expenses = $query->with('employee')->get();

        return view('backend.pages.reports.expenses.invoice', compact('expenses'));
    }

    public function AllExpensesByMonth(Request $request){
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
        ]);

        $month = $request->month;

        $allExpenses = Expense::with('employee')
            ->whereMonth('date', $month)
            ->get();

        $monthlyTotal = $allExpenses->sum('amount');

        $expenses = $allExpenses
            ->groupBy(fn($item) => $item->employee_id ?? 0)
            ->map(function($group) {
                $first = $group->first();
                return (object)[
                    'employee_id' => $first->employee_id ?? 0,
                    'last_date' => $group->max('date'),
                    'total_expenses' => $group->count(),
                    'total_amount' => $group->sum('amount'),
                    'employee' => $first->employee ?? null,
                    'all_expenses' => $group,
                ];
            });

        return view('backend.pages.reports.expenses.search_by_month', compact('expenses','monthlyTotal'));
    }

    public function AllExpensesByYear(Request $request){
        $request->validate([
            'year' => 'required|integer|min:2025|max:2030',
        ]);

        $year = $request->year;

        $allExpenses = Expense::with('employee')
            ->whereYear('date', $year)
            ->get();

        $yearlyTotal = $allExpenses->sum('amount');

        $expenses = $allExpenses
            ->groupBy(fn($item) => $item->employee_id ?? 0)
            ->map(function($group) {
                $first = $group->first();
                return (object)[
                    'employee_id' => $first->employee_id ?? 0,
                    'last_date' => $group->max('date'),
                    'total_expenses' => $group->count(),
                    'total_amount' => $group->sum('amount'),
                    'employee' => $first->employee ?? null,
                    'all_expenses' => $group,
                ];
            });

        return view('backend.pages.reports.expenses.search_by_year', compact('expenses','yearlyTotal','year'));
    }

    // -------- All Reports -------
    public function AllReport(){
        return view('backend.pages.reports.all_reports.all_reports');
    }

    public function SearchReportsByDate(Request $request){
        $request->validate([
            'date' => 'required|date',
        ]);

        $date = $request->date;

        // Expenses
        $allExpenses = Expense::with('employee')->whereDate('date', $date)->get();
        $dailyExpenses = $allExpenses
            ->groupBy(fn($item) => $item->employee_id ?? 0)
            ->map(function($group){
                $first = $group->first();
                return (object)[
                    'employee_id' => $first->employee_id ?? 0,
                    'last_date' => $group->max('date'),
                    'total_expenses' => $group->count(),
                    'total_amount' => $group->sum('amount'),
                    'employee' => $first->employee ?? null,
                    'all_expenses' => $group,
                ];
            });
        $dailyExpensesTotal = $allExpenses->sum('amount');

        // Sales
        $sales = Sale::with(['employee','product','category'])
            ->whereDate('created_at', $date)
            ->get();

        $salesTotal = $sales->sum('total');

        // Sales profit (کل سود واقعی هر فروش = فروش کل - خرید کل - هزینه‌ها)
        $salesProfitTotal = $sales->sum(function($sale){
            return $sale->total - (($sale->buy_price * $sale->quantity) + ($sale->charges ?? 0));
        });

        // Sales loss (در صورت نیاز، کل زیان = مجموع فروش - سود واقعی)
        $salesLossTotal = $salesTotal - $salesProfitTotal;

        // Final Amount = سود واقعی فروش - مصارف
        $finalAmount = $salesProfitTotal - $dailyExpensesTotal;

        return view('backend.pages.reports.all_reports.search_by_date', compact(
            'dailyExpenses', 
            'dailyExpensesTotal', 
            'sales', 
            'salesTotal', 
            'salesProfitTotal', 
            'salesLossTotal', 
            'finalAmount', 
            'date'
        ));
    }

    public function AllReportsByMonth(Request $request){
        $request->validate([
            'month' => 'required|integer|min:1|max:12',
        ]);

        $month = $request->month;

        // Expenses
        $allExpenses = Expense::with('employee')->whereMonth('date', $month)->get();
        $dailyExpenses = $allExpenses
            ->groupBy(fn($item) => $item->employee_id ?? 0)
            ->map(function($group){
                $first = $group->first();
                return (object)[
                    'employee_id' => $first->employee_id ?? 0,
                    'last_date' => $group->max('date'),
                    'total_expenses' => $group->count(),
                    'total_amount' => $group->sum('amount'),
                    'employee' => $first->employee ?? null,
                    'all_expenses' => $group,
                ];
            });
        $dailyExpensesTotal = $allExpenses->sum('amount');

        // Sales
        $sales = Sale::with(['employee','product','category'])
            ->whereMonth('created_at', $month)
            ->get();
        $salesTotal = $sales->sum('total');

        // Sales profit & loss
        $salesProfitTotal = $sales->sum('profit');
        $salesLossTotal = $salesTotal - $salesProfitTotal;

        // Final Amount = Sales profit - Expenses
        $finalAmount = $salesProfitTotal - $dailyExpensesTotal;

        return view('backend.pages.reports.all_reports.search_by_month', compact(
            'dailyExpenses', 'dailyExpensesTotal', 'sales', 'salesTotal', 'salesProfitTotal', 'salesLossTotal', 'finalAmount', 'month'
        ));
    }

    public function AllReportsByYear(Request $request){
        $request->validate([
            'year' => 'required|integer|min:2025|max:2030',
        ]);

        $year = $request->year;

        // Expenses
        $allExpenses = Expense::with('employee')
            ->whereYear('date', $year)
            ->get();

        $dailyExpenses = $allExpenses
            ->groupBy(fn($item) => $item->employee_id ?? 0)
            ->map(function($group){
                $first = $group->first();
                return (object)[
                    'employee_id' => $first->employee_id ?? 0,
                    'last_date' => $group->max('date'),
                    'total_expenses' => $group->count(),
                    'total_amount' => $group->sum('amount'),
                    'employee' => $first->employee ?? null,
                    'all_expenses' => $group,
                ];
            });

        $dailyExpensesTotal = $allExpenses->sum('amount');

        // Sales
        $sales = Sale::with(['employee','product','category'])
            ->whereYear('created_at', $year)
            ->get();

        $salesTotal = $sales->sum('total');

        // Final Amount = Sales - Expenses
        $finalAmount = $salesTotal - $dailyExpensesTotal;

        return view('backend.pages.reports.all_reports.search_by_year', compact(
            'dailyExpenses', 'dailyExpensesTotal', 'sales', 'salesTotal', 'finalAmount', 'year'
        ));
    }
}
