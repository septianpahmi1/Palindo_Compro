<div class="modal fade" id="addTask">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Tugas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('task.post') }}" method="POST" enctype="multipart/form-data">
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
                                <label for="start_at">Start at<code>*</code></label>
                                <input type="date"
                                    class="form-control @error('start_at') is-invalid @enderror"id="start_at"
                                    name="start_at" required />
                            </div>
                            @error('start_at')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="end_at">End at<code>*</code></label>
                                <input type="date"
                                    class="form-control @error('end_at') is-invalid @enderror"id="end_at" name="end_at"
                                    required />
                            </div>
                            @error('end_at')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="status">Status<code>*</code></label>
                                <select type="text" class="form-control @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                    <option value="" selected disabled>-- Pilih Status --</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Not Completed">Not Completed</option>
                                </select>
                            </div>
                            @error('status')
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
