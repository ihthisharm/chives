<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'contact', 'account', 'credit'
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function getRouteKeyName()
    {
        return 'contact';
    }
}
