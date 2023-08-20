<?php

namespace App\Models;

use App\Models\Monster;
use App\User;
use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Graffiti extends Model
{
    use CrudTrait;
    use LogsActivity;
    use HasFactory;

    protected $table = 'graffitis';

    protected $fillable = [
        'image',
        'user_id',
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function monsters(): HasMany
    {
        return $this->hasMany(Monster::class, 'graffiti_id');
    }
}
