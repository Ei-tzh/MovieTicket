<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CinemaUpdateRequest extends FormRequest
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
            'township'  => 'required',
            'image'     =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
        foreach($this->request->get('ph_no') as $key => $val){
            $rules['ph_no.'.$key] = 'required|digits_between:9,11';
            
        }
        foreach($this->request->get('theaters') as $key => $val){
            $rules['theaters.'.$key]='required';
            
        }
        return $rules;
    }
    
}
