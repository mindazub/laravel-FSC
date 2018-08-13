<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactEmailRequest extends FormRequest
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
        return [
            'full_name' => 'required|min:2|max:100',
            'email' => 'required|email|',
            'message' => 'required',
        ];
    }

    public function getFullName(): string
    {
        return $this->input('full_name');
    }

    public function getEmail(): string
    {
        return $this->input('email');
    }

    public function getMessage(): string
    {
        return $this->input('message');
    }

}
