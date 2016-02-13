<?php

namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use App\Services\Markdowner;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements SluggableInterface
{

  use SluggableTrait;

  protected $sluggable = [
    'build_from' => 'title',
    'save_to'    => 'slug',
  ];


  protected $fillable = [
    'title', 'content_raw'
  ];

  /**
   * The many-to-many relationship between posts and tags.
   *
   * @return BelongsToMany
   */
  public function tags()
  {
    return $this->belongsToMany('App\Tag', 'page_tag_pivot');
  }

  /**
   * Set the title attribute and automatically the slug
   *
   * @param string $value
   */
  public function setTitleAttribute($value)
  {
    $this->attributes['title'] = $value;

    if (!$this->exists) {
      $this->setUniqueSlug($value, '');
    }
  }

  /**
   * Recursive routine to set a unique slug
   *
   * @param string $title
   * @param mixed  $extra
   */
  protected function setUniqueSlug($title, $extra)
  {
    $slug = str_slug($title . '-' . $extra);

    if (static::whereSlug($slug)->exists()) {
      $this->setUniqueSlug($title, $extra + 1);
      return;
    }

    $this->attributes['slug'] = $slug;
  }

  /**
   * Set the HTML content automatically when the raw content is set
   *
   * @param string $value
   */
  public function setContentRawAttribute($value)
  {
    $markdown = new Markdowner();

    $this->attributes['content_raw'] = $value;
    $this->attributes['content_html'] = $markdown->toHTML($value);
  }

  /**
   * Sync tag relation adding new tags as needed
   *
   * @param array $tags
   */
  public function syncTags(array $tags)
  {
    Tag::addNeededTags($tags);

    if (count($tags)) {
      $this->tags()->sync(
        Tag::whereIn('tag', $tags)->lists('id')->all()
      );
      return;
    }

    $this->tags()->detach();
  }

  /**
   * Alias for content_raw
   */
  public function getContentAttribute($value)
  {
    return $this->content_raw;
  }

  /**
   * Return next post after this one or null
   *
   * @param Tag $tag
   * @return Post
   */
  public function newerPage(Tag $tag = null)
  {
    $query =
      static::where('id', '>', $this->id)->orderBy('id', 'asc');
    if ($tag) {
      $query = $query->whereHas('tags', function ($q) use ($tag) {
        $q->where('tag', '=', $tag->tag);
      });
    }

    return $query->first();
  }

  /**
   * Return older post before this one or null
   *
   * @param Tag $tag
   * @return Post
   */
  public function olderPage(Tag $tag = null)
  {
    $query =
      static::where('id', '<', $this->id)->orderBy('id', 'desc');
    if ($tag) {
      $query = $query->whereHas('tags', function ($q) use ($tag) {
        $q->where('tag', '=', $tag->tag);
      });
    }

    return $query->first();
  }
}
