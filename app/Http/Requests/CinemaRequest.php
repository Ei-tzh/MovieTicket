<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CinemaRequest extends FormRequest
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
        $rules=[
            'name'      =>'required',
            'address'   =>'required',
            'theaters'  => 'required',
            'township'  => 'required',
            'image'        => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        foreach($this->request->get('ph_no') as $key => $val){
            if($key==0){
                $rules['ph_no.'.$key] = 'required|digits_between:9,11';
            }
            $rules['ph_no.'.$key] = 'digits_between:9,11';
            return $rules;
        }
        

        
    }
    public function messages()
                {
                    $messages = [];
                    foreach($this->request->get('ph_no') as $key => $val)
                    {
                        $messages['ph_no.'.$key]='The phone number'.$key.'field is required.';
                        $messages['ph_no.'.$key.'.min'.'.max'] = 'The phone number "Book Title[ '.$key.']"must be between :min and :max digits.';
                    }
                    return $messages;
                }
}
