<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatPost extends Model
{

  /* define the table  */
  protected $table = 'cat_post';
  /* define fillable fields */
  protected $fillable = ['id', 'category_id', 'post_id'];

}
