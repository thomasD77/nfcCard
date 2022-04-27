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
            'firstname'=>'max:50',
            'lastname'=>'max:50',
            'company'=>'max:50',
            'jobTitle'=>'max:50',
            'website'=>'max:50',
            'mobile'=>'max:20',
            'mobileWork'=>'max:20',
            'addressLine1'=>'max:50',
            'city'=>'max:50',
            'postalCode'=>'max:10',
            'country'=>'max:50',
            'facebook'=>'max:50',
            'instagram'=>'max:50',
            'linkedIn'=>'max:50',
            'twitter'=>'max:50',
            'youTube'=>'max:50',
            'tikTok'=>'max:50',
            'whatsApp'=>'max:50',
            'email'=>'max:50',
            'shortDescription'=>'max:350',

        ];
    }
}
