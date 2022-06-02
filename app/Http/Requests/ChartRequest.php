<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChartRequest extends FormRequest
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
            'datefirst' => 'required|after_or_equal:"01.01.2000"|before_or_equal:today',
            'datesecond' => 'required|after_or_equal:datefirst|before_or_equal:today'
        ];
    }
    
    public function messages()
    {
        return [
            'datefirst.required' => 'Введите первую дату',
            'datefirst.after_or_equal' => 'Введите дату после 01.01.2000',
            'datefirst.before_or_equal' => 'Введите корректную дату',
            'datesecond.required' => 'Введите вторую дату',
            'datesecond.after_or_equal' => 'Вторая дата должна быть после первой',
            'datesecond.before_or_equal' => 'Введите корректную дату',
        ];
    }
}
