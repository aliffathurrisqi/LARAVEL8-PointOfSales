@extends('layouts.main')

@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Pembelian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
              <li class="breadcrumb-item"><a href="{{ route('transaction-purchasing') }}">Stock In</a></li>
              <li class="breadcrumb-item active">Create</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <form method="POST" action="{{ route('transaction-purchasing-store') }}">
    @csrf
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">

                <div class="row">
                    <div class="form-group col-6">
                        <label>Code : </label>
                        <input type="text" class="form-control" name="code" placeholder="Masukkan Code" required>
                    </div>

                    <div class="form-group col-6">
                        <label>Purchase Date : </label>
                        <input type="date" class="form-control" name="purchase_date" required>
                    </div>

                </div>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="col-5">Nama Produk</th>
                    <th class="col-3">Jumlah</th>
                    <th class="col-3">Harga (Rp)</th>
                    <th class="col-1 text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody id="newinput">
                    {{-- <td colspan="4" style="height: 0px;"></td> --}}
                  </tbody>
                  <tfoot>
                    <tr>
                        <td colspan="4"><button type="button" class="btn btn-default w-100" id="rowAdder">Tambah Barang</button></td>
                    </tr>
                  </tfoot>
                </table>

                <button type="submit" class="btn btn-primary mt-3 float-right w-25">Simpan Data</button>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </form>
@endsection

@section('add-script')

{{-- @foreach ($products as $item)
    <option value="{{ $item->id }}">{{ $item->name }}</option>
@endforeach --}}

<script>
    $("#rowAdder").click(function () {
        newRowAdd =
        "<tr id='row'>"+
            "<td>"+
                "<select name='product_id[]' class='form-control'>"+
                    '@foreach ($products as $item) <option value="{{ $item->id }}">{{ $item->code }} - {{ $item->name }}</option> @endforeach'+
                "</select>"+
            "</td>"+
            "<td>"+
                "<input type='number' min=1 name='quantity[]' placeholder='Masukkan jumlah' class='form-control' required>"+
            "</td>"+
            "<td>"+
                "<input type='number' class='form-control' placeholder='Masukkan Harga' name='price[]' min='1' step='any' required>"+
            "</td>"+
            "<td class='text-center'>"+
                '<button class="btn btn-danger" id="DeleteRow" type="button"><i class="bi bi-trash"></i></button>'+
            "</td>"+
        "</tr>";

        $('#newinput').append(newRowAdd);
    });

    $("body").on("click", "#DeleteRow", function () {
        $(this).parents("#row").remove();
    });


    // $(function () {
    //   $("#datatable").DataTable({
    //     "responsive": true, "lengthChange": true, "autoWidth": false
    //     // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    //   }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
    //   $('datatable').DataTable({
    //     "paging": true,
    //     "lengthChange": false,
    //     "searching": false,
    //     "ordering": true,
    //     "info": true,
    //     "autoWidth": false,
    //     "responsive": true,
    //   });
    // });
</script>

@endsection
