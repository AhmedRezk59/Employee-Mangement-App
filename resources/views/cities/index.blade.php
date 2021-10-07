@extends('layouts.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cities</h1>
    </div>
    <div class="row">
        <div class="card mx-auto">


            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>

            @endif





            <div class="card-header">
                <form action="{{ route('cities.index') }}" method="get" class="d-inline">
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
                @can('create city')

                    <a href="{{ route('cities.create') }}" class="float-right btn btn-primary">Create</a>
                @endcan

            </div>

            <div class="card-body">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">City Name</th>
                            <th scope="col">State Name</th>
                            <th scope="col">Country Code</th>
                            <th scope="col">Country Name</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($cities as $city)

                            <tr>
                                <td scope="row">{{ $i }}</td>
                                <td scope="row">{{ $city->name }}</td>
                                <td scope="row">{{ $city->state->name }}</td>

                                <td scope="row">{{ $city->country->country_code }}</td>
                                <td scope="row">{{ $city->country->name }}</td>
                                <td>
                                    @can('edit city')
                                        <a href="{{ route('cities.edit', $city->id) }}" class="btn btn-primary">Edit</a>

                                    @endcan
                                    @can('delete city')

                                        <button type="button" class="btn btn-danger deletebtn" data-toggle="modal"
                                            data-target="#DeleteModal" data-city_id="{{ $city->id }}">
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
                            Are you sure you want to delete this City?

                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal_body">
                        <form action="{{ url('cities/destroy') }}" method="post" class="deleteForm">
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
        if (event.target.hasAttribute('data-city_id')) {

            var element = event.target;
            var cityId = element.getAttribute('data-city_id');
            var input = document.getElementById('deleteId');
            input.value = `${cityId}`;

        }
    }
</script>
