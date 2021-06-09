<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    protected $table = 'cards';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'created_at',
        'updated_at'
    ];

    public function users(){
        return $this->belongsToMany(User::class,  'cards_user', 'card_id', 'user_id')->using(CardUser::class);
    }

    public function attributes(){
        return $this->hasMany(CardAttribute::class,'card_id','id');
    }
}
