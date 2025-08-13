<div class="modal fade" id="addEmployee">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Karyawan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('employee.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="exampleInputFile">Employee Image<code>*</code></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" accept="image/*"
                                            class="custom-file-input @error('image') is-invalid @enderror"
                                            name="image" id="exampleInputFile" required>
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
                                <label for="name">Name<code>*</code></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Masukan nama karyawan" id="name" name="name" required
                                    autofocus />
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nik">NIK (Nomor Induk Karyawan)<code>*</code></label>
                                <input type="text" inputmode="numeric" pattern="[0-9]*"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                    class="form-control @error('nik') is-invalid @enderror"
                                    placeholder="Masukan NIK Karyawan" id="nik" name="nik" required />
                            </div>
                            @error('nik')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="position">Position<code>*</code></label>
                                <input type="text" class="form-control @error('position') is-invalid @enderror"
                                    placeholder="Masukan posisi/ jabatan" id="position" name="position" required />
                            </div>
                            @error('position')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="join_date">Tanggal Bergabung<code>*</code></label>
                                <input type="date"
                                    class="form-control @error('join_date') is-invalid @enderror"id="join_date"
                                    name="join_date" required />
                            </div>
                            @error('join_date')
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
