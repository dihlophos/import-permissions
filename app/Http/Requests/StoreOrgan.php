<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrgan extends FormRequest
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
            'name' => 'required|max:255|unique:organs,name,'.($this->organ?$this->organ->id:0),
            'head_name' => 'required|max:150',
            'head_job' => 'required|max:150'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Не указано название',
            'head_name.required' => 'Не указано И. О. Фамилия руководителя',
            'head_job.required' => 'Не указана должность руководителя',
        ];
    }
}
