<?php

namespace App\Models;

use Carbon\Carbon;
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

    /**
     * Return pretty date info
     *
     * Like: 12 June 2000
     *
     * @return string
     */
    public function getPostDate()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d F Y');
    }

    /**
     * Looking for a similar value in the title attribute
     *
     * @param $query
     * @param $search
     * @return mixed
     */
    public function scopeLike($query, $search)
    {
        return $query->where('title', 'LIKE', "%{$search}%");
    }

}
