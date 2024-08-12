@extends('template')
@section('title','Editar Marca')

@push('css')
<style>
    #description{
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Marca</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('brand.index') }}">Marcas</a></li>
        <li class="breadcrumb-item active">Editar Marca</li>
    </ol>
    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3" >
        <form action="{{ route('brand.update', ['brand'=>$brand]) }}" method="post">
            @method('PATCH')
            @csrf
            <div class="row g-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name',$brand->property->name) }}">
                    @error('name')
                        <small class="text-danger">{{'*'.$message }}</small>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label for="description">Descripción:</label>
                    <textarea name="description" class="form-control" id="description" rows="3">{{ old('description',$brand->property->description) }}</textarea>
                    @error('description')
                    <small class="text-danger">{{'*'.$message }}</small>
                    @enderror
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="reset" class="btn btn-secondary">Reiniciar</button>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')

@endpush
