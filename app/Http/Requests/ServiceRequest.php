<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'description'=>'required',
            'price'=>'required',
            'servicecategory_id'=>'required',
        ];
    }

    public function messages(){
        return[
            'servicecategory_id.required'=> 'You need to select or make a category',
        ];
    }
}
