<?php

namespace Access\Setting;

use Illuminate\Database\Eloquent\Model;

class Setup extends Model
{
     protected $fillable=['name','logo','favicon','about_us','address','phone','cell','email','social_link'];
      
}
