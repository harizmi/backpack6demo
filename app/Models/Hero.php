<?php

namespace App\Models;

use App\Models\Monster;
use App\Models\Story;
use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Hero extends Model
{
    use CrudTrait;
    use LogsActivity;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'story_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function monster(): HasOne
    {
        return $this->hasOne(Monster::class);
    }

    public function stories(): BelongsToMany
    {
        return $this->belongsToMany(Story::class, 'monsters')
            ->withPivot((new Monster())->getFillable());
    }
}
