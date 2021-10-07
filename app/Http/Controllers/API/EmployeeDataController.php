<?php

namespace App\Http\Controllers\ApI;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Department;
use App\Models\State;
use Illuminate\Http\Request;

class EmployeeDataController extends Controller
{
    
    public function get_countries()
    {
        return response(Country::all(), 200);
    }


    public function get_states($country_id)
    {
        return response(State::where('country_id', $country_id)->get(), 200);
    }


    public function get_cities($country_id, $state_id)
    {
        return response(City::where('country_id', $country_id)->where('state_id', $state_id)->get(), 200);
    }

    public function get_departments(){
        return response(Department::all() , 200);
    }
}
