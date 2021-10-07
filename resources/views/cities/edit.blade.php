@extends('layouts.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cities</h1>
    </div>
    <div class="row">
        <div class="card mx-auto">
            <div class="card-header">
               Edit City

               <a href="{{ route('cities.index') }}" class="btn btn-primary float-right">Back</a>
            </div>

            <div class="card-body" style="width: 700px">
                <form method="POST" action="{{ route('cities.update' , $city->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="country_id" class="col-md-4 col-form-label text-md-right">{{ __('Country Code') }}</label>

                            <div class="col-md-6">
                                <select name="country_id" id="country_id" class="form-control" required>
                                    <option value="{{$city->country->id}}" selected>{{$city->country->country_code}}</option>
                                     @foreach ($countries as $country)
                                        <option value="{{$country->id}}">{{$country->country_code}}</option>
                                    @endforeach
                                </select>

                                @error('country_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="state_id" class="col-md-4 col-form-label text-md-right">{{ __('State Name') }}</label>

                            <div class="col-md-6">
                                <select name="state_id" id="state_id" class="form-control" required>
                                    <option value="{{$city->state->id}}" selected>{{$city->state->name}}</option>
                                     
                                </select>

                                @error('state_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('City Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name' , $city->name) }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                       

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update State') }}
                                </button>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </div>
@endsection


<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script>
    $(document).ready(function() {
       
        $('select[name="country_id"]').on('change', function() {
            var countryId = $(this).val();
            if (countryId) {
                $.ajax({
                    url: "{{ URL::to('getStates') }}/" + countryId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data)
                        $('select[name="state_id"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="state_id"]').append('<option value="' +
                                key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>