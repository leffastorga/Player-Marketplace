<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledBuys extends Model
{
    use HasFactory;
    protected $table = 'scheduled_buys';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'card_id',
        'user_id_buyer',
        'date_transaction',
        'created_at',
        'updated_at'
    ];
}
