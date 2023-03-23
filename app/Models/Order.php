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

        return $this->belongsTo(Table::class);

    }

    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class);

    }

    public function shift(): BelongsTo
    {

        return $this->belongsTo(WorkShift::class);

    }

    public function order(): HasMany
    {

        return $this->hasMany(OrderList::class);

    }

    public function orders()
    {

        return $this->belongsTo(WorkShift::class);

    }

    public function statusOrder(): BelongsTo
    {

        return $this->belongsTo(StatusOrder::class);

    }
}
