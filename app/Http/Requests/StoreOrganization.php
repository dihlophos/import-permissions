<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganization extends FormRequest
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
              'name' => 'required|max:255|unique:organizations,name,'.($this->organization?$this->organization->id:0),
              'tin' => 'required'
         ];
     }

     public function messages()
     {
         return [
             'name.required' => 'Не указано название',
             'tin.required' => 'Не указан ИНН'
         ];
     }
}
