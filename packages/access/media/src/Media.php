<?php

namespace Access\Media;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable=['name','url','filename','description'];

    public function galleries()
    {        
    	return $this->belongsToMany('Access\Media\Gallery', 'galleries_media');
    }
    
}
