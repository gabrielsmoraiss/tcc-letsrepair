<?php

namespace Domain\TypeProduct;

use App\Http\Requests\Request;

class TypeProductRequest extends Request
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
          
        ];
    }

    /**
     * Retorna as mensagens de validação.
     *
     * @var array
     */
    public function messages()
    {
        return [
            
        ];
    }
}
