<?php

namespace App\Models\PetShop;

use App\Models\PetShop\Owner;
use App\Models\PetShop\Pet;
use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Badge extends Model
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

    public function owners(): MorphToMany
    {
        return $this->morphedByMany(Owner::class, 'badgeable');
    }

    public function pets(): MorphToMany
    {
        return $this->morphedByMany(Pet::class, 'badgeable');
    }
}
