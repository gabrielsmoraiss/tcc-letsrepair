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
            //'description' => 'sometimes|required',
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
            //'description.required' => 'Por favor, insira uma descrição.',   
        ];
    }
}
