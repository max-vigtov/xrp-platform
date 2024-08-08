@extends('template')
@section('title','Editar Cliente')

@push('css')

@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Editar Cliente</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('client.index') }}">Clientes</a></li>
        <li class="breadcrumb-item active">Editar Cliente</li>
    </ol>
    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3" >
        <form action="{{route('client.update',['client'=>$client])}}" method="post" enctype="multipart/form-data">
            @method('PATCH')
            @csrf
            <div class="row g-3">

                    {{-- Person Type --}}
                    <div class="col-md-12">
                        <label for="person_type" class="form-label">Tipo de entidad: <span class="fw-bold">{{ strtoupper($client->person->person_type) }}</span></label>
                    </div>

                    {{-- Business Name --}}
                    <div class="col-md-6 mb-2" id="box-business-name">

                        @if ($client->person->person_type == 'física')
                        <label id="label-fisica" for="business_name" class="form-label">Nombre(s) y apellidos:</label>
                        @else
                        <label id="label-moral" for="business_name" class="form-label">Nombre de la empresa:</label>
                        @endif
                        <input type="text" name="business_name" id="business_name" class="form-control" value="{{ old('business_name', $client->person->business_name) }}"></input>
                        @error('business_name')
                            <small class="text-danger">{{'*'.$message }}</small>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div class="col-md-12 mb-2">
                        <label for="address" class="form-label">Dirección:</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $client->person->address) }}">
                        @error('address')
                        <small class="text-danger">{{'*'.$message }}</small>
                         @enderror
                    </div>

                    {{-- document_id --}}
                    <div class="col-md-6">
                        <label for="document_id" class="form-label">Tipo de documento:</label>
                        <select class="form-select" name="document_id" id="document_id">
                            @foreach ($documents as $item)
                            @if ($client->PERSON->document_id == $item->id)
                            <option selected value="{{$item->id}}" {{ old('document_id') == $item->id ? 'selected' : '' }}>{{$item->document_type}}</option>
                            @else
                            <option value="{{$item->id}}" {{ old('document_id') == $item->id ? 'selected' : '' }}>{{$item->document_type}}</option>
                            @endif
                            @endforeach
                        </select>
                            @error('document_id')
                            <small class="text-danger">{{'*'.$message}}</small>
                            @enderror
                    </div>

                    {{-- document_number --}}
                    <div class="col-md-6 mb-2">
                        <label for="document_number" class="form-label">Número de documento:</label>
                        <input type="text" name="document_number" id="document_number" class="form-control" value="{{ old('document_number',$client->person->document_number) }}">
                        @error('document_number')
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
