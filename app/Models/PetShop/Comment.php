<?php

namespace App\Models\PetShop;

use App\User;
use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    use CrudTrait;
    use LogsActivity;
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'body',
        'commentable_type',
        'commentable_id',
        'user_id',
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
