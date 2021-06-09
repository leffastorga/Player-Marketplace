<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CardUser extends Pivot
{
    protected $table = 'cards_user';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'card_id',
        'user_id',
        'created_at',
        'updated_at'
    ];
}
