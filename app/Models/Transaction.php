<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * Ang mga attributes na pinapayagang masulatan ng data (Mass Assignable).
     * Ito ang pumipigil sa 'MassAssignmentException' error kapag nag-save ka ng transaction.
     */
    protected $fillable = [
        'user_id', 
        'category_id', 
        'description', 
        'amount', 
        'type', 
        'transaction_date'
    ];

    /**
     * Relasyon: Ang bawat transaksyon ay pagmamay-ari ng isang User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasyon: Ang bawat transaksyon ay may nakatalagang Kategorya.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}