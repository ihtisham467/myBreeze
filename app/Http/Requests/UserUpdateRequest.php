<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $validations = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'role_id' => 'required|integer',
        ];
        
        if(isset($this->password)) {
            $validations['password'] = 'required|confirmed';
        }

        return $validations;
    }
}
