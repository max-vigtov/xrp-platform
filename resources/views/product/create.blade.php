@extends('template')
@section('title','Crear Productos')

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
 <style>
    #description{
        resize: none;
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Crear Productos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Productos</a></li>
        <li class="breadcrumb-item active">Crear Producto</li>
    </ol>

    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3" >
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
            @csrf

             <div class="row g-3 mb-2">
                 {{-- Codigo --}}
                <div class="col-md-6">
                    <label for="code" class="form-label">Código:</label>
                    <input type="text" class="form-control" name="code" id="codo" value="{{ old('code') }}">
                    @error('code')
                        <small class="text-danger">{{'*'.$message }}</small>
                    @enderror
                </div>

                {{-- Nombre --}}
                <div class="col-md-6 mb-2">
                    <label for="name" class="form-label">Nombre:</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{'*'.$message }}</small>
                    @enderror
                </div>

                {{-- Descripcion --}}
                <div class="col-md-12 mb-2">
                    <label for="description">Descripción:</label>
                    <textarea name="description" class="form-control" id="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                    <small class="text-danger">{{'*'.$message }}</small>
                    @enderror
                </div>

                {{-- Fecha de vencimiento --}}
                <div class="col-md-6 mb-2">
                    <label for="expiration_date" class="form-label">Fecha de vencimiento:</label>
                    <input type="date" class="form-control" name="expiration_date" id="expiration_date" value="{{ old('expiration_date') }}">
                    @error('expiration_date')
                        <small class="text-danger">{{'*'.$message }}</small>
                    @enderror
                </div>

                {{-- Imagen --}}
                <div class="col-md-6 mb-2">
                    <label for="img_path" class="form-label">Imagen:</label>
                    <input type="file" class="form-control" name="img_path" id="img_path" accept="Image/" value="{{ old('img_path') }}">
                    @error('img_path')
                        <small class="text-danger">{{'*'.$message }}</small>
                    @enderror
                </div>

                {{-- Marca --}}
                <div class="col-md-6 mb-2">
                    <label for="brand_id" class="form-label">Marca:</label>
                    <select data-size="4"  title="Seleccione una marca" data-live-search="true" name="brand_id" id="brand_id" class="form-control selectpicker">
                        @foreach ($brands as $item)
                            <option value="{{$item->id}}" {{ old('brand_id') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                        <small class="text-danger">{{'*'.$message }}</small>
                    @enderror
                </div>

                {{-- Categoria --}}
                <div class="col-md-6 mb-2">
                    <label for="category" class="form-label">Categoría:</label>
                    <select data-size="4"  title="Seleccione una categoría" data-live-search="true" name="category" id="category" class="form-control selectpicker">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{ old('category') == $item->id ? 'selected' : '' }}>{{$category->name}}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <small class="text-danger">{{'*'.$message }}</small>
                    @enderror
                </div>
                <div class="col-md-12" >
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Crear</button>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/i18n/defaults-*.min.js"></script>

@endpush
