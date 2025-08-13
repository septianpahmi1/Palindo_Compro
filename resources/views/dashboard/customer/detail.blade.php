<div class="modal fade" id="detailCustomer{{ $item->id }}">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Customer Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">Job Position</dt>
                                <dd class="col-sm-8">{{ $item->position }}</dd>
                                <dt class="col-sm-4">Name</dt>
                                <dd class="col-sm-8">{{ $item->name }}</dd>
                                <dt class="col-sm-4">Email</dt>
                                <dd class="col-sm-8">{{ $item->email }}</dd>
                                <dt class="col-sm-4">Phone</dt>
                                <dd class="col-sm-8">{{ $item->phone }}</dd>
                                <dt class="col-sm-4">Address</dt>
                                <dd class="col-sm-8">{{ $item->address }}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6">
                            <dl class="row">
                                <dt class="col-sm-4">Phone Business</dt>
                                <dd class="col-sm-8">{{ optional($item)->phone_business ?? '-' }}</dd>
                                <dt class="col-sm-4">Whatsapp</dt>
                                <dd class="col-sm-8">{{ optional($item)->whatsapp ?? '-' }}</dd>
                                <dt class="col-sm-4">Website</dt>
                                <dd class="col-sm-8">{{ optional($item)->website ?? '-' }}</dd>
                                <dt class="col-sm-4">Description</dt>
                                <dd class="col-sm-8">{{ optional($item)->description ?? '-' }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
