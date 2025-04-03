<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required|email',
            'address'=>'required',
            'contact'=>'required|numeric|min:8',
            'gender'=>'required|in:male,female,others',
            'dob'=>'required|date',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Please enter the name',
            'email.required'=>'Please enter the email.',
            'email.email'=>'Please enter valid email only!',
            'address.required'=>'Please enter the address.',
            'contact.required'=>'Please enter the contact number.',
            'contact.numeric'=>'Please enter the valid number',
            'contact.min'=>'Contact number should be of at least 8 digits',
            'gender.required'=>'Please select the gender.',
            'gender.in'=>'Please select valid gender only.eg : male, female, others.',
            'dob.required'=>'Please enter the date of birth.',
            'dob.date'=>'date of birth should be of type date only.',
        ];
    }
}
