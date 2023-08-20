<?php

namespace App\Models;

use App\Models\Country;
use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Ball extends Model
{
    use CrudTrait;
    use LogsActivity;
    use HasFactory;

    protected $table = 'balls';

    protected $fillable = [
        'name',
        'country_id',
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public function ballable(): MorphTo
    {
        return $this->morphTo();
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}
