<?php

namespace App\Models;

use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostalBoxer extends Model
{
    use CrudTrait;
    use LogsActivity;
    use HasFactory;

    protected $table = 'postalboxers';
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
