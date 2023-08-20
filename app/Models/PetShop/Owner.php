<?php

namespace App\Models\PetShop;

use App\Models\PetShop\Avatar;
use App\Models\PetShop\Badge;
use App\Models\PetShop\Comment;
use App\Models\PetShop\Invoice;
use App\Models\PetShop\Pet;
use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Owner extends Model
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

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function pets(): BelongsToMany
    {
        return $this->belongsToMany(Pet::class)->withPivot('role');
    }

    public function avatar(): MorphOne
    {
        return $this->morphOne(Avatar::class, 'avatarable');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable', null, null, 'user_id');
    }

    public function badges(): MorphToMany
    {
        return $this->morphToMany(Badge::class, 'badgeable')->withPivot('note');
    }
}
