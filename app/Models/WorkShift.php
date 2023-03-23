<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkShift extends Model
{
    use HasFactory;

    protected $fillable = ['start','end','active'];

    public function shift(): HasMany
    {
        return $this->hasMany(UserOnShift::class);

    }

    public function orders()
    {

        return $this->hasMany(Order::class);

    }


}
