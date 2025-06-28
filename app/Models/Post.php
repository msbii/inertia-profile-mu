<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class post extends Model
{
    use HasFactory, Sluggable;

    //variabel yg tidak bole diisi
    protected $guarded = ['id'];
    protected $load = ['category', 'user'];//n+1 problem

    
    // public function scopeFilter($query, array $filters)
    // {
    //     if (isset($filters['search']) ? $filters['search'] : false) {
    //        return $query->where('title', 'LIKE', '%' . $filters['search'] . '%' )
    //        ->orWhere('body', 'LIKE', '%' . $filters['search'] . '%');
    //     }
 
    // }
    public function scopeFilter($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $query->where(function ($query) use ($filters) {
                $query->where('title', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('body', 'like', '%' . $filters['search'] . '%');
            });
        }

        if ($filters['category'] ?? false) {
            $query->whereHas('category', fn ($q) =>
                $q->where('slug', $filters['category'])
            );
        }

        if ($filters['user'] ?? false) {
            $query->whereHas('author', fn ($q) =>
                $q->where('username', $filters['user'])
            );
        }
    }
    public function  author()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //agar route resource dapat menggunakan slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    //Membuat slug otomatis
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
