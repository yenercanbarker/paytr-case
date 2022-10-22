<?php

namespace App\Http\Requests\Admin\Showcase;

use Illuminate\Foundation\Http\FormRequest;

class ShowcaseStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:100',
            'product_id' => 'required|array'
        ];
    }
}