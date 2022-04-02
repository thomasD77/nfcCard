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
            'firstname'=>'max:150',
            'lastname'=>'max:150',
            'company'=>'max:150',
            'jobTitle'=>'max:150',
            'website'=>'max:150',
            'mobile'=>'max:150',
            'mobileWork'=>'max:150',
            'addressLine1'=>'max:150',
            'city'=>'max:150',
            'postalCode'=>'max:150',
            'country'=>'max:150',
            'facebook'=>'max:150',
            'instagram'=>'max:150',
            'linkedIn'=>'max:150',
            'twitter'=>'max:150',
            'youTube'=>'max:150',
            'tikTok'=>'max:150',
            'whatsApp'=>'max:150',
            'email'=>'max:150',
            'shortDescription'=>'max:350',

        ];
    }
}
