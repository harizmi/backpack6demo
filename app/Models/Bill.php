<?php

namespace App\Models;

use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Bill extends Model
{
    use CrudTrait;
    use LogsActivity;
    use HasFactory;

    protected $table = 'bills';

    protected $fillable = [
        'title',
    ];

    public function monsters(): MorphToMany
    {
        return $this->morphedByMany(Monster::class, 'billable');
    }

    public function icons(): MorphToMany
    {
        return $this->morphedByMany(Icon::class, 'billable');
    }
}
