<div class="modal fade" id="addPurchase">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Faktur Pembelian</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('purchase.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="supplier_id">Supplier<code>*</code></label>
                                <select type="text"
                                    class="form-control select2 @error('supplier_id') is-invalid @enderror"
                                    id="supplier_id" name="supplier_id" style="width: 100%;" required>
                                    <option value="" selected disabled>-- Select supplier--</option>
                                    @foreach ($customer as $cus)
                                        <option value="{{ $cus->id }}">{{ $cus->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('supplier_id')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="category_id">Category<code>*</code></label>
                                <select type="text"
                                    class="form-control select2 @error('category_id') is-invalid @enderror"
                                    id="category_id" name="category_id" style="width: 100%;" required>
                                    <option value="" selected disabled>-- Select Category--</option>
                                    @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
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
                                <label for="price">Price<code>*</code></label>
                                <input type="text" class="form-control rupiah @error('price') is-invalid @enderror"
                                    id="price" name="price" required />
                            </div>
                            @error('price')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="quantity">Quantity<code>*</code></label>
                                <input type="text" class="form-control @error('quantity') is-invalid @enderror"
                                    inputmode="numeric" pattern="[0-9]*" maxlength="4" value="1"
                                    oninput="this.value=this.value.replace(/[^0-9]/g,'');" id="quantity"
                                    name="quantity" required />
                            </div>
                            @error('quantity')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="discount">Discount</label>
                                <input type="text"
                                    class="form-control rupiah @error('discount') is-invalid @enderror" value="0"
                                    id="discount" name="discount" />
                            </div>
                            @error('discount')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="total">Total<code>*</code></label>
                                <input type="text" class="form-control rupiah @error('total') is-invalid @enderror"
                                    id="total" name="total" required readonly />
                            </div>
                            @error('total')
                                <div class="invalid-feedback d-block mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="ket">Description</label>
                                <input type="text" class="form-control  @error('ket') is-invalid @enderror"
                                    id="ket" name="ket" />
                            </div>
                            @error('ket')
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
