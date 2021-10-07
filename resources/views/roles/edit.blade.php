@extends('layouts.main')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Roles</h1>
    </div>
    <div class="row">
        <div class="card mx-auto">
            <div class="card-header">
                Edit Role

                <a href="{{ route('roles.index') }}" class="btn btn-primary float-right">Back</a>
            </div>

            <div class="card-body" style="width: 700px">
                <form method="POST" action="{{ route('roles.update', $role->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Role Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name', $role->name) }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right mx-5">{{ __('Permissions') }}</label>

                        <div class="col-md-6">
                            @foreach ($permissions as $permission)
                                <div class="d-flex ">
                                    {{-- <label for="">{{$permission->name}}</label>
                                    <input type="checkbox" class="form-check-input @error('permissions') is-invalid @enderror"
                                        name="permissions[]" checked="{{in_array($permission , $rolePermissions) ? true :false}}"  required autocomplete="name"
                                        autofocus> --}}
                                    <label>{{ Form::checkbox('permissions[]', $permission->id, in_array($permission->id, $rolePermissions) ? true : false, ['class' => 'form-check-input']) }}
                                        {{ $permission->name }}</label>
                                    <br />
                                </div>

                            @endforeach
                        </div>
                    </div>



                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update Role') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
