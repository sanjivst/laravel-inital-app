<?php

namespace Access\Media;

use Access\Post\Post;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable=['name','note','thumbnail','post_id'];

    public function media()
    {        
    	return $this->belongsToMany('Access\Media\Media', 'galleries_media');
    }
    public function post()
    {
    	return $this->belongsTo(Post::class );
    }
}

