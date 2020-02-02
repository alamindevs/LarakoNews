<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if($this->method()=='PUT' || $this->method()=='PATCH'){
          return [
              'name' => 'required|max:50',
              'email' => 'required|email|unique:users,email,'.$this->user->id,
              'phone' => 'required|max:30|unique:users,phone,'.$this->user->id,
              'role' => 'required',
              'gender' => 'required',
              'bio' => 'max:180',
              'address' => 'required|max:150',
              'facebook' => 'nullable|url',
              'twitter' => 'nullable|url',
              'instagram' => 'nullable|url',
              'youtube' => 'nullable|url',
              'oldpass' => 'required|string|min:6',
          ];
        }else{
          return[
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'username' => 'required|max:50|unique:users',
            'phone' => 'required|max:30|unique:users',
            'role' => 'required',
            'gender' => 'required',
            'password' =>'required|string|min:6|confirmed',
          ];
        }
    }
}
