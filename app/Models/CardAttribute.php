<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardAttribute extends Model
{
    use HasFactory;
    protected $table = 'cards_attribute';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'card_id',
        'attribute_type',
        'attribute_value',
        'created_at',
        'updated_at'
    ];
}
