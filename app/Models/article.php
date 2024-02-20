<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'body',
        'user_id',
        'category_id',
        'image',
        'status',
        'view_count',
        'published_date',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
    //category

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}
