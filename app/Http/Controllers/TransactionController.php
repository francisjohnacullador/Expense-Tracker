<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // 1. Ipakita ang form at ipasa ang mga Categories na ginawa ng user
    public function create()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        return view('create_transaction', compact('categories'));
    }

    // 2. I-save ang transaksyon mula sa form papuntang database
    public function store(Request $request)
    {
        $request->validate([
            'type' => ['required', 'in:income,expense'],
            'category_id' => ['required', 'exists:categories,id'], // Sinisigurong valid ang kategorya
            'description' => ['required', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'transaction_date' => ['required', 'date'],
        ]);

        // Pag-save sa database
        Transaction::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'amount' => $request->amount,
            'type' => $request->type,
            'transaction_date' => $request->transaction_date,
        ]);

        // Pagkatapos ma-save, ibabalik ka sa dashboard na may kasamang green success banner alert
        return redirect()->route('dashboard')->with('success', 'Transaction recorded successfully!');
    }
}