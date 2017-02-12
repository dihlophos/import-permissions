<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExport extends FormRequest
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
            'organization_id' => 'required',
            'storage_id' => 'required',
            'purpose_id' => 'required',
            'transport_id' => 'required',
            'region_id' => 'required',
            'district_id' => 'required',
            'region_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'organization_id.required' => 'Не указана организация',
            'storage_id.required' => 'Не указано место хранения',
            'purpose_id.required' => 'Не указана цель вывоза',
            'transport_id.required' => 'Не указан транспорт',
            'region_id.required' => 'Не указан регион ввоза',
            'district_id.required' => 'Не указан район происхождения'
        ];
    }
}
