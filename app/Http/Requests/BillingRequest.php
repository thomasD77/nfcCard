<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillingRequest extends FormRequest
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
            'firstname'=>'required|max:150',
            'lastname'=>'required|max:200',
            'streetAddress1'=>'required|max:150',
            'city'=>'required|max:150',
            'postalCode'=>'required|max:50',
        ];
    }

    public function messages(){
        return[
            'firstname.required'=> 'Firstname is required!',
            'lastname.required'=> 'Lastname is required!',
            'streetAddress1.required'=> 'Address is required!',
            'city.required'=> 'City is required!',
            'postalCode.required'=> 'Postal Code is required!',
        ];
    }
}
