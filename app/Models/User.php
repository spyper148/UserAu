<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'surname',
        'patronymic',
        'login',
        'password',
        'status_id',
        'group_id',
        'api_token',
    ];

    public function group(): BelongsTo
    {

        return $this->belongsTo(Group::class);

    }

    public function status(): BelongsTo
    {

        return $this->belongsTo(Status::class);

    }

    public function shift(): HasMany
    {

        return $this->hasMany(UserOnShift::class);

    }

    public function order(): HasMany
    {

        return $this->hasMany(Order::class);

    }
}
