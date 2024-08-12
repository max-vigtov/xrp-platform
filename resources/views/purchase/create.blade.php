@extends('template')
@section('title','Crear Compra')

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Crear Compra</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('purchase.index') }}">Compras</a></li>
        <li class="breadcrumb-item active">Crear Compra</li>
    </ol>
</div>
    <div class="container w-100 border border-3 border-primary rounded p-4 mt-3" >
        <form action="{{ route('purchase.store') }}" method="post">
            @csrf

            <div class="container mt-4">
                <div class="row gy-4">
                    {{-- Product-Purchase --}}
                    <div class="col-xl-8">
                        <div class="text-white bg-primary p-1 text-center">
                            Detalles de la compra
                        </div>
                        <div class="p-3 border boder-3 border-primary">
                            <div class="row">

                                {{-- Product --}}
                                <div class="col-md-12 mb-2">
                                    <select name="product_id" id="product_id" class="form-control selectpicker" data-live-search="true" data-size="5" title="Seleccione un producto">
                                        @foreach ($products as $item)
                                            <option value="{{ $item->id }}">{{ $item->code.'  '.$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Quantity --}}
                                <div class="col-md-4 mb-2">
                                    <label for="quantity" class="form-label">Cantidad:</label>
                                    <input type="number" name="quantity" id="quantity" class="form-control">
                                </div>

                                {{-- purchase_price --}}
                                <div class="col-md-4 mb-2">
                                    <label for="purchase_price" class="form-label">Precio de compra:</label>
                                    <input type="number" name="purchase_price" id="purchase_price" class="form-control" step="0.1">
                                </div>

                                {{-- sale_price --}}
                                <div class="col-md-4 mb-3">
                                    <label for="sale_price" class="form-label">Precio de venta:</label>
                                    <input type="number" name="sale_price" id="sale_price" class="form-control" step="0.1">
                                </div>

                                {{-- button --}}
                                <div class="col-md-12 mb-2 text-end">
                                    <button class="btn btn-primary" type="button">Agregar</button>
                                </div>

                                {{--  Detail Table --}}
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="detail-table" class="table table-hover">
                                            <thead class="bg-primary">

                                                <tr>
                                                    <th class="text-white">#</th>
                                                    <th class="text-white">Producto</th>
                                                    <th class="text-white">Cantidad</th>
                                                    <th class="text-white">Precio compra</th>
                                                    <th class="text-white">Precio venta</th>
                                                    <th class="text-white">Subtotal</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th></th>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>Sumas</th>
                                                    <th>0</th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th>IVA %</th>
                                                    <th>0</th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th>Total</th>
                                                    <th>0</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- Product --}}
                    <div class="col-md-4">
                      <div class="text-white bg-success p-1 text-center">
                            Datos Generales
                        </div>
                        <div class="p-3 border boder-3 border-success">
                          <div class="row">

                             {{-- Provider --}}
                             <div class="col-md-12 mb-2">
                                 <label for="provider_id" id="provider_id">Proveedor:</label>
                                 <select name="provider_id" id="provider_id" class="form-control selectpicker show-tick" data-live-search="true" title="Selecciona" data-size='2'>
                                    @foreach ($providers as $item)
                                        <option value="{{ $item->id }}">{{ $item->person->business_name}}</option>
                                    @endforeach
                                   </select>
                              </div>

                             {{-- Receipt Type --}}
                              <div class="col-md-12 mb-2">
                                 <label for="receipt_id" id="receipt_id">Comprobante:</label>
                                 <select name="receipt_id" id="receipt_id" class="form-control selectpicker show-tick" title="Selecciona" data-size='2'>
                                    @foreach ($receipts as $item)
                                        <option value="{{ $item->id }}">{{ $item->receipt_type}}</option>
                                    @endforeach
                                 </select>
                             </div>

                             {{-- Receipt Number --}}
                             <div class="col-md-12 mb-2">
                                <label for="receipt_number" id="receipt_id">Número de Comprobante:</label>
                                <input required type="text" name="receipt_number" id="receipt_number" class="form-control">
                             </div>

                             {{-- Tax --}}
                             <div class="col-md-6 mb-2">
                                <label for="tax" class="form-label">Impuesto:</label>
                                <input disabled readonly type="text" name="tax" id="tax" class="form-control border-success">
                             </div>

                             {{-- Date --}}
                             <div class="col-md-6 mb-2">
                                <label for="date" class="form-label">Fecha:</label>
                                <input disabled readonly type="date" name="date" id="date" class="form-control border-success" value="<?php echo date("Y-m-d") ?>">
                             </div>

                             {{-- Buttons --}}
                             <div class="col-md-12 mb-12 text-center">
                                <button type="submit" class="btn btn-success">Guardar</button>
                             </div>

                          </div>
                      </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endpush
