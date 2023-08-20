<?php

namespace App\Models;

use App\Enums\MonsterStatus;
use App\Models\Address;
use App\Models\Ball;
use App\Models\Bill;
use App\Models\Cave;
use App\Models\Country;
use App\Models\Graffiti;
use App\Models\Hero;
use App\Models\Icon;
use App\Models\PostalBox;
use App\Models\PostalBoxer;
use App\Models\Product;
use App\Models\Recommend;
use App\Models\Sentiment;
use App\Models\Star;
use App\Models\Story;
use App\Models\Universe;
use App\Models\Wish;
use Backpack\ActivityLog\Traits\LogsActivity;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\NewsCRUD\app\Models\Article;
use Backpack\NewsCRUD\app\Models\Category;
use Backpack\NewsCRUD\app\Models\Tag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class Monster extends Model
{
    use CrudTrait;
    use LogsActivity;
    use HasRoles;
    use HasFactory;

    protected $table = 'monsters';

    protected $fillable = ['address_google', 'base64_image', 'browse', 'browse_multiple', 'checkbox', 'wysiwyg', 'color', 'date', 'date_picker', 'easymde', 'start_date', 'end_date', 'datetime', 'datetime_picker', 'email', 'hidden', 'icon_picker', 'image', 'month', 'number', 'float', 'password', 'radio', 'range', 'select', 'select_from_array', 'select2', 'select2_from_ajax', 'select2_from_array', 'summernote', 'table', 'textarea', 'text', 'tinymce', 'upload', 'upload_multiple', 'url', 'video', 'week', 'extras', 'icon_id', 'editable_checkbox', 'fake-text', 'fake-switch', 'fake-checkbox', 'fake-select', 'status', 'features', 'ckeditor', 'dropzone'];

    protected $casts = [
        'address_google' => 'object',
        'video' => 'array',
        'upload_multiple' => 'array',
        'browse_multiple' => 'array',
        'status' => MonsterStatus::class,
        'features' => 'array',
        // optional casts for select from array fields that allow multiple selection
        // 'select_from_array'     => 'array',
        // 'select2_from_array'    => 'array'
    ];

    public $identifiableAttribute = 'text';

    public function openGoogle($crud = false): string
    {
        return '<a class="btn btn-sm btn-link" target="_blank" href="http://google.com?q='.urlencode($this->text).'" data-toggle="tooltip" title="Just a demo custom button."><i class="la la-search"></i> Google it</a>';
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'select2_from_ajax');
    }

    public function wish(): HasOne
    {
        return $this->hasOne(Wish::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function cave(): BelongsTo
    {
        return $this->belongsTo(Cave::class, 'cave_id');
    }

    public function hero(): BelongsTo
    {
        return $this->belongsTo(Hero::class, 'hero_id');
    }

    public function story(): BelongsTo
    {
        return $this->belongsTo(Story::class, 'story_id');
    }

    public function graffiti(): BelongsTo
    {
        return $this->belongsTo(Graffiti::class, 'graffiti_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'select');
    }

    public function categorySelect2(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'select2');
    }

    public function icon(): BelongsTo
    {
        return $this->belongsTo(Icon::class, 'icon_id');
    }

    public function icondummy(): BelongsTo
    {
        return $this->belongsTo(Icon::class, 'belongs_to_non_nullable');
    }

    public function postalboxes(): HasMany
    {
        return $this->hasMany(PostalBox::class);
    }

    public function postalboxer(): HasMany
    {
        return $this->hasMany(PostalBoxer::class);
    }

    public function articles(): BelongsToMany
    {
        return $this->belongsToMany(Article::class, 'monster_article');
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'monster_category');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'monster_tag');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'monster_product');
    }

    public function dummyproducts(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'monster_productdummy')->withPivot('notes');
    }

    public function countries(): BelongsToMany
    {
        return $this->belongsToMany(Country::class, 'countries_monsters');
    }

    public function sentiment(): MorphOne
    {
        return $this->morphOne(Sentiment::class, 'sentimentable');
    }

    public function ball(): MorphOne
    {
        return $this->morphOne(Ball::class, 'ballable');
    }

    public function recommends(): MorphToMany
    {
        return $this->morphToMany(Recommend::class, 'recommendable')->withPivot('text');
    }

    public function bills(): MorphToMany
    {
        return $this->morphToMany(Bill::class, 'billable');
    }

    public function stars(): MorphMany
    {
        return $this->morphMany(Star::class, 'starable');
    }

    public function universes(): MorphMany
    {
        return $this->morphMany(Universe::class, 'universable');
    }

    public function getTextAndEmailAttribute()
    {
        return $this->text.' '.$this->email;
    }

    /**
     * Because we don't trust that the 'easymde' db column does not already
     * have some JS or HTML stored inside it, we will run strip_tags() on
     * the value before it's ever used (both in Backpack and in the app).
     */
    public function getEasymdeAttribute($value)
    {
        return strip_tags($value);
    }

    /**
     * Because we don't trust that the 'summernote' db column does not already
     * have some JS stored inside the HTML, we will sanitize the output using
     * https://github.com/mewebstudio/Purifier.
     */
    public function getSummernoteAttribute($value)
    {
        return clean($value);
    }

    public function setBase64ImageAttribute($value)
    {
        if (app('env') == 'production') {
            \Alert::warning('In the online demo the base64 images don\'t get stored.');

            return true;
        }

        $this->attributes['base64_image'] = $value;
    }

    public function setDropzoneAttribute($value)
    {
        if (app('env') === 'production') {
            \Alert::warning('In the online demo the dropzone files don\'t get stored.');

            return true;
        }

        $this->attributes['dropzone'] = $value;
    }

    public function setImageAttribute($value)
    {
        if (app('env') == 'production') {
            \Alert::warning('In the online demo the images don\'t get uploaded.')->flash();

            return true;
        }

        $attribute_name = 'image';
        $disk = 'public'; // use Backpack's root disk; or your own
        $destination_path = 'uploads/monsters/image_field';

        // if the image was erased
        if ($value == null) {
            // delete the image from disk
            if ($this->{$attribute_name}) {
                \Storage::disk($disk)->delete($this->{$attribute_name});
            }

            // set null in the database column
            $this->attributes[$attribute_name] = null;
        }

        // if a base64 was sent, store it in the db
        if (Str::startsWith($value, 'data:image')) {
            // 0. Make the image
            $image = \Image::make($value)->encode('jpg', 90);

            // 1. Generate a filename.
            $filename = md5($value.time()).'.jpg';

            // 2. Store the image on disk.
            \Storage::disk($disk)->put($destination_path.'/'.$filename, $image->stream());

            // delete previous image from the disk
            if ($this->{$attribute_name}) {
                \Storage::disk($disk)->delete($this->{$attribute_name});
            }

            // 4. Save the public path to the database
            // but first, remove "public/" from the path, since we're pointing to it from the root folder
            // that way, what gets saved in the database is the user-accesible URL
            $public_destination_path = Str::replaceFirst('public/', '', $destination_path);
            $this->attributes[$attribute_name] = $public_destination_path.'/'.$filename;
        }
    }

    public function setUploadAttribute($value)
    {
        if (app('env') == 'production') {
            \Alert::warning('In the online demo the files don\'t get uploaded.');

            return true;
        }

        $attribute_name = 'upload';
        $disk = 'public';
        $destination_path = 'uploads/monsters/upload_field';

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);

        // return $this->attributes[{$attribute_name}]; // uncomment if this is a translatable field
    }

    public function setUploadMultipleAttribute($value)
    {
        if (app('env') == 'production') {
            \Alert::warning('In the online demo the files don\'t get uploaded.')->flash();

            return true;
        }

        $attribute_name = 'upload_multiple';
        $disk = 'public';
        $destination_path = 'uploads/monsters/upload_multiple_field';

        $this->uploadMultipleFilesToDisk($value, $attribute_name, $disk, $destination_path);
    }
}
