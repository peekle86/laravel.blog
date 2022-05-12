<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


/**
 * Class Post
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property int $category_id
 * @property int $created_at
 * @property int $updated_at
 */
class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'body', 'category_id'];

    /**
     * Establish relationship with Tag model | many > many
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * Establish relationship with Category model | many(Posts) > one(Category)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

}
