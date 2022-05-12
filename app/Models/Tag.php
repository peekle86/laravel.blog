<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


/**
 * Class Tag
 * @package App\Models
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property int $created_at
 * @property int $updated_at
 */
class Tag extends Model
{
    use HasFactory;
    use Sluggable;

    /**
     * Establish relationship with Post model | many > many
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class);
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
