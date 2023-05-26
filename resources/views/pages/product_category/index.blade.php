@extends('layouts.main')

@section('contents')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kategori</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Produk</a></li>
              <li class="breadcrumb-item active">Kategori</li>
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
                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-product-category-add">
                    Tambah Kategori
                </button>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="datatable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th class="col-1 text-center">#</th>
                    <th class="col-9">Nama</th>
                    <th class="col-2 text-center">Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td class="text-center">
                            <button type="button" class="btn btn-warning text-white" data-toggle="modal" data-target="#modal-product-category-edit{{ $item->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>

                            <button type="button" class="btn btn-danger text-white" data-toggle="modal" data-target="#modal-product-category-destroy{{ $item->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="modal-product-category-edit{{ $item->id }}">
                        <form method="POST" action="{{ route('product-category-update') }}">
                        @csrf
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h6 class="modal-title">Ubah Kategori</h6>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <label>Nama Kategori</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Nama" name="name" value="{{ $item->name }}" required>
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

                      <div class="modal fade" id="modal-product-category-destroy{{ $item->id }}">
                        <form method="POST" action="{{ route('product-category-destroy') }}">
                        @csrf
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h6 class="modal-title">Hapus Kategori</h6>
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

    <div class="modal fade" id="modal-product-category-add">
        <form method="POST" action="{{ route('product-category-add') }}">
        @csrf
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h6 class="modal-title">Tambah Kategori</h6>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" class="form-control" placeholder="Masukkan Nama" name="name" required>
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
