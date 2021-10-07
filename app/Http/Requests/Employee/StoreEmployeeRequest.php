<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
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
            'first_name' => ['required' , 'string' , 'min:3' , 'max:20'],
            'middle_name' => ['required' , 'string' , 'min:3' , 'max:20'],
            'last_name' => ['required' , 'string' , 'min:3' , 'max:20'],
            'address' => ['required' , 'string' , 'min:3'],
            'department_id' => ['required'],
            'country_id' => ['required'],
            'state_id' => ['required'],
            'city_id' => ['required'],
            'zip_code' => ['required'],
            'birth_date' => ['required'],
            'date_hired' => ['required'],
        ];
    }
}
