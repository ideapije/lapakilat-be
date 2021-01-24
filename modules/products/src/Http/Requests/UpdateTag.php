<?php

namespace Lapakilat\ProductModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTag extends FormRequest
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
        $tag = $this->tag->id ?? $this->id ?? 0;
        return [
            'name' => [
                'sometimes',
                Rule::unique('tags')->ignore($tag),
            ],
            'as_category' => 'sometimes|boolean'
        ];
    }
}
