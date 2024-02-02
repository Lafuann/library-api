<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'release_year' => 'required|numeric|between:1980,2021',
            'title' => 'required',
            'description' => 'required',
            'image_url' => 'required',
            'release_year' => 'required',
            'price' => 'required',
            'total_page' => 'required',
            'category_id' => 'required',
        ];
    }
}
