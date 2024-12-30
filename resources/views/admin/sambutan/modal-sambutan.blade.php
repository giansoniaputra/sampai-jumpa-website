<!-- Modal -->
<div class="modal fade" id="modal-sambutan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Masukan Sambutan dan Sejarah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:;" id="form-sambutan">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="sambutan" class="form-label">Masukan Sambutan</label>
                                <input id="sambutan" type="hidden" name="sambutan">
                                <trix-editor input="sambutan" style="height: 60vh; overflow-y: scroll"></trix-editor>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="sejarah" class="form-label">Masukan Sejarah</label>
                                <input id="sejarah" type="hidden" name="sejarah">
                                <trix-editor input="sejarah" style="height: 60vh; overflow-y: scroll"></trix-editor>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer" id="btn-action">
                <button class="btn btn-primary" id="update-data">Update</button>
            </div>
        </div>
    </div>
</div>
