@extends('template')
@section('title','Registrar Proveedor')

@push('css')
    <style>
        #box-business-name{
            display: none;
        }
    </style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Registrar Proveedor</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('provider.index') }}">Proveedores</a></li>
        <li class="breadcrumb-item active">Registrar Proveedor</li>
    </ol>

    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3" >
        <form action="{{ route('provider.store') }}" method="post"  enctype="multipart/form-data">
            @csrf
            <div class="row g-3">

                {{-- Person Type --}}
                <div class="col-md-6">
                    <label for="name" class="form-label">Tipo de entidad:</label>
                    <select class="form-select" name="person_type" id="person_type">
                        <option value="" selected disabled>Selecciona una opción</option>
                        <option value="Física" {{ old('peson_type' == 'Física' ? 'selected' : '') }}>Persona Física</option>
                        <option value="Moral" {{ old('peson_type' == 'Moral' ? 'selected' : '') }}>Persona Moral</option>
                    </select>
                    @error('peson_type')
                        <small class="text-danger">{{'*'.$message }}</small>
                    @enderror
                </div>

                {{-- Business Name --}}
                <div class="col-md-6 mb-2" id="box-business-name">
                    <label id="label-fisica" for="business_name" class="form-label">Nombre(s) y apellidos:</label>
                    <label id="label-moral" for="business_name" class="form-label">Nombre de la empresa:</label>

                    <input type="text" name="business_name" id="business_name" class="form-control" value="{{ old('business_name') }}"></input>
                    @error('business_name')
                        <small class="text-danger">{{'*'.$message }}</small>
                    @enderror
                </div>

                {{-- Address --}}
                <div class="col-md-12 mb-2">
                    <label for="address" class="form-label">Dirección:</label>
                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                    @error('address')
                    <small class="text-danger">{{'*'.$message }}</small>
                     @enderror
                </div>

                {{-- document_id --}}
                <div class="col-md-6">
                    <label for="document_id" class="form-label">Tipo de documento:</label>
                    <select class="form-select" name="document_id" id="document_id">
                        <option value="" selected disabled>Selecciona una opción</option>
                        @foreach ($documents as $item)
                            <option value="{{ $item->id }}">{{ $item->document_type }}</option>
                        @endforeach
                    </select>
                    @error('document_id')
                        <small class="text-danger">{{'*'.$message }}</small>
                    @enderror
                </div>
                {{-- document_number --}}
                <div class="col-md-6 mb-2">
                    <label for="document_number" class="form-label">Número de documento:</label>
                    <input type="text" name="document_number" id="document_number" class="form-control" value="{{ old('document_number') }}">
                    @error('document_number')
                    <small class="text-danger">{{'*'.$message }}</small>
                     @enderror
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Crear</button>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function(){
        $('#person_type').on('change', function(){
            let selectValue = $(this).val();
            if (selectValue == 'Física') {
                $('#label-moral').hide();
                $('#label-fisica').show();
            } else {
                $('#label-fisica').hide();
                $('#label-moral').show();
            }
            $('#box-business-name').show();
        });
    });
</script>
@endpush
