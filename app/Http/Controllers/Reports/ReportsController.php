<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Expense;
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
}
