@extends('layouts.main')

@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Produk</a></li>
              <li class="breadcrumb-item active">Master</li>
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
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-product-add">
                    Tambah Produk
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="col-1 text-center">#</th>
                    <th class="col-1">Kode</th>
                    <th class="col-3">Nama</th>
                    <th class="col-2">Harga</th>
                    <th class="col-1">Stok</th>
                    <th class="col-2">Kategori</th>
                    <th class="col-2 text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->code }}</td>
                        <td>{{ $item->name }}</td>
                        <td>Rp {{ number_format($item->price, 2,",",".") }}</td>
                        <td class="text-center">{{ $item->stock_in }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-warning text-white" data-toggle="modal" data-target="#modal-product-edit{{ $item->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <button type="button" class="btn btn-danger text-white" data-toggle="modal" data-target="#modal-product-destroy{{ $item->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="modal-product-edit{{ $item->id }}">
                        <form method="POST" action="{{ route('product-update') }}">
                        @csrf
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h6 class="modal-title">Ubah Produk</h6>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                <div class="form-group">
                                    <label>Kode</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Kode" name="code" value="{{ $item->code }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Nama" name="name" value="{{ $item->name }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="category_id">
                                        <option value="1">Tidak Berkategori</option>
                                        @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" @if ($cat->id == $item->category_id) selected @endif>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Harga (Rp)</label>
                                    <input type="number" class="form-control" placeholder="Masukkan Harga" name="price" value="{{ $item->price }}" min="0" step="any" required>
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

                      <div class="modal fade" id="modal-product-destroy{{ $item->id }}">
                        <form method="POST" action="{{ route('product-destroy') }}">
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
                                    Apakah kamu yakin ingin menghapus <strong>{{ $item->name }}</strong> ?
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

    <div class="modal fade" id="modal-product-add">
        <form method="POST" action="{{ route('product-add') }}">
        @csrf
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title">Tambah Produk</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode</label>
                    <input type="text" class="form-control" placeholder="Masukkan Kode" name="code" required>
                </div>
                <div class="form-group">
                    <label>Nama Produk</label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama" name="name" required>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control" name="category_id">
                        <option value="0">Tidak Berkategori</option>
                        @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Harga (Rp)</label>
                    <input type="number" class="form-control" placeholder="Masukkan Harga" name="price" step="any" min="0" required>
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
