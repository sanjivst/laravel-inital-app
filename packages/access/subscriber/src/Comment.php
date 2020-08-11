<?php

namespace Access\Subscriber;

use Access\Post\Post;
use Illuminate\Database\Eloquent\Model;
use App\User;

class Comment extends Model
{
    public function post(){
      return  $this->belongsTo(Post::class);
    }
    public function subscriber(){
       return $this->belongsTo(Subscriber::class);
    }
    protected $fillable=['subscriber_id','text','post_id'];
}
