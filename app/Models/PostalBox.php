<?php

namespace App\Models;

use App\Models\Monster;
use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostalBox extends Model
{
    use CrudTrait;
    use LogsActivity;

    protected $table = 'postalboxes';
    public $timestamps = false;

    protected $fillable = [
        'monster_id',
        'postal_name',
    ];

    public function monster(): BelongsTo
    {
        return $this->belongsTo(Monster::class, 'monster_id');
    }
}
