<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'mobile',
        'password',
        'otp'
    ];

    protected $attributes = ['otp' => 0];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp' ,
        'created_at',
        'updated_at',
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
     function category(): HasMany
    {
        return $this->hasMany(Category::class,);
    }
    function product(): HasMany
    {
        return $this->hasMany(Product::class,);
    }
    function invoice(): HasMany
    {
        return $this->hasMany(Invoice::class,);
    }
    function product_invoice(): HasMany
    {
        return $this->hasMany(InvoiceProduct::class,);
    }
    function customer(): HasMany
    {
        return $this->hasMany(Customer::class,);
    }

}
