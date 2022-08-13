<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
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
            'firstname'=>'max:90',
            'lastname'=>'max:90',
            'company'=>'max:90',
            'jobTitle'=>'max:90',
            'website'=>'max:90',
            'mobile'=>'max:20',
            'mobileWork'=>'max:20',
            'addressLine1'=>'max:90',
            'city'=>'max:90',
            'postalCode'=>'max:10',
            'country'=>'max:90',
            'facebook'=>'max:90',
            'instagram'=>'max:90',
            'linkedIn'=>'max:90',
            'twitter'=>'max:90',
            'youTube'=>'max:90',
            'tikTok'=>'max:90',
            'whatsApp'=>'max:90',
            'email'=>'max:90|unique:members',
            'customField'=>'max:90',
            'customText'=>'max:30',
            'shortDescription'=>'max:390',

        ];
    }
}
