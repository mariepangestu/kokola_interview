@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">🔍 Pencarian String</h5>
                    </div>
                    <div class="card-body">
                        <form id="searchForm">
                            <div class="form-group">
                                <label for="keyword">Masukkan kata yang ingin dicari:</label>
                                <input type="text" name="keyword" id="keyword" class="form-control"
                                    placeholder="Contoh: KOLA" required>
                            </div>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-search mr-1"></i> Cari
                            </button>
                        </form>

                        <div id="result" class="mt-4 d-none">
                            <h6>Hasil:</h6>
                            <div class="alert alert-info mb-0" id="resultText"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#searchForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('string_search.process') }}",
                method: "POST",
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(res) {
                    console.log("Sukses:", res);
                    if (res.result.length > 0) {
                        $('#resultText').html("Index ditemukan pada posisi: <strong>" + res.result.join(
                            ", ") + "</strong>");
                    } else {
                        $('#resultText').html("Kata tidak ditemukan dalam kalimat.");
                    }
                    $('#result').removeClass('d-none');

                },
                error: function() {
                    $('#resultText').html("Terjadi kesalahan.");
                    $('#result').removeClass('d-none');
                }
            });
        });
    </script>
@endpush
