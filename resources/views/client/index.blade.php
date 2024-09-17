@extends('template')

@section('title','Clientes')

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
    <h1 class="mt-4">Clientes</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Clientes</li>
    </ol>

    @can('crear-cliente')
    <div class="mb-4">
        <a href="{{ route('client.create') }}"> <button type="button" class="btn btn-primary">Registrar Cliente</button></a>
    </div>
    @endcan

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Clientes registrados
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>Tipo de documento</th>
                        <th>Tipo de persona</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                <thead>
                <tbody>
                    @foreach ( $clients as $item )
                        <tr>
                            <td>  {{ $item->person->business_name }} </td>
                            <td>  {{ $item->person->address }} </td>
                            <td>
                                <p class="fw-normal mb-1"> {{ $item->person->document->document_type }} </p>
                                <p class="text-muted mb-0">  {{ $item->person->document_number }} </p>
                            </td>
                            <td>  {{ $item->person->person_type }} </td>
                            <td>
                                @if($item->person->status == 1)
                                <span class="fw-bolder rounded p-1 bg-success text-white text-center">ACTIVO</span>
                                @else
                                <span class="fw-bolder rounded p-1 bg-danger text-white text-center">ELIMINADO</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                    @can('editar-cliente')
                                    <form action="{{ route('client.edit',['client' => $item]) }}" method="get">
                                        <button type="submit" class="btn btn-warning">Editar</button>
                                    </form>
                                    @endcan

                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#viewModal-{{ $item->id }}">Ver Cliente</button>

                                    @can('eliminar-cliente')
                                        @if($item->person->status == 1)
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $item->id }}">Eliminar</button>
                                        @else
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $item->id }}">Restaurar</button>
                                        @endif
                                    @endcan

                                  </div>
                            </td>
                        </tr>
                        <!-- Modal Confirm -->
                        <div class="modal fade" id="confirmModal-{{ $item->id }}" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalLabel">Detalles del Cliente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                <div class="modal-body">

                                {{ $item->person->status == 1
                                ? '¿Estás seguro de eliminar el Cliente?'
                                : '¿Estás seguro de restaurar el Cliente?'
                                }}

                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                                <form action="{{ route('client.destroy',['client'=>$item->person->id]) }}" method="post">
                                    @method('DELETE')
                                    @csrf

                                    @if ($item->person->status == 1)
                                    <button type="submit" class="btn btn-danger">Confirmar</button>
                                    @else
                                    <button type="submit" class="btn btn-success">Confirmar</button>
                                    @endif
                                </form>
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
