<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
   use HasFactory;

   protected $fillable = [
      'name', 'slug', 'description', 'image', 'price', 'category_id'
   ];

   public function category()
   {
      return $this->belongsTo(Category::class);
   }

   public function orders()
   {
      return $this->belongsToMany(Order::class);
   }

   public function getRouteKeyName()
   {
      return 'slug';
   }
}
