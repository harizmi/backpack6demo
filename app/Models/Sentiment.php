<?php

namespace App\Models;

use App\User;
use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Sentiment extends Model
{
    use CrudTrait;
    use LogsActivity;
    use HasFactory;

    protected $table = 'sentiments';

    protected $fillable = [
        'text',
        'user_id',
    ];

    protected $casts = [
        'id' => 'integer',
    ];

    public function sentimentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
