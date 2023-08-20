<?php

namespace App\Models;

use App\Models\Icon;
use App\Models\Product;
use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\NewsCRUD\app\Models\Article;
use Backpack\NewsCRUD\app\Models\Category;
use Backpack\NewsCRUD\app\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Permission\Traits\HasRoles;

class Dummy extends Model
{
    use CrudTrait;
    use LogsActivity;
    use HasRoles;

    protected $table = 'dummies';
    protected $guarded = ['id'];

    protected $casts = [
        'extras' => 'array',
    ];

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'select2_from_ajax');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'select');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'monster_category', 'monster_id', 'category_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'monster_tag', 'monster_id', 'category_id');
    }

    public function icon(): BelongsTo
    {
        return $this->belongsTo(Icon::class, 'icon_id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'monster_product', 'monster_id', 'product_id');
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'monster_article', 'monster_id', 'article_id');
    }
}
