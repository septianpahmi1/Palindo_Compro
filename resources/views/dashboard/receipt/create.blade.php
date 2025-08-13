<div class="modal fade" id="addReceipt">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pembayaran</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('receipt.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="estimation_id">Estimated Account<code>*</code></label>
                                <select type="text"
                                    class="form-control select2 @error('estimation_id') is-invalid @enderror"
                                    id="estimation_id" name="estimation_id" style="width: 100%;" required>
                                    <option value="" selected disabled>-- Select Estimated Account--</option>
                                    @foreach ($estimation as $est)
                                        <option value="{{ $est->id }}">{{ $est->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('estimation_id')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="total">Total<code>*</code></label>
                                <input type="text" class="form-control rupiah @error('total') is-invalid @enderror"
                                    placeholder="Masukan total" id="total" name="total" />
                            </div>
                            @error('total')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="date">Date<code>*</code></label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror"
                                    id="date" name="date" required />
                            </div>
                            @error('date')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror"
                                    id="description" name="description" />
                            </div>
                            @error('description')
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
