<?php

namespace App\Models;

use App\Models\Recommend;
use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Venturecraft\Revisionable\RevisionableTrait;

class Icon extends Model
{
    use CrudTrait;
    use LogsActivity;
    use RevisionableTrait;

    protected $table = 'icons';

    protected $fillable = [
        'name',
        'icon',
    ];

    public function identifiableAttribute()
    {
        return 'icon';
    }

    public function recommends(): MorphToMany
    {
        return $this->morphToMany(Recommend::class, 'recommendable');
    }
}
