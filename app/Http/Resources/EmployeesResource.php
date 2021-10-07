<?php

namespace App\Http\Resources;


use App\Models\Employee;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'middle_name' => $this->middle_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'department_id' => Employee::find($this->id)->department->name,
            'country_id' => Employee::find($this->id)->country->name,
            'state_id' => Employee::find($this->id)->state->name,
            'city_id' => Employee::find($this->id)->city->name,
            'zip_code' => $this->zip_code,
            'birth_date' => $this->birth_date,
            'date_hired' => $this->date_hired
        ];
    }
}
