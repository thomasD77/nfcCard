<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            //
            'name'=>'required|max:150',
            'email'=>'required|max:150',
            'username'=>'max:150',
        ];
    }

    public function messages(){
        return[
            'name.required'=>'Name is required',
            'email.required'=> 'Email is required',
        ];
    }
}
