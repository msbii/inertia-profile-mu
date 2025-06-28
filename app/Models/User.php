<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    //guarded = apa saja yg ga boleh diisi
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function kajians()
    {
        return $this->hasMany(Kajian::class);
    }
    public function roleRequest()
    {
        return $this->hasOne(RoleRequest::class);
    }
    // public function roleRequests()
    // {
    //     return $this->hasMany(RoleRequest::class);
    // }

    public function scopeFilter($query, array $filters)
    {

        //query filter
        $query->when($filters['search'] ?? false, function($query, $search){
            return $query->where('username', 'LIKE', '%' . $search . '%' )->orWhere('email', 'LIKE', '%' . $search . '%');
        });

    }
}
