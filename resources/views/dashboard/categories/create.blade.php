<div class="modal fade" id="addCat">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('categories.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">Name<code>*</code></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Masukan nama category" id="name" name="name" required
                                    autofocus />
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="cost">Cost<code>*</code></label>
                                <input type="text" class="form-control rupiah @error('cost') is-invalid @enderror"
                                    placeholder="Masukan jumlah biaya" id="cost" name="cost" required />
                            </div>
                            @error('cost')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="benefit">Benefit<code>*</code></label>
                                <input type="text" class="form-control rupiah @error('benefit') is-invalid @enderror"
                                    placeholder="Masukan jumlah keuntungan" id="benefit" name="benefit" />
                            </div>
                            @error('benefit')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
