<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;


class StorePageRequest extends Request
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      // 'slug[en]' => 'required'
    ];
  }


  /**
   * Determine if the user is authorized to make this request.
   */
  public function authorize()
  {
    return true;
  }

  public function messages()
  {
    return [];
  }


  /**
   * Return the fields and values to create a new post from
   */
  public function pageFillData()
  {
    return [
      'title' => $this->title,
      'slug' => $this->slug,
      'content_raw' => $this->get('content_raw'),
    ];
  }
}
