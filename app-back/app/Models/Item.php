<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'hasVoucher',
        'isAvailable',
        'user_id',
        'store_id'
    ];

    public function item_store()
    {
        $this->belongsTo(Store::class, 'store_id');
    }

    public function item_user()
    {
        $this->belongsTo(User::class, 'user_id');
    }
}
`