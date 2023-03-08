<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Get all of the products that are assigned this tag.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags');
    }
}
