<!-- Modal -->
<div class="modal fade" id="modal-home" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:;" id="form-home">
                @csrf
                <div class="modal-body" style="height: 75vh; overflow-y: scroll">
                    <div class="mb-3">
                        <label for="welcome" class="form-label">Masukan Deskripsi</label>
                        <input id="welcome" type="hidden" name="welcome">
                        <trix-editor input="welcome" style="height: 300px; overflow-y: scroll"></trix-editor>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="/assets/img/avatar5.png" id="photo-kepsek" class="img-thumbnail" alt="...">
                            </div>
                            <div class="col-sm-6">
                                <label for="exampleInputFile">Upload Photo Kepala Sekolah</label>
                                <input type="file" name="photo" class="form-control" id="photo">
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
