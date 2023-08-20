<?php

namespace App\Models;

use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Universe extends Model
{
    use CrudTrait;
    use LogsActivity;

    protected $table = 'universes';
    public $timestamps = false;

    protected $fillable = [
        'title',
    ];

    public function universable(): MorphTo
    {
        return $this->morphTo();
    }
}
