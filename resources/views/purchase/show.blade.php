@extends('template')
@section('title','Ver Compra')

@push('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Ver Compra</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('purchase.index') }}">Compras</a></li>
        <li class="breadcrumb-item active">Ver Compra</li>
    </ol>
</div>

<div class="container w-100 p-4 mt-3">

    <div class="card p-2 mb-4">

        {{-- Document_type --}}
        <div class="row mb-2">
            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-file"></i></span>
                    <input disabled type="text" class="form-control" value="Tipo de comprobante: ">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value="{{ $purchase->receipt->receipt_type }}">
            </div>
        </div>

        {{-- Document_number --}}
        <div class="row mb-2">
            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
                    <input disabled type="text" class="form-control" value="Número de comprobante: ">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value="{{ $purchase->receipt_number }}">
            </div>
        </div>

        {{-- Provider --}}
        <div class="row mb-2">
            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
                    <input disabled type="text" class="form-control" value="Proveedor: ">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value="{{ $purchase->provider->person->business_name }}">
            </div>
        </div>

        {{-- Date --}}
        <div class="row mb-2">
            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                    <input disabled type="text" class="form-control" value="Fecha: ">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value=" {{ \Carbon\Carbon::parse($purchase->date_time)->format('d-m-Y') }}">
            </div>
        </div>

        {{-- Time --}}
        <div class="row mb-2">
            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
                    <input disabled type="text" class="form-control" value="Hora: ">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled type="text" class="form-control" value=" {{ \Carbon\Carbon::parse($purchase->date_time)->format('H:i') }}">
            </div>
        </div>

        {{-- Tax --}}
        <div class="row mb-2">
            <div class="col-sm-4">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-percent"></i></span>
                    <input disabled type="text" class="form-control" value="Impuesto: ">
                </div>
            </div>
            <div class="col-sm-8">
                <input disabled  id="input-tax" type="text" class="form-control" value=" {{ $purchase->tax }}">
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Detalle de la compra
            </div>
            <div class="cad-body">
                <table class="table table-striped">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio de compra</th>
                            <th>Precio de venta</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchase->products as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->pivot->quantity }}</td>
                            <td>{{ $item->pivot->purchase_price }}</td>
                            <td>{{ $item->pivot->selling_price }}</td>
                            <td class="td-subtotal">{{ $item->pivot->quantity * $item->pivot->purchase_price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5"></th>
                        </tr>
                        <tr>
                            <th colspan="4">Sumas:</th>
                            <th id="th-amount"></th>
                        </tr>
                        <tr>
                            <th colspan="4">IVA:</th>
                            <th id="th-iva"></th>
                        </tr>
                        <tr>
                            <th colspan="4">Total:</th>
                            <th id="th-total"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
let rowsSubtotal = document.getElementsByClassName('td-subtotal');
let cont = 0;
let tax = $('#input-tax').val();

$(document).ready(function(){
    calculateValues();
});

function calculateValues() {
    for (let i = 0; i < rowsSubtotal.length; i++) {
        cont += parseFloat(rowsSubtotal[i].innerHTML);
    }
    $('#th-amount').html(cont);
    $('#th-iva').html(tax);
    $('#th-total').html(cont + parseFloat(tax) );

}
</script>
@endpush
