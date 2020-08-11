<?php

namespace Access\Post;

use Access\Media\Gallery;
use Access\Subscriber\Comment;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    protected $fillable=['title','slug','description','status','tag','image','user_id','type_id','highlights','priority'];


    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_posts');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function gallery(){
        return $this->hasOne(Gallery::class);
    }

    public function getPathAttribute()
    {
        return url('detail/'.$this->slug);
    }
    public function getPhotoAttribute()
    {
        return asset('images/'.$this->image);
    }
    public function getImgAttribute()
    {
        return asset('img/'.$this->image);
    }
    public function getThumbnailAttribute()
    {
        return asset('thumbnail/'.$this->image);
    }
}
