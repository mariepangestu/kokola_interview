@extends('layouts.app')

<!-- Page Heading -->
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h5 class="m-0 font-weight-bold text-primary">Plant Product Data</h5>
        <div>
            <button type="button" class="btn btn-sm btn-primary" id="showAddForm">
                <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Add Data
            </button>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert" id="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="data-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            {{-- Kolom No dihilangkan jika tidak digunakan --}}
                            <th class="text-center">Plant</th>
                            <th class="text-center">Product</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Semua data di muat pada datatable -->
                        @foreach ($data as $row)
                            <tr>
                                <td>{{ $row->plant }}</td>
                                <td>{{ $row->products }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Modal Upload Excel -->
    <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Upload File Excel</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="file" accept=".xlsx, .xls" required class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="addFormContainer" class="card shadow mb-4 mt-3 d-none">
        <div class="card-body">
            <h5 class="mb-3">Form Tambah Plant Product</h5>

            <div id="alert-msg"></div>

            <form id="addForm">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <label for="id_plant" class="form-label">Plant</label>
                        <select name="id_plant" class="form-select" required>
                            <option value="">-- Pilih Plant --</option>
                            @foreach ($plants as $plant)
                                <option value="{{ $plant->id }}">{{ $plant->kode }} - {{ $plant->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="id_product" class="form-label">Product</label>
                        <select name="id_product" class="form-select" required>
                            <option value="">-- Pilih Produk --</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-success w-100">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#showAddForm').on('click', function() {
            $('#addFormContainer').removeClass('d-none');
            $('html, body').animate({
                scrollTop: $('#addFormContainer').offset().top
            }, 500);
        });

        $('#addForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('plant_product.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    $('#alert-msg').html(`<div class="alert alert-success">${response.message}</div>`);
                    $('#addForm')[0].reset();
                    setTimeout(() => location.reload(), 1000);
                },
                error: function(xhr) {
                    let msg = 'Terjadi kesalahan.';
                    if (xhr.status === 409) {
                        msg = xhr.responseJSON.message;
                    } else if (xhr.responseJSON?.errors) {
                        msg = Object.values(xhr.responseJSON.errors).flat().join('<br>');
                    }
                    $('#alert-msg').html(`<div class="alert alert-danger">${msg}</div>`);
                }
            });
        });
    </script>
@endpush
