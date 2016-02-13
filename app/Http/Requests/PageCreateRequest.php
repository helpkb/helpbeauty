<?php

namespace App\Http\Requests;

use Carbon\Carbon;

class PageCreateRequest extends Request
{
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
    }

    /**
     * Return the fields and values to create a new post from
     */
    public function pageFillData()
    {
        return [
            'title' => $this->title,
            'slug' => $this->title,
            'content_raw' => $this->get('content_raw'),
        ];
    }
}
