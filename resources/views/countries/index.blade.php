@extends('layouts.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Countries</h1>
    </div>
    <div class="row">
        <div class="card mx-auto">


            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>

            @endif





            <div class="card-header">
                <form action="{{ route('countries.index') }}" method="get" class="d-inline">
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
                @can('create country')
                    <a href="{{ route('countries.create') }}" class="float-right btn btn-primary">Create</a>
                @endcan

            </div>

            <div class="card-body">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">country Code</th>
                            <th scope="col">country Name</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($countries as $country)

                            <tr>
                                <td scope="row">{{ $i }}</td>
                                <td scope="row">{{ $country->country_code }}</td>
                                <td scope="row">{{ $country->name }}</td>
                                <td>
                                    @can('edit country')

                                        <a href="{{ route('countries.edit', $country->id) }}" class="btn btn-primary">Edit</a>
                                    @endcan

                                    @can('delete country')

                                        <button type="button" class="btn btn-danger deletebtn" data-toggle="modal"
                                            data-target="#DeleteModal" data-country_id="{{ $country->id }}">
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
                            Are you sure you want to delete this country?

                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal_body">
                        <form action="{{ url('countries/destroy') }}" method="post" class="deleteForm">
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
        if (event.target.hasAttribute('data-country_id')) {

            var element = event.target;
            var countryID = element.getAttribute('data-country_id');
            var input = document.getElementById('deleteId');
            input.value = `${countryID}`;

        }
    }
</script>
