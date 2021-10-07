@extends('layouts.main')
@section('content')

    <div id="app">
        <router-view></router-view>
    </div>
    @auth
        <script>
            window.user = @json([
                'role' => auth()->user()->roles->pluck("name"),
                'permissions' => auth()->user()->getPermissionsViaRoles()->pluck('name')
            ])
        </script>
    @endauth
@endsection
