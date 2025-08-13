<div class="modal fade" id="addEstimation">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Akun Perkiraan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('estimation.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="no_account">No Account<code>*</code></label>
                                <input type="text" inputmode="numeric" pattern="[0-9]*"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                    class="form-control @error('no_account') is-invalid @enderror"
                                    placeholder="Masukan nomor akun" id="no_account" name="no_account" required
                                    autofocus />
                            </div>
                            @error('no_account')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="title">Title<code>*</code></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    placeholder="Masukan title" id="title" name="title" required />
                            </div>
                            @error('title')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="balance">Saldo<code>*</code></label>
                                <input type="text" class="form-control rupiah @error('balance') is-invalid @enderror"
                                    placeholder="Masukan saldo" id="balance" name="balance" />
                            </div>
                            @error('balance')
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
