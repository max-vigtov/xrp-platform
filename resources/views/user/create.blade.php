@extends('template')
@section('title','Crear Usuario')

@push('css')
    <style>
        #description{
            resize: none;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Crear Rol</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Roles</a></li>
        <li class="breadcrumb-item active">Crear Rol</li>
    </ol>

    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3" >
        <form action="{{ route('user.store') }}" method="post">
            @csrf
            <div class="row g-3">
                <div class="row mb-4 mt-4">
                    <label for="name" class="col-sm-2 col-form-label">Nombre del usuario:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="col-sm-4">
                        <div class="form-text">
                            Escriba un solo nombre.
                        </div>
                    </div>
                    <div class="col-sm-2">
                        @error('email')
                            <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-4">
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    </div>
                    <div class="col-sm-4">
                        <div class="form-text">
                            Escriba el correo corporativo del usuario.
                        </div>
                    </div>
                    <div class="col-sm-2">
                        @error('email')
                            <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="password" class="col-sm-2 col-form-label">Contraseña:</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="col-sm-4">
                        <div class="form-text">
                            Dígite una contraseña que incluya números.
                        </div>
                    </div>
                    <div class="col-sm-2">
                        @error('password')
                            <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="password_confirm" class="col-sm-2 col-form-label">Confirmar contraseña:</label>
                    <div class="col-sm-4">
                        <input type="password" class="form-control" id="password_confirm" name="password_confirm">
                    </div>
                    <div class="col-sm-4">
                        <div class="form-text">
                            Vuelva escribir su contraseña.
                        </div>
                    </div>
                    <div class="col-sm-2">
                        @error('password_confirm')
                            <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-4">
                    <label for="role" class="col-sm-2 col-form-label">Seleccionar rol:</label>
                    <div class="col-sm-4">
                        <select name="role" id="role" class="form-select">
                            <option value="" selected disabled>Seleccione:</option>
                            @foreach ($roles as $item)
                                <option value="{{ $item->name }}" @selected( old('role') == $item->name )>{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-text">
                            Es necesario asignar un rol a un usuario nuevo.
                        </div>
                    </div>
                    <div class="col-sm-2">
                        @error('role')
                            <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Crear</button>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')

@endpush
