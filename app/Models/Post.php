<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  protected $primaryKey = 'uuid';

  public $incrementing = false;

  protected $keyType = 'string';
}
