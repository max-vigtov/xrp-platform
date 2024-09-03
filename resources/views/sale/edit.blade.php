@extends('template')
@section('title','Editar Producto')

@push('css')
<style>
    #description{
        resize: none;
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Producto</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('product.index') }}">Productos</a></li>
        <li class="breadcrumb-item active">Editar Producto</li>
    </ol>
    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3" >
        <form action="{{route('product.update',['product'=>$product])}}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="row g-3 mb-2">

                {{-- Codigo --}}
               <div class="col-md-6">
                   <label for="code" class="form-label">Código:</label>
                   <input type="text" class="form-control" name="code" id="codo" value="{{ old('code',$product->code) }}">
                   @error('code')
                       <small class="text-danger">{{'*'.$message }}</small>
                   @enderror
               </div>

               {{-- Nombre --}}
               <div class="col-md-6 mb-2">
                   <label for="name" class="form-label">Nombre:</label>
                   <input type="text" class="form-control" name="name" id="name" value="{{ old('name',$product->name) }}">
                   @error('name')
                       <small class="text-danger">{{'*'.$message }}</small>
                   @enderror
               </div>

               {{-- Descripcion --}}
               <div class="col-md-12 mb-2">
                   <label for="description">Descripción:</label>
                   <textarea name="description" class="form-control" id="description" rows="3">{{ old('description',$product->description) }}</textarea>
                   @error('description')
                   <small class="text-danger">{{'*'.$message }}</small>
                   @enderror
               </div>

               {{-- Fecha de vencimiento --}}
               <div class="col-md-6 mb-2">
                   <label for="expiration_date" class="form-label">Fecha de vencimiento:</label>
                   <input type="date" class="form-control" name="expiration_date" id="expiration_date" value="{{ old('expiration_date',$product->expiration_date) }}">
                   @error('expiration_date')
                       <small class="text-danger">{{'*'.$message }}</small>
                   @enderror
               </div>

               {{-- Imagen --}}
               <div class="col-md-6">
                    <label for="img_path" class="form-label">Imagen:</label>
                    <input type="file" name="img_path" id="img_path" class="form-control" accept="image/*">
                    @error('img_path')
                        <small class="text-danger">{{'*'.$message}}</small>
                    @enderror
               </div>

               {{-- Marca --}}
               <div class="col-md-6 mb-2">
                   <label for="brand_id" class="form-label">Marca:</label>
                   <select data-size="4"  title="Seleccione una marca" data-live-search="true" name="brand_id" id="brand_id" class="form-control selectpicker">
                       @foreach ($brands as $item)
                       @if ( $product->brand_id == $item->id )
                       <option selected value="{{$item->id}}" {{ old('brand_id') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                       @else
                       <option value="{{$item->id}}" {{ old('brand_id') == $item->id ? 'selected' : '' }}>{{$item->name}}</option>
                       @endif
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
                   <button type="submit" class="btn btn-primary" style="width: 100%;">Actualizar</button>
               </div>
           </div>
        </form>
    </div>
</div>
@endsection

@push('js')

@endpush
