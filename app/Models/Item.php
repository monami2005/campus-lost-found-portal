<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'category_id',
        'location',
        'date',
        'status',
        'type',
        'reward',
        'contact',
        'image',
        'is_featured',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function claims()
    {
        return $this->hasMany(Claim::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
