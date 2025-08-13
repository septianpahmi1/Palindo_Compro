<div class="modal fade" id="addSalary">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Pecatatan Gajih</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('salary.post') }}" method="POST" enctype="multipart/form-data">
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
                                <label for="employee_id">Pilih Karyawan<code>*</code></label>
                                <select type="text" class="form-control @error('employee_id') is-invalid @enderror"
                                    id="employee_id" name="employee_id" required>
                                    <option value="" selected disabled>-- Pilih Karyawan --</option>
                                    @foreach ($employee as $emp)
                                        <option value="{{ $emp->id }}">{{ $emp->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('employee_id')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="salary">Basic Salary<code>*</code></label>
                                <input type="text" class="form-control rupiah @error('salary') is-invalid @enderror"
                                    id="salary" name="salary" required />
                            </div>
                            @error('salary')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="allowance">Allowance<code>*</code></label>
                                <input type="text"
                                    class="form-control rupiah @error('allowance') is-invalid @enderror" id="allowance"
                                    name="allowance" required />
                            </div>
                            @error('allowance')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="deduction">Deduction</label>
                                <input type="text"
                                    class="form-control rupiah @error('deduction') is-invalid @enderror" id="deduction"
                                    name="deduction" required />
                            </div>
                            @error('deduction')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="total">Total<code>*</code></label>
                                <input type="text" class="form-control rupiah @error('total') is-invalid @enderror"
                                    id="total" name="total" readonly />
                            </div>
                            @error('total')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="date">Tanggal<code>*</code></label>
                                <input type="date" class="form-control @error('date') is-invalid @enderror"id="date"
                                    name="date" required />
                            </div>
                            @error('date')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="date_expired">Tanggal Kadaluwarsa<code>*</code></label>
                                <input type="date" class="form-control @error('date_expired') is-invalid @enderror"
                                    id="date_expired" name="date_expired" required />
                            </div>
                            @error('date_expired')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="description">Deskirpsi</label>
                                <textarea type="date" class="form-control @error('description') is-invalid @enderror" id="description"
                                    name="description"></textarea>
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
