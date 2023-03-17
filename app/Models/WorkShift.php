<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkShift extends Model
{
    use HasFactory;

    protected $fillable = ['start','end','active'];

    public function shift()
    {
        return $this->hasMany(UserOnShift::class);
    }
}
