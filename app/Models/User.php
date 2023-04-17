<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'cpf',
        'birth_date',
        'phone',
        'sex',
        'image',
        'is_active',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Str::of($value)->trim()->ucfirst(),
        );
    }

    protected function birthDate(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date('d/m/Y', strtotime($value)),
            set: fn (string $value) => formatDate($value)
        );
    }

    protected function cpf(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => formatCpf($value),
            set: fn (string $value) => trim($value),
        );
    }

    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => formatPhone($value),
            set: fn (string $value) => trim($value),
        );
    }

    protected function email(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => trim($value),
        );
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: function (string $value) {
                if ($value) {
                    return Hash::make($value);
                }
            }
        );
    }
}
