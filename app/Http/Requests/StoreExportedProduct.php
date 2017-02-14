<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExportedProduct extends FormRequest
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
            'export_id' => 'required',
            'product_type_id' => 'required',
            'measure' => 'required',
            'count' => 'required',
            'manufacturer' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'export_id.required' => 'Не указан код вывоза',
            'product_type_id.required' => 'Не указан вид груза',
            'measure.required' => 'Не указаны единицы измерения',
            'count.required' => 'Не указано количество',
            'manufacturer.required' => 'Не указан производитель'
        ];
    }
}
