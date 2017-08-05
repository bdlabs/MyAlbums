<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AlbumsRequest
 *
 * @package App\Http\Requests
 */
class AlbumsRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Title is required',
        ];
    }
}