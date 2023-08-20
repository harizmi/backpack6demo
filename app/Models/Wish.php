<?php

namespace App\Models;

use App\Models\Country;
use App\Models\Monster;
use App\Models\Universe;
use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Wish extends Model
{
    use CrudTrait;
    use LogsActivity;
    use HasFactory;

    protected $table = 'wishes';

    protected $fillable = [
        'body',
        'monster_id',
        'country_id',
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public function monster(): BelongsTo
    {
        return $this->belongsTo(Monster::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function universes(): BelongsToMany
    {
        return $this->belongsToMany(Universe::class, 'universes_wishes');
    }
}
