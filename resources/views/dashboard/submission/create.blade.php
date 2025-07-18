<div class="modal fade" id="addSubmission">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pengajuan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('submission.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="exampleInputFile">File<code>*</code></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*"
                                            class="custom-file-input @error('image') is-invalid @enderror"
                                            name="image" id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            @error('image')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="title">Title<code>*</code></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    placeholder="Masukan judul" id="title" name="title" required autofocus />
                            </div>
                            @error('title')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="quantity">Quantity<code>*</code></label>
                                <input type="text" inputmode="numeric" pattern="[0-9]*"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                    class="form-control @error('quantity') is-invalid @enderror"
                                    placeholder="Masukan jumlah barang" id="quantity" name="quantity" required />
                            </div>
                            @error('quantity')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="price">Price<code>*</code></label>
                                <input type="text" class="form-control rupiah @error('price') is-invalid @enderror"
                                    placeholder="Masukan harga" id="price" name="price" />
                            </div>
                            @error('price')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="importance">Kepentingaan<code>*</code></label>
                                <select type="text" class="form-control @error('importance') is-invalid @enderror"
                                    id="importance" name="importance" required>
                                    <option value="" selected disabled>-- Pilih Kepentingan --</option>
                                    <option value="Not Important">Not Important</option>
                                    <option value="Important">Important</option>
                                    <option value="Very Important">Very Important</option>
                                </select>
                            </div>
                            @error('importance')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text" class="form-control @error('description') is-invalid @enderror" placeholder="Masukan deskripsi"
                                    id="description" name="description"></textarea>
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
