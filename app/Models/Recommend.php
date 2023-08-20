<?php

namespace App\Models;

use App\Models\Icon;
use App\Models\Monster;
use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Recommend extends Model
{
    use CrudTrait;
    use LogsActivity;
    use HasFactory;

    protected $table = 'recommends';

    protected $fillable = [
        'title',
    ];

    public function monsters(): MorphToMany
    {
        return $this->morphedByMany(Monster::class, 'recommendable');
    }

    public function icons(): MorphToMany
    {
        return $this->morphedByMany(Icon::class, 'recommendable');
    }
}
