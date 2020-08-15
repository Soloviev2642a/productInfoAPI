<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'external_id'];

    public function products() {
        return $this->belongsToMany('App\Product', 'product_category');
    }
}