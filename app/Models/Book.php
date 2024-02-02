<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        "title",
        "description",
        "image_url",
        "release_year",
        "price",
        "total_page",
        "category_id",
        "thickness",
    ];

    function category()
    {
        return  $this->belongsTo(Category::class);
    }
}
