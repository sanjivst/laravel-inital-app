<?php

namespace Access\Media;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable=['name', 'description', 'thumbnail'];

    public function galleries()
    {
    	return $this->belongsToMany('Access\Media\Gallery', 'album_gallery');
    }
}
