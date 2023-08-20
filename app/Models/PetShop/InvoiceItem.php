<?php

namespace App\Models\PetShop;

use App\Models\PetShop\Invoice;
use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceItem extends Model
{
    use CrudTrait;
    use LogsActivity;
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'order',
        'description',
        'quantity',
        'unit_price',
    ];

    protected $casts = [
        'id' => 'integer',
        'invoice_id' => 'integer',
        'quantity' => 'float',
        'unit_price' => 'float',
    ];

    protected $appends = [
        'subtotal',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class);
    }

    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->unit_price;
    }
}
