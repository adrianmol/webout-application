<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class LoginRequest extends FormRequest
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

    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required'
        ];
    }

    public function getCredentials()
    {

        $username = $this->get('username');

        return [
            'username' => $username,
            'password' => $this->get('password')
        ];
        

        return $this->only('username', 'password');
    }

}
