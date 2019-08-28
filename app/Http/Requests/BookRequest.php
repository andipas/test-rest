<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required|string',
            'author_id' => 'required|min:1',
            'status' => 'required|min:1|max:2'
        ];

        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                        'author_id' => 'required|integer|exists:authors,id',
                    ] + $rules;
            // case 'PATCH':
            case 'DELETE':
                return [
                    'book_id' => 'required|integer|exists:books,id'
                ];
        }
    }
}
