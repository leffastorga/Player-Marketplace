<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionBuys extends Model
{
    use HasFactory;
    protected $table = 'transaction_buys';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'card_id',
        'user_id_seller',
        'user_id_buyer',
        'price',
        'date_transaction',
        'scheduled',
        'created_at',
        'updated_at'
    ];
}
