<?php

namespace Access\Page;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    
    protected $fillable=['name','slug','template','image','title','header_asset','footer_asset','body_content','status'];
}
