<?php

namespace App\Http\Controllers\Admin\Categories\Requests;

use App\Bulong\Base\BaseFormRequest;

class CreateCategoryRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:categories'],
            'image' => 'required',
        ];
    }
}
