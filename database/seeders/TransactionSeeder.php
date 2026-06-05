<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Kunin ang unang User sa database (yung account na ginawa mo)
        $user = User::first();

        if (!$user) {
            $this->command->error("Walang User na nahanap! Mag-register ka muna ng account sa browser bago i-run ito.");
            return;
        }

        // 2. Gumawa ng mga sample categories para sa user na ito
        $salaryCat = Category::firstOrCreate(['user_id' => $user->id, 'name' => 'Salary', 'type' => 'income']);
        $foodCat = Category::firstOrCreate(['user_id' => $user->id, 'name' => 'Food & Groceries', 'type' => 'expense']);
        $billsCat = Category::firstOrCreate(['user_id' => $user->id, 'name' => 'Utilities & Bills', 'type' => 'expense']);
        $transpoCat = Category::firstOrCreate(['user_id' => $user->id, 'name' => 'Transport', 'type' => 'expense']);

        // 3. Burahin muna ang mga dating transactions ng user para hindi mag-duplicate
        Transaction::where('user_id', $user->id)->delete();

        // 4. Magpasok ng 5 magagandang sample transactions
        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $salaryCat->id,
            'description' => 'Monthly Freelance Paycheck',
            'amount' => 2500.00,
            'type' => 'income',
            'transaction_date' => Carbon::now()->format('Y-m-d'),
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $foodCat->id,
            'description' => 'Weekly Grocery at SM',
            'amount' => 125.50,
            'type' => 'expense',
            'transaction_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $billsCat->id,
            'description' => 'Meralco Electric Bill',
            'amount' => 85.00,
            'type' => 'expense',
            'transaction_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $transpoCat->id,
            'description' => 'Gasoline Refuel',
            'amount' => 45.00,
            'type' => 'expense',
            'transaction_date' => Carbon::now()->subDays(3)->format('Y-m-d'),
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $foodCat->id,
            'description' => 'Dinner out with Friends',
            'amount' => 65.20,
            'type' => 'expense',
            'transaction_date' => Carbon::now()->subDays(4)->format('Y-m-d'),
        ]);

        $this->command->info("Success! 5 Sample transactions added to your dashboard.");
    }
}