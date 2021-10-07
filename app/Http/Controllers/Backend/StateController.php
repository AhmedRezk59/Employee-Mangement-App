<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\States\StoreStateRequest;
use App\Http\Requests\States\UpdateStateRequest;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{

    function __construct()
    {

        $this->middleware('permission:show states', ['only' => ['index', 'store', 'update', 'edit', 'destroy', 'create']]);
        $this->middleware('permission:create state', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit state', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete state', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $states = State::all();
        if ($request->has('search')) {
            $states = State::where('name', 'like', "%{$request->search}%")->get();
        }
        return view('states.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('states.create' , compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStateRequest $request)
    {
        State::create($request->validated());

        return redirect()->route('states.index')->with('message', 'State Created Successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = State::find($id);
        $countries = Country::all();
        session()->flash('id', $id);
        return view('states.edit', compact('state' , 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStateRequest $request, $id)
    {


        $state = State::find($id);
        $state->update($request->validated());
        return redirect()->route('states.index')->with('message', 'State Updated Successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        State::find($request->id)->forceDelete();
        return redirect()->route('states.index')->with('message', 'State Deleted Successfully');
    }
}
