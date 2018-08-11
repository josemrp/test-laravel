<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';
    protected $fillable = ['name'];

    public $timestamps = false;

    public function articles()
    {
        return $this->belongsToMany('App\Article');
    }
}
