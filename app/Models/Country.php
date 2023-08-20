<?php

namespace App\Models;

use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use CrudTrait;
    use LogsActivity;

    protected $table = 'countries';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'code',
    ];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }
}
