<?php

namespace App\Models\PetShop;

use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use CrudTrait;
    use LogsActivity;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'owner_id',
        'series',
        'number',
        'issuance_date',
        'due_date',
    ];

    protected $casts = [
        'id'            => 'integer',
        'owner_id'      => 'integer',
        'issuance_date' => 'date',
        'due_date'      => 'date',
    ];

    protected $appends = [
        'total',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class, 'owner_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function getTotalAttribute()
    {
        return $this->items->sum('subtotal');
    }
}
