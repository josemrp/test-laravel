<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    /**
     * Scope a query to only include articles with some string.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param mixed $string
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $string)
    {
        $string = addslashes($string);

        return $query->where('title', 'LIKE', "%$string%")
                    ->orderByRaw('CASE
                        WHEN title = ' . "'$string'" . ' THEN 0
                        WHEN title LIKE ' . "'$string %'" . ' THEN 1
                        WHEN title LIKE ' . "'% $string %'" . ' THEN 2
                        WHEN title LIKE ' . "'% $string'" . ' THEN 3
                        WHEN title LIKE ' . "'%$string%'" . ' THEN 4
                        END
                    ');
    }
}
