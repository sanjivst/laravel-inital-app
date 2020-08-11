<?php

namespace Access\Post;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable=['name'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
}
