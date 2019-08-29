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

        $rulesSafe = [
            'title' => 'string',
            'author_id' => 'integer|min:1',
            'status' => 'integer|min:1|max:2'
        ];

        switch ($this->getMethod())
        {
            case 'POST':
                return $rules;
            case 'PUT':
                return [
                        'book_id' => 'required|integer|exists:books,id',
                    ] + $rulesSafe;
            case 'PATCH':
                return [
                        'book_id' => 'required|integer|exists:books,id',
                    ] + $rulesSafe;
            case 'DELETE':
                return [
                    'book_id' => 'required|integer|exists:books,id'
                ];
        }
    }

    public function all($keys = null)
    {
        $data = parent::all($keys);
        switch ($this->getMethod())
        {
            // case 'PUT':
            // case 'PATCH':
            case 'DELETE':
                $data['date'] = $this->route('day');
        }
        return $data;
    }
}
