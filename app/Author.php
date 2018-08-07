<?php

declare(strict_types = 1);

namespace App;

use App\Article;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Author
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $first_name
 * @property string $last_name
 * @property int|null $reference_author_id Author id from 3trd party application
 * @method static Builder|Author whereCreatedAt($value)
 * @method static Builder|Author whereFirstName($value)
 * @method static Builder|Author whereId($value)
 * @method static Builder|Author whereLastName($value)
 * @method static Builder|Author whereUpdatedAt($value)
 * @method static Builder|Author whereReferenceAuthorId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Article[] $articles
 */
class Author extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'reference_author_id',
    ];

    /**
     * @return HasMany
     */
    public function articles(): hasMany
    {
        return $this->hasMany(Article::class);
    }


}
