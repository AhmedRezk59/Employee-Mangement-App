<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Resources\EmployeesResource;
use App\Http\Resources\EmployeesSingleResource;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $employees = EmployeesResource::collection(Employee::all());

        
        /*search function*/
        if ($request->search && $request->department_id) {
            $employees = Employee::where('department_id', $request->department_id);
            $employees = $employees->where('first_name', 'like', "%{$request->search}%")
                ->orWhere('middle_name', 'like', "%{$request->search}%")
                ->orWhere('last_name', 'like', "%{$request->search}%")
                ->get();
            $employees = EmployeesResource::collection($employees);
        } elseif ($request->search && !$request->search) {
            $employees = Employee::where('first_name', 'like', "%{$request->search}%")
                ->orWhere('middle_name', 'like', "%{$request->search}%")
                ->orWhere('last_name', 'like', "%{$request->search}%")->get();
            $employees = EmployeesResource::collection($employees);
        } elseif ($request->department_id && !$request->search) {
            $employees = Employee::where('department_id', $request->department_id)->get();
            $employees = EmployeesResource::collection($employees);
        }



        if ($employees) {
            return response($employees, 200);
        }
        return response(null, 401);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());
        return response('Employee inserted successfully', 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response(new EmployeesSingleResource(Employee::find($id)), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEmployeeRequest $request, $id)
    {
        Employee::find($id)->update($request->validated());
        return response('Employee updated successfully', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return response(null, 404);
        }
        $employee->forceDelete();
        return response('Employee deleted successfully', 200);
    }
}
