@extends('layouts.main')

@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Stock In</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
              <li class="breadcrumb-item active">Stock In</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a class="btn btn-default mb-2" href="{{ route('transaction-purchasing-create') }}">
                    Tambah Pembelian
                </a>

                <form class="float-right" action="{{ route('transaction-purchasing') }}">
                    <div class="form-group row">
                        <div class="col-lg-5 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        From :
                                    </span>
                                </div>
                                <input type="date" class="form-control" name="from" id="from"
                                @if (request()->get('from'))
                                    value="{{ request()->get('from') }}"
                                @endif>
                            </div>
                        </div>

                        <div class="col-lg-5 mb-2">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        To :
                                    </span>
                                </div>
                                <input type="date" class="form-control" name="to" id="to"
                                @if (request()->get('to'))
                                    value="{{ request()->get('to') }}"
                                @endif>
                            </div>
                        </div>

                        <div class="col-lg-1 mb-2">
                            <button class="btn btn-default"><i class="bi bi-search"></i></button>
                        </div>

                        <div class="col-lg-1 mb-2">
                            <button type="reset" class="btn btn-default"><i class="bi bi-arrow-counterclockwise"></i></button>
                        </div>
                    </div>
                </form>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="col-1 text-center">#</th>
                    <th class="col-2">Purchasing Date</th>
                    <th class="col-4">Kode</th>
                    <th class="col-3">Total (Rp)</th>
                    <th class="col-2 text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($purchases as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">
                            {{-- {{ date('d F Y', strtotime($item->reimbesement_date)) }} --}}
                            {{ $item->purchase_date->isoFormat("D MMMM Y")}}
                        </td>
                        <td>{{ $item->code }}</td>
                        <td>Rp {{ number_format($item->details_total(), 2,",",".") }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-primary text-white" data-toggle="modal" data-target="#modal-purchasing-show{{ $item->id }}">
                                <i class="bi bi-eye"></i>
                            </button>

                            <a class="btn btn-warning text-white" href="/transaction/purchasing/{{ $item->id }}/edit">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <button type="button" class="btn btn-danger text-white" data-toggle="modal" data-target="#modal-purchasing-destroy{{ $item->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="modal-purchasing-show{{ $item->id }}">
                        <div class="modal-dialog modal-xl">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h6 class="modal-title">Detail Pembelian - {{ $item->code }}</h6>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-4">
                                        <strong>Nama Barang</strong>
                                    </div>
                                    <div class="col-2">
                                        <strong>Jumlah</strong>
                                    </div>
                                    <div class="col-3">
                                        <strong>Harga Beli (Rp)</strong>
                                    </div>
                                    <div class="col-3">
                                        <strong>Total (Rp)</strong>
                                    </div>

                                    @foreach ($item->details as $detail)
                                        <div class="col-4">
                                            {{ $detail->products->name }}
                                        </div>
                                        <div class="col-2">
                                            {{ $detail->quantity }}
                                        </div>
                                        <div class="col-3">
                                            Rp {{ number_format($detail->price, 2,",",".") }}
                                        </div>
                                        <div class="col-3">
                                            Rp {{ number_format($detail->quantity * $detail->price, 2,",",".") }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary float-right" data-dismiss="modal">Kembali</button>
                            </div>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                      </div>

                      <div class="modal fade" id="modal-purchasing-destroy{{ $item->id }}">
                        <form method="POST" action="{{ route('transaction-purchasing-destroy') }}">
                        @csrf
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h6 class="modal-title">Hapus Produk</h6>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    Apakah kamu yakin ingin menghapus <strong>{{ $item->code }}</strong> ?
                                  </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                              <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                          </div>
                          <!-- /.modal-content -->
                        </div>
                        </form>
                        <!-- /.modal-dialog -->
                      </div>

                    @endforeach
                    </tbody>
                  </tfoot>
                </table>
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
@endsection

@section('add-script')
<script>
    $(function () {
      $("#datatable").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#datatable_wrapper .col-md-6:eq(0)');
      $('datatable').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
</script>
@endsection
