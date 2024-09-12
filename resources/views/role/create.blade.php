@extends('template')
@section('title','Crear rol')

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
        <li class="breadcrumb-item"><a href="{{ route('role.index') }}">Roles</a></li>
        <li class="breadcrumb-item active">Crear Rol</li>
    </ol>

    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3" >
        <form action="{{ route('role.store') }}" method="post">
            @csrf
            <div class="row g-3">
                <div class="row mb-4 mt-4">
                    <label for="name" class="col-sm-2 col-form-label">Nombre del rol</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    </div>
                    <div class="col-sm-6">
                        @error('name')
                            <small class="text-danger">{{ '*'.$message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="col-12 mb-4">
                    <label for="" class="form-label">Permisos del rol:</label>
                    @foreach ($permissions as $item)
                        <div class="for-check mb-2">
                            <input type="checkbox" name="permission[]" value="{{ $item->id }}" id="{{ $item->id }}" class="form-check-input" value="{{ $item->id }}">
                            <label for="{{ $item->id }}" class="form-check-label">{{ $item->name }}</label>
                        </div>
                    @endforeach
                </div>
                    @error('permission')
                        <small class="text-danger">{{ '*'.$nessage }}</small>
                    @enderror

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Crear</button>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')

@endpush
