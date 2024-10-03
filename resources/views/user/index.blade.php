@extends('template')

@section('title','Usuarios')

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
    <h1 class="mt-4">Usuarios</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item active">Usuarios</li>
    </ol>

    @can('crear-user')
    <div class="mb-4">
        <a href="{{ route('user.create') }}"><button type="button" class="btn btn-primary">Añadir nuevo Usuario</button></a>
    </div>
    @endcan

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Usuarios Existentes
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Acciones</th>
                    </tr>
                <thead>
                <tbody>
                    @foreach ( $users as $item )
                    @if( $item->id != 1 || $item->id == auth()->user()->id )
                        <tr>
                            <td>  {{ $item->name }} </td>
                            <td>  {{ $item->email }} </td>
                            <td>  {{ $item->getRoleNames()->first() }} </td>

                            <td>
                                <div class="btn-group" user="group" aria-label="Basic mixed styles example">
                                    @can('editar-user')
                                   <form action="{{ route('user.edit',['user' => $item]) }}" method="get">
                                        <button type="submit" class="btn btn-warning">Editar</button>
                                    </form>
                                    @endcan
                                    @can('eliminar-user')
                                        @if (!($item->id == auth()->user()->id))
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $item->id }}">Eliminar</button>
                                        @endif
                                    @endcan
                                  </div>
                            </td>
                        </tr>
                        @endif
                        <!-- Modal Confirm -->
                        <div class="modal fade" id="confirmModal-{{ $item->id }}" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="confirmModalLabel">Detalles del Roles</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                <div class="modal-body">
                                    ¿Estás seguro de eliminar el Usuario?
                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                                <form action="{{ route('user.destroy',['user'=>$item->id]) }}" method="post">
                                    @method('DELETE')
                                    @csrf

                                    {{-- @if ($item->person->status == 1)--}}
                                    <button type="submit" class="btn btn-danger">Confirmar</button>
                                    {{--    @else
                                    <button type="submit" class="btn btn-success">Confirmar</button>
                                    @endif --}}
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
