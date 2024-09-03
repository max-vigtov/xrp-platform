@extends('template')
@section('title','Realizar Venta')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@push('css')

@endpush

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Registrar Venta</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ route('sale.index') }}">Ventas</a></li>
        <li class="breadcrumb-item active">Registrar Venta</li>
    </ol>
</div>

<form action="{{ route('sale.store') }}" method="post">
    @csrf
    <div class="container mt-4">
        <div class="row gy-4">
            {{-- Product-sale --}}
            <div class="col-xl-8">
                <div class="text-white bg-primary p-1 text-center">
                    Detalles de la venta
                </div>
                <div class="p-3 border boder-3 border-primary">
                    <div class="row">

                        {{-- Product --}}
                        <div class="col-md-12 mb-4">
                            <select name="product_id" id="product_id" class="form-control selectpicker" data-live-search="true" data-size="5" title="Seleccione un producto">
                                @foreach ($products as $item)
                                    <option value="{{$item->id}}-{{$item->stock}}-{{$item->selling_price}}">{{ $item->code.'  '.$item->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Stock --}}
                        <div class="d-flex justify-content-start mb-4">
                            <div class="col-md-4 mb-2">
                                <div class="row">
                                    <label for="stock" class="form-label col-sm-4">En stock:</label>
                                    <div class="col-sm-8">
                                        <input disabled type="text" name="stock" id="stock" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Quantity --}}
                        <div class="col-md-4 mb-2">
                            <label for="quantity" class="form-label">Cantidad:</label>
                            <input type="number" name="quantity" id="quantity" class="form-control">
                        </div>

                        {{-- selling_price --}}
                        <div class="col-md-4 mb-3">
                            <label for="selling_price" class="form-label">Precio de venta:</label>
                            <input disabled type="number" name="selling_price" id="selling_price" class="form-control" step="0.1">
                        </div>

                        {{-- discount --}}
                        <div class="col-md-4 mb-3">
                            <label for="discount" class="form-label">Descuento:</label>
                            <input type="number" name="discount" id="discount" class="form-control">
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
                                            <th class="text-white">Precio venta</th>
                                            <th class="text-white">Descuento</th>
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
                                Cancelar venta
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Venta --}}
            <div class="col-md-4">
              <div class="text-white bg-success p-1 text-center">
                    Datos Generales
                </div>
                <div class="p-3 border boder-3 border-success">
                  <div class="row">

                     {{-- Client --}}
                     <div class="col-md-12 mb-2">
                         <label for="client_id" id="client_id">Cliente:</label>
                         <select name="client_id" id="client_id" class="form-control selectpicker show-tick" data-live-search="true" title="Selecciona" data-size='2'>
                            @foreach ($clients as $item)
                                <option value="{{ $item->id }}">{{ $item->person->business_name}}</option>
                            @endforeach
                         </select>
                         @error('client_id')
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
    <!-- cancel sale Modal -->
    <div class="modal fade" id="cancelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Advertencia</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Seguro que quieres cancelar la venta?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btnCancelSale" type="button" class="btn btn-danger" data-bs-dismiss="modal">Confirmar</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function() {

        $('#product_id').change(showValues);

        $('#btn_add').click(function() {
            addProduct();
        });

        $('#btnCancelSale').click(function() {
            cancelSale();
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

    function showValues(){
        let dataProduct = document.getElementById('product_id').value.split('-');
        $('#stock').val(dataProduct[1]);
        $('#selling_price').val(dataProduct[2]);
    }

    function addProduct(){
        let dataProduct = document.getElementById('product_id').value.split('-');
        let idProduct = dataProduct[0];
        let nameProduct = $('#product_id option:selected').text();
        let quantity = $('#quantity').val();
        let sellingPrice = $('#selling_price').val();
        let discount = $('#discount').val();
        let stock = $('#stock').val();

        if(discount == ''){
            discount = 0;
        }

     if (idProduct != '' && quantity != ''){

        if( parseInt(quantity) > 0 && ( quantity % 1 == 0 ) && parseFloat(discount) >= 0 ){

            if( parseInt(quantity) <= parseInt(stock) ){

                subTotal[cont] = round( quantity * sellingPrice - discount );
                amount += subTotal[cont];
                iva = round( amount / 100 * tax );
                total = round( amount + iva );

                let row = '<tr id="row'+ cont +'">' +
                        '<th>' + (cont + 1) + '</th>' +
                        '<td> <input type="hidden" name="arrayIdProduct[]" value = "'+ idProduct + '">' + nameProduct + '</td>' +
                        '<td> <input type="hidden" name="arrayQuantity[]" value = "'+ quantity + '">' + quantity + '</td>' +
                        '<td> </td> <input type="hidden" name="arraySellingPrice[]" value = "'+ sellingPrice + '">$ ' + sellingPrice + '</td>' +
                        '<td> </td> <input type="hidden" name="arrayDicount[]" value = "'+ discount + '">$ ' + discount + '</td>' +
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
                showModal('No hay suficiente Stock.')
            }

        } else{
            showModal('Faltan campos por llenar.')
        }

     } else{
            showModal('Hacen falta campos por completar.');
       }
    }

    function cleanFields(){
        let select = $('#product_id');
        select.selectpicker('val', '');
        $('#quantity').val('');
        $('#discount').val('');
        $('#selling_price').val('');
        $('#stock').val('');
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

    function deleteProduct(index){
        amount -= round(subTotal[index]);
        iva = round( (amount / 100) * tax );
        total = round( amount + iva );

        $('#amount').html(amount);
        $('#iva').html(iva);
        $('#total').html(total);
        $('#tax').val(iva);
        $('#inputTotal').val(total);

        $('#row'+ index).remove();

        disableButtons();
    }

    function cancelSale(){
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
