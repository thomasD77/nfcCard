<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'=>'required|max:150',
            'body'=>'required',
            'postcategory_id'=>'required',
        ];
    }

    public function messages(){
        return[
            'title.required'=>'Title is required',
            'body.required'=> 'Description is required!',
            'postcategory_id.required'=> 'Category is required!',
        ];
    }
}
