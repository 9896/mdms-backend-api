<?php

namespace Modules\Disease\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateDiseaseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => ['required', Rule::unique('diseases')],
            'content' => ['required', 'min:46'],
            'prevelance_rate' => ['required', 'integer'],
            'doctor_id' => ['required'],
            'symptom' => ['required']
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
