@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3">Roles</h1>
            <a href="{{route('admin.roles.create')}}" class="btn btn-primary">Nuevo Rol</a>
        </div>

        <table class="table table-striped">
            <thead><tr><th>Nombre</th><th>Permisos</th><th class="text-end">Acciones</th></tr></thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{$role->name}}</td>
                        <td>{{$role->permissions->pluck('name')->join('.') ?: '-'}}</td>
                        <td class="text-end">
                            <a href="{{route('admin.roles.edit', $role)}}" class="btn btn-sm btn-outline-secondary">Editar</a>
                            <form action="{{route('admin.roles.deactivate', $role)}}" method="POST" class="d-inline">
                                @csrf @method('DEACTIVATE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Desactivar este rol?')">Desactivar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{$roles->links()}}
    </div>
    
@endsection