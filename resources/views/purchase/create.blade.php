@extends('template')
@section('title','Crear Compra')

@push('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Registrar Compra</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('purchase.index') }}">Compras</a></li>
        <li class="breadcrumb-item active">Registrar Compra</li>
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

                                {{-- selling_price --}}
                                <div class="col-md-4 mb-3">
                                    <label for="selling_price" class="form-label">Precio de venta:</label>
                                    <input type="number" name="selling_price" id="selling_price" class="form-control" step="0.1">
                                </div>

                                {{-- button --}}
                                <div class="col-md-12 mb-2 text-end">
                                    <button id="btn_add" class="btn btn-primary" type="button">Agregar</button>
                                </div>

                                {{-- Detail Table --}}
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table id="detail_table" class="table table-hover">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th class="text-white">#</th>
                                                    <th class="text-white">Producto</th>
                                                    <th class="text-white">Cantidad</th>
                                                    <th class="text-white">Precio compra</th>
                                                    <th class="text-white">Precio venta</th>
                                                    <th class="text-white">Subtotal</th>
                                                    <th>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th></th>
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
                                                    <th colspan="4">Sumas</th>
                                                    <th colspan="2"><span id="amount">0</span></th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th colspan="4">IVA %</th>
                                                    <th colspan="2"><span id="iva">0</span></th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th colspan="4">Total</th>
                                                    <th colspan="2"> <input type="hidden" name="total" value="0" id="inputTotal"> <span id="total">0</span></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                {{-- Cancel Button --}}
                                <div class="col-md-12 mb-2 text-end">
                                    <button id="cancelButton" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#cancelModal">
                                        Cancelar compra
                                    </button>
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
                                 @error('provider_id')
                                    <small class="text-danger">{{'*'.$message }}</small>
                                 @enderror
                              </div>

                             {{-- Receipt Type --}}
                              <div class="col-md-12 mb-2">
                                 <label for="receipt_id" id="receipt_id">Comprobante:</label>
                                 <select name="receipt_id" id="receipt_id" class="form-control selectpicker show-tick" title="Selecciona" data-size='2'>
                                    @foreach ($receipts as $item)
                                        <option value="{{ $item->id }}">{{ $item->receipt_type}}</option>
                                    @endforeach
                                 </select>
                                 @error('receipt_id')
                                    <small class="text-danger">{{'*'.$message }}</small>
                                 @enderror
                             </div>

                             {{-- Receipt Number --}}
                             <div class="col-md-12 mb-2">
                                <label for="receipt_number" id="receipt_id">Número de Comprobante:</label>
                                <input required type="text" name="receipt_number" id="receipt_number" class="form-control">
                                @error('receipt_number')
                                    <small class="text-danger">{{'*'.$message }}</small>
                                @enderror
                             </div>

                             {{-- Tax --}}
                             <div class="col-md-6 mb-2">
                                <label for="tax" class="form-label">Impuesto:</label>
                                <input readonly type="text" name="tax" id="tax" class="form-control border-success">
                                @error('tax')
                                    <small class="text-danger">{{'*'.$message }}</small>
                                @enderror
                             </div>

                             {{-- Date --}}
                             <div class="col-md-6 mb-2">
                                <label for="date" class="form-label">Fecha:</label>
                                <input readonly type="date" name="date" id="date" class="form-control border-success" value="<?php echo date("Y-m-d") ?>">

                                <?php
                                use Carbon\Carbon;
                                $date_time = Carbon::now()->toDateTimeString();
                                ?>

                                <input type="hidden" name="date_time" value="{{ $date_time }}">
                             </div>

                             {{-- Buttons --}}
                             <div class="col-md-12 mb-12 text-center">
                                <button id="saveButton" type="submit" class="btn btn-success">Guardar</button>
                             </div>
                          </div>
                      </div>
                    </div>
                </div>
            </div>
            <!-- cancel purchase Modal -->
            <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Advertencia</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Seguro que quieres cancelar la compra?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button id="btnCancelPurchase" type="button" class="btn btn-danger" data-bs-dismiss="modal">Confirmar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function() {
        $('#btn_add').click(function() {
            addProduct();
        });

        $('#btnCancelPurchase').click(function() {
            cancelPurchase();
        });

        disableButtons();

        $('#tax').val(tax + '%')
    });

    let cont = 0;
    let subTotal = [];
    let amount = 0;
    let iva = 0;
    let total = 0;

    const tax = 16;

    function cancelPurchase(){
        $('#detail_table tbody').empty();

        let row = '<tr>' +
            '<th></th>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '<td></td>' +
            '</tr>';
        $('#detail_table').append(row);

        cont = 0;
        subTotal = [];
        amount = 0;
        iva = 0;
        total = 0;

        $('#amount').html(amount);
        $('#iva').html(iva);
        $('#total').html(total);
        $('#tax').val(tax + '%');
        $('#inputTotal').val(total);

        cleanFields();
        disableButtons();
    }

    function disableButtons(){
        if( total == 0 ){
            $('#saveButton').hide();
            $('#cancelButton').hide();
        }else{
            $('#saveButton').show();
            $('#cancelButton').show();
        }
    }

    function addProduct(){
        let idProduct = $('#product_id').val();
        let nameProduct = ($('#product_id option:selected').text()).split('  ')[1];
        let quantity = $('#quantity').val();
        let purchasePrice = $('#purchase_price').val();
        let salePrice = $('#selling_price').val();

     if (nameProduct != '' && nameProduct != undefined && quantity != '' && purchasePrice != '' && salePrice != ''){

        if( parseInt(quantity) > 0 && ( quantity % 1 == 0 ) && parseFloat(purchasePrice) > 0 && parseFloat(salePrice) > 0 ){

            if( parseFloat(salePrice) >= parseFloat(purchasePrice) ){

                subTotal[cont] = round( quantity * purchasePrice );
                amount += subTotal[cont];
                iva = round( amount / 100 * tax );
                total = round( amount + iva );

                let row = '<tr id="row'+ cont +'">' +
                        '<th>' + (cont + 1) + '</th>' +
                        '<td> <input type="hidden" name="arrayIdProduct[]" value = "'+ idProduct + '">' + nameProduct + '</td>' +
                        '<td> <input type="hidden" name="arrayQuantity[]" value = "'+ quantity + '">' + quantity + '</td>' +
                        '<td> </td> <input type="hidden" name="arrayPurchasePrice[]" value = "'+ purchasePrice + '">$ ' + purchasePrice + '</td>' +
                        '<td> </td> <input type="hidden" name="arraySellingPrice[]" value = "'+ salePrice + '">$ ' + salePrice + '</td>' +
                        '<td>$ ' + subTotal[cont]+ '</td>' +
                        '<td><button class="btn btn-danger" type="button" onClick="deleteProduct('+ cont +')"><i class="fa-solid fa-trash"></i></button></td>' +
                        '</tr>';
                $('#detail_table').append(row);
                cleanFields();
                cont++;
                disableButtons();

                $('#amount').html(amount);
                $('#iva').html(iva);
                $('#total').html(total);
                $('#tax').val(iva);
                $('#inputTotal').val(total);

            }else{
                showModal('El precio de venta tiene que ser mayor que el de compra.')
            }

        } else{
            showModal('Valores Incorrectos.')
        }

     } else{
            showModal('Hacen falta campos por completar.');
       }
    }

    function deleteProduct(index){
        amount -= round(subTotal[index]);
        iva = round( (amount / 100) * tax );
        total = round( amount + iva );

        $('#amount').html(amount);
        $('#iva').html(iva);
        $('#total').html(total);
        $('#row'+ index).remove();
        $('#tax').val(iva);
        $('#inputTotal').val(total);
    }

    function cleanFields(){
        let select = $('#product_id');
        select.selectpicker('val', '');
        $('#quantity').val('');
        $('#purchase_price').val('');
        $('#selling_price').val('');
    }

    function round(num, decimales = 2) {
        var signo = (num >= 0 ? 1 : -1);
        num = num * signo;
        if (decimales === 0) //con 0 decimales
            return signo * Math.round(num);
        // round(x * 10 ^ decimales)
        num = num.toString().split('e');
        num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
        // x * 10 ^ (-decimales)
        num = num.toString().split('e');
        return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
    }

    function showModal(message, icon = 'error') {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: icon,
            title: message
        })
    }

</script>
@endpush
