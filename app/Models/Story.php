<?php

namespace App\Models;

use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Story extends Model
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
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function monsters(): HasMany
    {
        return $this->hasMany(Monster::class);
    }

    public function heroes(): BelongsToMany
    {
        return $this->belongsToMany(Hero::class, 'monsters')
            ->withPivot(array_filter((new Monster())->getFillable(), function ($item) {
                // fields that are on fillable but are not part of model table
                $columnsToRemove = ['fake-text', 'fake-switch', 'fake-select', 'fake-checkbox', 'editable_checkbox'];

                return !in_array($item, $columnsToRemove);
            }));
    }
}
