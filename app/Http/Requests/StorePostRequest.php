<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use League\CommonMark\Converter;
use League\HTMLToMarkdown\HtmlConverter;


class StorePostRequest extends Request
{
  protected $converter;

  public function __construct(Converter $converter)
  {
    $this->converter = $converter;
  }

  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
    ];
  }

  /**
   * Return the fields and values to create a new post from
   */
  public function postFillData()
  {
    $published_at = new Carbon(
      $this->publish_date . ' ' . $this->publish_time
    );
    $configuration = ['HTML.Allowed' => 'a[href],ul,ol,li'];
    $input = $this->get('content_raw');
    $htmlconverter = new HtmlConverter(array('strip_tags' => true));
    $markdown = $htmlconverter->convert($input);
    $content_raw = \Purify::clean($markdown, $configuration);
    $content_html = $this->converter->convertToHtml($content_raw);

    return [
      'title' => $this->title,
      'slug' => $this->slug,
      'content_raw' => $content_raw,
      'content_html' => $content_html
    ];
  }
}
