<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
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
            'name'=>'required|max:90',
            'phone'=>'required|max:90',
            'VAT'=>'required|max:90',

            'street'=>'required|max:90',
            'number'=>'required|max:90',
            'city'=>'required|max:90',
            'zip'=>'required|max:90',
            'country'=>'required|max:90',

            'description'=>'max:700',
        ];
    }
}
