<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\ExportedProduct;
use App\Models\ProcessedProduct;

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
        $exportedProduct = ExportedProduct::findOrFail($this->exported_product_id);
        $summCount = ProcessedProduct::where('exported_product_id', $this->exported_product_id);
        if ($this->processed_product) {
            $summCount->where('id', '<>', $this->processed_product->id);
        }
        $summCount = $summCount->sum('count');
        $countRemaining = $exportedProduct->count - $summCount;
        return [
            'exported_product_id' => 'required',
            'date' => 'required',
            'count' => 'required|numeric|max:'.$countRemaining,
            'measure' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'exported_product_id.required' => 'Не указан код вывоза',
            'date.required' => 'Не указана дата',
            'count.required' => 'Не указано количество',
            'count.max' => 'Превышено общее количество груза',
            'measure.required' => 'Не указаны единицы измерения'
        ];
    }
}
