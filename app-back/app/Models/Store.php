<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'photo',
        'description',
        'user_id'
    ];

    public function store_owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function store_item()
    {
        return $this->hasMany(Item::class, 'store_id');
    }
}
