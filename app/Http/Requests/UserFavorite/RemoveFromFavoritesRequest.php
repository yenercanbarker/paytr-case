<?php

namespace App\Http\Requests\UserFavorite;

use Illuminate\Foundation\Http\FormRequest;

class RemoveFromFavoritesRequest extends FormRequest
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
            'product_id' => 'bail|required|exists:products,id'
        ];
    }
}