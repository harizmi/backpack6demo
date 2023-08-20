<?php

namespace App\Models\PetShop;

use App\Models\PetShop\Avatar;
use App\Models\PetShop\Badge;
use App\Models\PetShop\Comment;
use App\Models\PetShop\Owner;
use App\Models\PetShop\Passport;
use App\Models\PetShop\Skill;
use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use CrudTrait;
    use LogsActivity;
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nickname',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function owners(): BelongsToMany
    {
        return $this->belongsToMany(Owner::class)->withPivot('role');
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    public function passport(): HasOne
    {
        return $this->hasOne(Passport::class);
    }

    public function avatar(): MorphOne
    {
        return $this->morphOne(Avatar::class, 'avatarable');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function badges(): MorphToMany
    {
        return $this->morphToMany(Badge::class, 'badgeable')->withPivot('note');
    }
}
