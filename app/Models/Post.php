<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
  use HasFactory, SoftDeletes, HasSlug;
  protected $primaryKey = 'uuid';

  public $incrementing = false;

  protected $keyType = 'string';

  public function getSlugOptions(): \Spatie\Sluggable\SlugOptions
  {
    return SlugOptions::create()
      ->generateSlugsFrom('title')
      ->saveSlugsTo('slug')
      ->doNotGenerateSlugsOnUpdate();
  }

  public function user(): BelongsTo
  {
    return $this->belongsTo(User::class);
  }

  public function comments(): HasMany
  {
    return $this->hasMany(Comment::class, 'post_uuid', 'uuid');
  }
}
