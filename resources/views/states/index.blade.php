@extends('layouts.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">States</h1>
    </div>
    <div class="row">
        <div class="card mx-auto">


            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>

            @endif





            <div class="card-header">
                <form action="{{ route('states.index') }}" method="get" class="d-inline">
                    <div class="input-group rounded w-50 float-left">
                        <input type="search" name="search" class="form-control rounded " placeholder="Search"
                            aria-label="Search" aria-describedby="search-addon" />
                        <button type="submit" style="outline: none;border: none">
                            <span class="input-group-text border-0" id="search-addon">
                                <i class="fas fa-search"></i>
                            </span>
                        </button>
                    </div>
                </form>
                @can('create state')

                    <a href="{{ route('states.create') }}" class="float-right btn btn-primary">Create</a>
                @endcan

            </div>

            <div class="card-body">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">ٍState Name</th>
                            <th scope="col">country code</th>
                            <th scope="col">country Name</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($states as $state)

                            <tr>
                                <td scope="row">{{ $i }}</td>
                                <td scope="row">{{ $state->name }}</td>
                                <td scope="row">{{ $state->country->country_code }}</td>
                                <td scope="row">{{ $state->country->name }}</td>
                                <td>
                                    @can('edit state')

                                        <a href="{{ route('states.edit', $state->id) }}" class="btn btn-primary">Edit</a>
                                    @endcan

                                    @can('delete state')

                                        <button type="button" class="btn btn-danger deletebtn" data-toggle="modal"
                                            data-target="#DeleteModal" data-state_id="{{ $state->id }}">
                                            Delete
                                        </button>

                                    @endcan


                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp

                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            Are you sure you want to delete this State?

                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal_body">
                        <form action="{{ url('states/destroy') }}" method="post" class="deleteForm">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" id="deleteId" value="">


                            <input type="submit" class="btn btn-danger w-25 btn-block mx-auto " value="Yes ,Delete!">

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end modal -->

    </div> <!-- end row -->
@endsection


<script>
    window.onclick = function(event) {
        if (event.target.hasAttribute('data-state_id')) {

            var element = event.target;
            var stateID = element.getAttribute('data-state_id');
            var input = document.getElementById('deleteId');
            input.value = `${stateID}`;

        }
    }
</script>
