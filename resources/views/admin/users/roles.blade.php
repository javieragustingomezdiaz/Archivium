@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="h3 mb-3">Administrar roles por: {{ $user->name }}</h1>

        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.users.roles.update', $user) }}" class="card card-body">
            @csrf @method('PUT')

            <div class="row">
                @foreach($roles as $role)
                    <div class="col-md-4 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->name }}"
                                id="role_{{ $role->id }}" {{ $user->hasRole($role->name) ? 'checked' : '' }}>
                            <label for="role_{{ $role->id }}" class="form-check-label">{{ $role->name }}</label>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-3">
                <button class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
@endsection