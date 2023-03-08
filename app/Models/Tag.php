<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get all of the products that are assigned this tag.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tags');
    }
}
