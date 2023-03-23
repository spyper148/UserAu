<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function table(): BelongsTo
    {

        $this->belongsTo(Table::class);

    }

    public function user(): BelongsTo
    {

        $this->belongsTo(User::class);

    }

    public function shift(): BelongsTo
    {

        $this->belongsTo(WorkShift::class);

    }

    public function order(): HasMany
    {

        $this->hasMany(OrderList::class);

    }

    public function orders()
    {

        $this->belongsTo(WorkShift::class);

    }
}
