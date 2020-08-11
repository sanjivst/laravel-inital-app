<?php

namespace Access\Subscriber;


use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $fillable = ['subscriber_id','subject','contents'];

	public function subscriber()
	{
		return $this->belongsTo(Subscriber::class);
	} 
}
