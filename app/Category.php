<?php
namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Kalnoy\Nestedset\NodeTrait;
use Baum\Node;
use App\Post;
use Laracasts\Presenter\PresentableTrait;
use App\Presenters\CategoryPresenter;
use Illuminate\Database\Eloquent\Model;

/**
 * Category
 */
class Category extends Node
{

  use PresentableTrait;
  protected $presenter = CategoryPresenter::class;
  use Sluggable;

  // /**
  //  * Column name for the left index.
  //  *
  //  * @var string
  //  */
  protected $leftColumn = '_lft';

  // /**
  //  * Column name for the right index.
  //  *
  //  * @var string
  //  */
  protected $rightColumn = '_rgt';




  protected $sluggable = [
    'build_from' => 'name',
    'save_to'    => 'slug',
  ];

  /**
   * Table name.
   *
   * @var string
   */
  protected $table = 'categories';

  /**
   * Return the sluggable configuration array for this model.
   *
   * @return array
   */
  public function sluggable()
  {
    return [
        'slug' => [
            'source' => 'name'
        ]
    ];
  }



  public function posts() {
    return $this->belongsToMany('\App\Post', 'cat_post');
  }

  public function fewPosts() {
    return $this->posts()->take(1);
  }


  public function countAllPostsfromSubCat($categoryIds) {
    $allmyposts = Category::join('cat_post', 'cat_post.category_id', '=', 'categories.id')
                            ->join('posts', 'cat_post.post_id', '=', 'posts.id')
                            ->whereIn('cat_post.category_id', $categoryIds)
                            ->orderBy('name', 'asc')
                            ->pluck('posts.title');
    return count($allmyposts);
  }

  public function getAllPostsfromSubCat($categoryIds) {
    $allmyposts = Category::join('cat_post', 'cat_post.category_id', '=', 'categories.id')
                            ->join('posts', 'cat_post.post_id', '=', 'posts.id')
                            ->whereIn('cat_post.category_id', $categoryIds)
                            ->orderBy('name', 'asc')
                            ->limit(5)->get();
    return $allmyposts;
  }



/*
  public function products() {
    return $this->belongsToMany('Product', 'products_categories');
  }
 **/

  /*
  public function products() {
    return $this->belongsToMany('Product', 'products_categories');
  }
  */


  /*
  public function scopeCategorized($query, Category $category=null) {
    if ( is_null($category) ) return $query->with('categories');

    $categoryIds = $category->getDescendantsAndSelf()->pluck('id');

    return $query->with('categories')
      ->join('products_categories', 'products_categories.product_id', '=', 'products.id')
      ->whereIn('products_categories.category_id', $categoryIds);
  }
  */


  //////////////////////////////////////////////////////////////////////////////

  //
  // Below come the default values for Baum's own Nested Set implementation
  // column names.
  //
  // You may uncomment and modify the following fields at your own will, provided
  // they match *exactly* those provided in the migration.
  //
  // If you don't plan on modifying any of these you can safely remove them.
  //

  // /**
  //  * Column name which stores reference to parent's node.
  //  *
  //  * @var string
  //  */
  // protected $parentColumn = 'parent_id';

  // /**
  //  * Column name for the left index.
  //  *
  //  * @var string
  //  */
  // protected $leftColumn = 'lft';

  // /**
  //  * Column name for the right index.
  //  *
  //  * @var string
  //  */
  // protected $rightColumn = 'rgt';

  // /**
  //  * Column name for the depth field.
  //  *
  //  * @var string
  //  */
  // protected $depthColumn = 'depth';

  // /**
  //  * Column to perform the default sorting
  //  *
  //  * @var string
  //  */
  // protected $orderColumn = null;

  // /**
  // * With Baum, all NestedSet-related fields are guarded from mass-assignment
  // * by default.
  // *
  // * @var array
  // */
  // protected $guarded = array('id', 'parent_id', 'lft', 'rgt', 'depth');

  //
  // This is to support "scoping" which may allow to have multiple nested
  // set trees in the same database table.
  //
  // You should provide here the column names which should restrict Nested
  // Set queries. f.ex: company_id, etc.
  //

  // /**
  //  * Columns which restrict what we consider our Nested Set list
  //  *
  //  * @var array
  //  */
  // protected $scoped = array();

  //////////////////////////////////////////////////////////////////////////////

  //
  // Baum makes available two model events to application developers:
  //
  // 1. `moving`: fired *before* the a node movement operation is performed.
  //
  // 2. `moved`: fired *after* a node movement operation has been performed.
  //
  // In the same way as Eloquent's model events, returning false from the
  // `moving` event handler will halt the operation.
  //
  // Please refer the Laravel documentation for further instructions on how
  // to hook your own callbacks/observers into this events:
  // http://laravel.com/docs/5.0/eloquent#model-events

}
