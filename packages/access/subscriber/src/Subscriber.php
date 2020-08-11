<?php

namespace Access\Subscriber;


use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable=['name','email','phone','status'];

     public function messages()
	{
		return $this->hasMany(Message::class);
	}  
}
