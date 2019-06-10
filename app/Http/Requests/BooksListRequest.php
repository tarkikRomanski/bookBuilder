<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BooksListRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'archived' => 'boolean|nullable',
            'order' => 'string|in:asc,desc|nullable',
            'page' => 'integer|min:1|nullable',
        ];
    }
}
