<?php

namespace App\Bulong\News\Requests;

use App\Bulong\Base\BaseFormRequest;

class UpdateNewsRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required'],
            'description' => ['required'],
        ];
    }
}
