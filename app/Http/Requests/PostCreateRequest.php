<?php

namespace App\Http\Requests;

use Carbon\Carbon;

class PostCreateRequest extends Request
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
        return [
            'title' => 'required',
            'content' => 'required',
        ];
    }

    /**
     * Return the fields and values to create a new post from
     */
    public function postFillData()
    {
        $published_at = new Carbon(
            $this->publish_date.' '.$this->publish_time
        );

        return [
            'title' => $this->title,
            'subtitle' => $this->title,
            'page_image' => '',
            'content_raw' => $this->get('content'),
            'meta_description' => '',
            'is_draft' => (bool)$this->is_draft,
            'published_at' => $published_at,
            'layout' => '',
        ];
    }
}
