<?php

namespace App\Jobs;

use App\Category;
use App\Tag;
use Carbon\Carbon;
//use Illuminate\Contracts\Bus\SelfHandling;

class CategoryFormFields extends Job
{
  /**
   * The id (if any) of the Post row
   *
   * @var integer
   */
  protected $id;

  /**
   * List of fields and default value for each field
   *
   * @var array
   */
  protected $fieldList = [
    'name' => '',
    'slug' => '',
  ];

  /**
   * Create a new command instance.
   *
   * @param integer $id
   */
  public function __construct($id = null)
  {
    $this->id = $id;
  }

  /**
   * Execute the command.
   *
   * @return array of fieldnames => values
   */
  public function handle()
  {
    $fields = $this->fieldList;

    if ($this->id) {
      /*I am going to fill these fields with value from the ID */
      $fields = $this->fieldsFromModel($this->id, $fields);
    }

    foreach ($fields as $fieldName => $fieldValue) {
      $fields[$fieldName] = old($fieldName, $fieldValue);
    }

    return array_merge(
      $fields
    );
  }

  /**
   * Return the field values from the model
   *
   * @param integer $id
   * @param array   $fields
   * @return array
   */
  protected function fieldsFromModel($id, array $fields)
  {
    $category = Category::findOrFail($id);
    $fieldNames = array_keys($fields);

    $fields = ['id' => $id];
    foreach ($fieldNames as $field) {
      $fields[$field] = $category->{$field};
    }
    return $fields;
  }
}