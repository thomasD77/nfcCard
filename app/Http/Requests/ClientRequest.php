<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'username'=>'required|max:150',
            'email'=>'required|max:150',
            'source_id'=>'required',
            'loyal_id'=>'required',
        ];
    }

    public function messages(){
        return[
            'source_id.required'=>'Please select a loyalty',
            'loyal_id.required'=>'Please select a source',
        ];
    }
}
