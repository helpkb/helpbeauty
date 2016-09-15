<?php

namespace App\Jobs;

use App\Post;
use App\Tag;
use App\Page;

use Carbon\Carbon;
//use Illuminate\Contracts\Bus\SelfHandling;

use League\CommonMark\Converter;
use League\HTMLToMarkdown\HtmlConverter;

class PageFormFields extends Job
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
    'title' => '',
    'slug' => '',
    'content_raw' => '',
    'content_html' => '',
    'tags' => [],
  ];

  /**
   * Create a new command instance.
   *
   * @param integer $id
   */
  public function __construct($id = null, Converter $converter)
  {
    $this->id = $id;
    $this->converter = $converter;
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
      $fields = $this->fieldsFromModel($this->id, $fields);
    }

    foreach ($fields as $fieldName => $fieldValue) {
      $fields[$fieldName] = old($fieldName, $fieldValue);
    }

    return array_merge(
      $fields,
      ['allTags' => Tag::pluck('tag')->all()]
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
    $page = Page::findOrFail($id);

    $fieldNames = array_keys(array_except($fields, ['tags']));

    $htmlconverter = new HtmlConverter(array('strip_tags' => true));

    $fields = ['id' => $id];
    foreach ($fieldNames as $field) {
      if ($field == "content_raw") {
        $fields[$field] = $htmlconverter->convert($page->{$field});
      } else {
        $fields[$field] = $page->{$field};
      }
    }

    $fields['tags'] = $page->tags()->pluck('tag')->all();

    return $fields;
  }
}