<?php

namespace Lapakilat\ProductModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $rules = [
            'name' => 'required|unique:products',
            'image' => 'image',
            'price' => 'numeric',
            'sale_price' => 'numeric'
        ];

        if (in_array($this->method(), ['PATCH', 'PUT'])) {
            $rules['name'] = $rules['name'].',name,'.$this->id;
        }

        return $rules;
    }
}
