<!-- Modal -->
<div class="modal fade" id="modal-tujuan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close2">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:;" id="form-tujuan">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="tujuan" class="form-label">Masukan Tujuan</label>
                                <input id="tujuan" type="hidden" name="tujuan">
                                <trix-editor input="tujuan" style="height: 60vh; overflow-y: scroll"></trix-editor>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="strategi" class="form-label">Masukan Strategi</label>
                                <input id="strategi" type="hidden" name="strategi">
                                <trix-editor input="strategi" style="height: 60vh; overflow-y: scroll"></trix-editor>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer" id="btn-action">
            </div>
        </div>
    </div>
</div>
