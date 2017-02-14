<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProcessedProduct extends FormRequest
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
            'exported_product_id' => 'required',
            'date' => 'required',
            'count' => 'required',
            'measure' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'exported_product_id.required' => 'Не указан код вывоза',
            'date.required' => 'Не указана дата',
            'count.required' => 'Не указано количество',
            'measure.required' => 'Не указаны единицы измерения'
        ];
    }
}
