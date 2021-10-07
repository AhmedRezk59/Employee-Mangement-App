<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\City\StoreCityRequest;
use App\Http\Requests\City\UpdateCityRequest;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CityController extends Controller
{
    function __construct()
    {

       

        $this->middleware('permission:show cities', ['only' => ['index', 'store', 'update', 'edit', 'destroy', 'create']]);
        $this->middleware('permission:create city', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit city', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete city', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cities = City::all();
        if ($request->has('search')) {
            $cities = City::where('name', 'like', "%{$request->search}%")->get();
        }
        return view('cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('cities.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCityRequest $request)
    {
        City::create($request->validated());

        return redirect()->route('cities.index')->with('message', 'City Created Successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $city = City::find($id);
        $countries = Country::all();
        session()->flash('id', $id);
        return view('cities.edit', compact('city', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCityRequest $request, $id)
    {
        $city = City::find($id);
        $city->update($request->validated());
        return redirect()->route('cities.index')->with('message', 'City Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        City::find($request->id)->forceDelete();
        return redirect()->route('cities.index')->with('message', 'City Deleted Successfully');
    }

    public function getStates($id)
    {
        $states = DB::table('states')->where('country_id', $id)->pluck('name', 'id');
        return json_encode($states);
    }
}
