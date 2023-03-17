<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class UserOnShift extends Model
{
    use HasFactory;

    protected $fillable = ['shift_id','user_id'];

    public function shift():BelongsTo
    {
        return $this->belongsTo(WorkShift::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
