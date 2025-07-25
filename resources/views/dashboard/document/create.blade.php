<div class="modal fade" id="addDoc">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Dokumen</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('documents.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="name">Nama<code>*</code></label>
                                <input type="text" class="form-control" placeholder="Nama pembuat dokumen"
                                    id="name" name="name" required autofocus />
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="category_id">Project<code>*</code></label>
                                <select type="text" class="form-control" id="category_id" name="category_id"
                                    required>
                                    <option value="" selected disabled>-- Select Project --</option>
                                    @foreach ($category as $k)
                                        <option value="{{ $k->id }}">{{ $k->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="phone">Telepon<code>*</code></label>
                                <input type="text" class="form-control" inputmode="numeric" pattern="[0-9]*"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                    placeholder="Masukan nomor telepon" id="phone" name="phone" required />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="email">Email </label>
                                <input type="email" class="form-control" placeholder="Masukan alamat email"
                                    id="email" name="email" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="address">Alamat </label>
                                <input type="text" class="form-control" placeholder="Masukan alamat " id="address"
                                    name="address" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nation">Kewarganegaraan<code>*</code></label>
                                <input type="text" class="form-control" placeholder="Masukan kewarganegaraan"
                                    id="nation" name="nation" required />
                            </div>
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
