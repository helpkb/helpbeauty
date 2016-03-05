<?php


namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class CategoryPresenter extends Presenter
{
  /**
   * @var \Modules\Blog\Repositories\PostRepository
   */
  private $category;

  public function __construct($entity)
  {
    parent::__construct($entity);
    $this->category = app('Category');
  }

  function renderNode($node)
  {
    if ($node->isLeaf()) {
      return '<li>' . $node->name . '</li>';
    } else {
      $html = '<li>' . $node->name;

      $html .= '<ul>';

      foreach ($node->children as $child)
        $html .= $this->renderNode($child);

      $html .= '</ul>';

      $html .= '</li>';
    }

    return $html;
  }
}
