@extends('template')

@section('title','Marcas')

@push('css')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
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
    <h1 class="mt-4">Marcas</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Marcas</li>
    </ol>

    @can('crear-marca')
    <div class="mb-4">
        <a href="{{ route('brand.create') }}"> <button type="button" class="btn btn-primary">Añadir nuevo registro</button></a>
    </div>
    @endcan

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Marcas creadas
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                   @foreach ($brands as $brand)
                        <tr>
                            <td>
                                {{ $brand->property->name }}
                            </td>
                            <td>
                                {{ $brand->property->description }}
                            </td>
                            <td>
                                @if ($brand->property->status == 1)
                                <span class="fw-bolder p-1 rounded bg-success text-white">Activo</span>
                                @else
                                <span class="fw-bolder p-1 rounded bg-danger text-white">Eliminado</span>

                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    @can('editar-marca')
                                    <form action="{{ route('brand.edit',['brand'=>$brand]) }}" method="get">
                                        <button type="submit" class="btn btn-warning">Editar</button>
                                    </form>
                                    @endcan
                                    @can('eliminar-marca')
                                        @if($brand->property->status == 1)
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $brand->id }}">Eliminar</button>
                                        @else
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $brand->id }}">Restaurar</button>
                                        @endif
                                    @endcan
                                  </div>
                            </td>
                        </tr>

                        <!-- Button trigger modal -->
                            <div class="modal fade" id="confirmModal-{{ $brand->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Mensaje de confirmación</h5>
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">

                                    {{ $brand->property->status == 1
                                    ? ' ¿Estás seguro de eliminar la Marca?'
                                    : '¿Estás seguro de restaurar la Marca?'
                                    }}

                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                                    <form action="{{ route('brand.destroy',['brand'=>$brand->id]) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        @if ( $brand->property->status == 1)
                                        <button type="submit" class="btn btn-danger">Confirmar</button>
                                        @else
                                        <button type="submit" class="btn btn-success">Confirmar</button>
                                        @endif
                                    </form>
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
