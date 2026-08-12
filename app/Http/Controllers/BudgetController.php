<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\StreamedResponse;

class BudgetController extends Controller
{
    public function index(Request $request)
    {
        $query = Expense::query();

        if ($request->filled('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }

        if ($request->filled('month')) {
            $query->whereRaw("TO_CHAR(expense_date, 'YYYY-MM') = ?", [$request->month]);
        }

        $expenses = $query->orderBy('expense_date', 'desc')->orderBy('created_at', 'desc')->get();
        $totalSpending = $expenses->sum('amount');

        // Categories available
        $availableCategories = ['Food', 'Transport', 'Utilities', 'Groceries', 'Operations', 'Equipment', 'Other'];

        // Group by category for Pie Chart
        $categoryBreakdown = $expenses->groupBy('category')->map(function ($items) {
            return $items->sum('amount');
        });

        // Group by Month for Line/Area Chart
        $monthlyTrend = Expense::select(
            DB::raw("TO_CHAR(expense_date, 'YYYY-MM') as month_label"),
            DB::raw("SUM(amount) as total")
        )
        ->groupBy('month_label')
        ->orderBy('month_label', 'asc')
        ->get();

        // Available Months for Filter Dropdown
        $availableMonths = Expense::select(DB::raw("TO_CHAR(expense_date, 'YYYY-MM') as month_val"))
            ->distinct()
            ->orderBy('month_val', 'desc')
            ->pluck('month_val');

        return view('modules.budget.index', compact(
            'expenses',
            'totalSpending',
            'availableCategories',
            'categoryBreakdown',
            'monthlyTrend',
            'availableMonths'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'expense_date' => 'required|date',
            'category' => 'required|string',
            'amount' => 'required|numeric|min:0.01|max:999999999999.99',
            'description' => 'nullable|string|max:255',
        ]);

        Expense::create([
            'expense_date' => $request->expense_date,
            'category' => $request->category,
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Expense recorded successfully!');
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return redirect()->back()->with('success', 'Expense deleted successfully!');
    }

    public function exportCsv(): StreamedResponse
    {
        $fileName = 'expenses_export_' . date('Y-m-d') . '.csv';
        $expenses = Expense::orderBy('expense_date', 'desc')->get();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $callback = function () use ($expenses) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Date', 'Category', 'Description', 'Amount']);

            foreach ($expenses as $expense) {
                fputcsv($file, [
                    $expense->expense_date->format('Y-m-d'),
                    $expense->category,
                    $expense->description ?? '',
                    $expense->amount
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $handle = fopen($file->getRealPath(), 'r');
        $header = fgetcsv($handle);

        $count = 0;
        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            if (count($row) >= 4) {
                $date = date('Y-m-d', strtotime($row[0]));
                $category = trim($row[1]);
                $description = trim($row[2]);
                $amount = floatval($row[3]);

                if ($amount > 0 && !empty($category)) {
                    Expense::create([
                        'expense_date' => $date,
                        'category' => $category,
                        'description' => $description,
                        'amount' => $amount,
                    ]);
                    $count++;
                }
            }
        }
        fclose($handle);

        return redirect()->back()->with('success', "$count expenses imported successfully!");
    }
}
