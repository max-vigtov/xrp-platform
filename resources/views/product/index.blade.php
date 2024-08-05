@extends('template')

@section('title','Productos')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
<style>
    .img-small {
      width: 100px; /* Ajusta este valor según tus necesidades */
      height: auto;
    }
  </style>
@endpush

@section('content')
@if (session('success'))
<script>
    let message = "{{ session('success') }}";
    const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 1800,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast.fire({
  icon: "success",
  title: message
});
</script>
@endif

<div class="container-fluid px-4">
    <h1 class="mt-4">Productos</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Productos</li>
    </ol>
    <div class="mb-4">
        <a href="{{ route('product.create') }}"> <button type="button" class="btn btn-primary">Añadir nuevo registro</button></a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Productos creados
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Código</th>
                        <th>Categoría</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $item)
                        <tr>
                            <td>
                                <div>
                                    @if($item->img_path != null)
                                    <img src="{{ Storage::url('public/products/'.$item->img_path) }}" alt="{{ $item->name }}" class="img-fluid img-thumbnail img-small">
                                  @else
                                    <img src="" alt="{{ $item->name }}" class="img-small">
                                    @endif
                                </div>
                            </td>
                            <td>
                                {{ $item->name }}
                            </td>
                            <td>
                                {{ $item->brand->property->name }}
                            </td>
                            <td>
                                {{ $item->code }}
                            </td>
                            <td>
                                @foreach ($item->categories as $category)
                                <div class="container">
                                    <div class="row">
                                        <span class="m-1 rounded-pill p-1 bg-secondary text-white text-center">{{ $category->property->name }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </td>
                            <td>
                                @if($item->status == 1)
                                <span class="fw-bolder rounded p-1 bg-success text-white text-center">ACTIVO</span>
                                @else
                                <span class="fw-bolder rounded p-1 bg-danger text-white text-center">ELIMINADO</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                   <form action="{{ route('product.edit',['product' => $item]) }}" method="get">
                                        <button type="submit" class="btn btn-warning">Editar</button>
                                    </form>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#viewModal-{{$item->id}}">Ver Producto</button>
                                    <button type="button" class="btn btn-danger">Eliminar</button>
                                  </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="viewModal-{{$item->id}}" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="viewModalLabel">Detalles del producto</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                  <div class="row mb-3">
                                    <label for=""> <span class="fw-bolder">Descripción: </span>{{ $item->description }}</label>
                                  </div>

                                  <div class="row mb-3 b">
                                    <label for=""><span class="fw-bolder">Fecha de vencimiento: </span>{{ $item->expiration_date == '' ? 'No tiene' : $item->expiration_date}}</label>
                                  </div>

                                  <div class="row mb-3 b">
                                    <label for=""><span class="fw-bolder">Stock: </span>{{ $item->stock}}</label>
                                  </div>
                                  <div class="row">
                                    <div>
                                        @if($item->img_path != null)
                                        <img src="{{ Storage::url('public/products/'.$item->img_path) }}" alt="{{ $item->name }}" class="img-fluid .img-thumbnail ">
                                        @else
                                        <img src="" alt="{{ $item->name }}">
                                        @endif
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
<script src="{{ asset('js/datatables-simple-demo.js') }}"></script>

@endpush
