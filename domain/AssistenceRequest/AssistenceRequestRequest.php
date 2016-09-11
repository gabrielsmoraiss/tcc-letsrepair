<?php

namespace Domain\AssistenceRequest;

use App\Http\Requests\Request;

class AssistenceRequestRequest extends Request
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
            'name' => 'sometimes|required',
            'location' => 'sometimes|required',
            'category' => 'sometimes|required',
            'typeProduct' => 'sometimes|required',
            'brandsAttended' => 'sometimes|required',
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
            'name.required' => 'Por favor, insira um nome.',   
            'location.required' => 'Por favor, insira um local.',   
            'category.required' => 'Por favor, selecione uma categoria.',   
            'typeProduct.required' => 'Por favor, selecione um tipo de produto.',   
            'brandsAttended.required' => 'Por favor, selecione uma(s) marca atendida.',   
        ];
    }
}
