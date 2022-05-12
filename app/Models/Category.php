<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


/**
 * Class Category
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $created_at
 * @property int $updated_at
 */
class Category extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title'];

    /**
     * Establish a relationship with Post model | one(Category) > many(Posts)
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
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
