<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
    protected $fillable = ['name', 'description', 'price', 'quantity', 'external_id'];
    protected $hidden = ['updated_at'];

    public function categories() {
        return $this->belongsToMany('App\Category', 'product_category');
    }
}