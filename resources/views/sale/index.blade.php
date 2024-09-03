@extends('template')

@section('title','Compras')

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
    <h1 class="mt-4">Compras</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Compras</li>
    </ol>
    <div class="mb-4">
        <a href="{{ route('purchase.create') }}"> <button type="button" class="btn btn-primary">Añadir nuevo registro</button></a>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Compras Realizadas
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Comprobante</th>
                        <th>Proveedor</th>
                        <th>Fecha y hora</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchases as $item)
                    <tr>
                        <td>
                            <p class="fw-semibold mb-1">
                                {{ $item->receipt->receipt_type }}
                            </p>
                            <p class="text-muted mb-0">
                                {{ $item->receipt_number }}
                            </p>
                        </td>
                        <td>
                            <p class="fw-semibold mb-1">
                                {{ $item->provider->person->business_name }}
                            </p>
                            <p class="text-muted mb-0">
                                Tipo de persona: {{ $item->provider->person->person_type }}
                            </p>
                        </td>
                        <td>
                            {{
                            \Carbon\Carbon::parse($item->date_time)->format('d-m-Y') .'  -  '.
                            \Carbon\Carbon::parse($item->date_time)->format('H:i')
                            }}
                        </td>
                        <td>
                            {{ $item->total }}
                        </td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <form action="{{ route('purchase.show', ['purchase'=>$item]) }}" method="get">
                                    <button type="submit" class="btn btn-success">Ver</button>
                                </form>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $item->id }}">Eliminar</button>
                            </div>
                        </td>
                    </tr>
                    <!-- Modal Confirm -->
                        <div class="modal fade" id="confirmModal-{{ $item->id }}" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalLabel">Detalles de la Compra</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                <div class="modal-body">

                              ¿Estás seguro de eliminar el registo?

                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                                <form action="{{ route('purchase.destroy',['purchase'=>$item->id]) }}" method="post">
                                    @method('DELETE')
                                    @csrf

                                    <button type="submit" class="btn btn-danger">Confirmar</button>

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
