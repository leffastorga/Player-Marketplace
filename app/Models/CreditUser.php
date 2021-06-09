<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditUser extends Model
{
    use HasFactory;
    protected $table = 'credit_user';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'user_id',
        'credit',
        'created_at',
        'updated_at'
    ];
}
