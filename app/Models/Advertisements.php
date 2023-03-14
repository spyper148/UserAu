<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Advertisements extends Model
{
    use HasFactory;
protected $fillable = ['name','description','category_id','updated_at'];

    public function advertisements(): HasMany
    {
        return $this->hasMany(Advertisements::class);
    }
}
