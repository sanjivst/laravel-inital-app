<?php

namespace Access\Post;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['name'];

    public function posts()
    {
        return $this->belongsToMany(Post::class,'category_posts');
    }
}
