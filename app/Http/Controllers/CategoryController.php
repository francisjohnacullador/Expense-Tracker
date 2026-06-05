<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    // Ipakita ang page na may hiwalay na collections para sa Expenses at Income
    public function index()
    {
        $allCategories = Category::where('user_id', Auth::id())->get();
        
        // Paghiwalayin ang data para sa view
        $expenses = $allCategories->where('type', 'expense');
        $incomes = $allCategories->where('type', 'income');

        return view('categories', compact('expenses', 'incomes'));
    }

    // I-save ang bagong kategorya
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:income,expense'],
        ]);

        Category::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'type' => $request->type,
        ]);

        return redirect()->back()->with('success', 'Category added successfully!');
    }

    // Function para sa Delete Button
    public function destroy($id)
    {
        $category = Category::where('user_id', Auth::id())->findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
}