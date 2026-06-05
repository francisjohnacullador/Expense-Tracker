<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Kunin ang lahat ng transactions ng kasalukuyang user
        $transactions = Transaction::where('user_id', $userId)->get();

        // 2. Kalkulahin ang Total Income at Total Expense para sa Total Balance
        $totalIncome = $transactions->where('type', 'income')->sum('amount');
        $totalExpense = $transactions->where('type', 'expense')->sum('amount');
        $totalBalance = $totalIncome - $totalExpense;

        // 3. Kalkulahin ang Income at Expense para lang sa KASALUKUYANG BUWAN
        $currentMonthTransactions = Transaction::where('user_id', $userId)
            ->whereMonth('transaction_date', Carbon::now()->month)
            ->whereYear('transaction_date', Carbon::now()->year)
            ->get();

        $monthlyIncome = $currentMonthTransactions->where('type', 'income')->sum('amount');
        
        // 👇 BINAGO MULA $monthlyExpense PAPUNTANG $monthlyExpenses PARA TUGMA SA BLADE MO 👇
        $monthlyExpenses = $currentMonthTransactions->where('type', 'expense')->sum('amount');

        // 4. Kunin ang huling 5 pinakabagong transaksyon para sa table sa baba
        $recentTransactions = Transaction::where('user_id', $userId)
            ->with('category')
            ->orderBy('transaction_date', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 5. Ipasa ang mga nakwentang data sa iyong dashboard view
        return view('dashboard', compact(
            'totalBalance', 
            'monthlyIncome', 
            'monthlyExpenses', // 👇 NILAGYAN NG 's' SA DULO 👇
            'recentTransactions'
        ));
    }
}