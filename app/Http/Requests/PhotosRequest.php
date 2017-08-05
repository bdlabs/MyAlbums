<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class PhotosRequest
 *
 * @package App\Http\Requests
 */
class PhotosRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'url' => 'required|max:255',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'url.required' => 'Url is required',
        ];
    }
}
