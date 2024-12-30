<!-- Modal -->
<div class="modal fade" id="modal-profil" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="javascript:;" id="form-profil">
                @csrf
                <div class="modal-body" style="height: 75vh; overflow-y: scroll">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="visi" class="form-label">Masukan Visi</label>
                                <input id="visi" type="hidden" name="visi">
                                <trix-editor input="visi" style="height: 300px; overflow-y: scroll"></trix-editor>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="misi" class="form-label">Masukan Misi</label>
                                <input id="misi" type="hidden" name="misi">
                                <trix-editor input="misi" style="height: 300px; overflow-y: scroll"></trix-editor>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="/assets/img/avatar5.png" id="photo-misi" class="img-thumbnail" alt="...">
                            </div>
                            <div class="col-sm-6">
                                <label for="exampleInputFile">Upload Photo</label>
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
