<div class="modal fade" id="action{{ $item->id }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Action</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('documents.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="status">Action<code>*</code></label>
                                <select type="text" class="form-control @error('status') is-invalid @enderror"
                                    id="status" name="status" required>
                                    <option selected disabled>-- Pilih Status --</option>
                                    <option value="Submitted">Submitted</option>
                                    <option value="In Review">In Review</option>
                                    <option value="In Process">In Process</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                            @error('status')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12" id="file-wrapper" style="display:none;">
                            <div class="form-group">
                                <label for="exampleInputFile">File</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" accept=".pdf,.doc,.docx,.xls,.xlsx"
                                            class="custom-file-input @error('file') is-invalid @enderror" name="file"
                                            id="exampleInputFile">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            @error('file')
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('status');
        const fileWrapper = document.getElementById('file-wrapper');
        const fileInput = document.getElementById('exampleInputFile');

        function toggleFileField() {
            const val = statusSelect.value;
            if (val === 'Completed') {
                fileWrapper.style.display = 'block';
                fileInput.setAttribute('required', 'required');
            } else {
                fileWrapper.style.display = 'none';
                fileInput.removeAttribute('required');
                fileInput.value = ''; // reset file jika user ganti status
            }
        }

        // Saat pertama kali load (misal edit form / old value)
        toggleFileField();

        // Saat status berubah
        statusSelect.addEventListener('change', toggleFileField);
    });
</script>
