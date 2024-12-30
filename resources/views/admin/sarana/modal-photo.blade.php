<!-- Modal -->
<div class="modal fade" id="modal-photo" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Photo Fasilitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close2">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <input type="hidden" id="photo_uuid">
                    <div class="card-header">
                    </div>
                    <div class="card-body">
                        <div class="row mt-2">
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="photo" class="form-label">Masukan Photo</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <div class="col-sm-12">
                                                    <form action="javascript:;" id="form-photo" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <input type="file" class="form-control" name="photo" id="photo">
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <button type="button" class="btn btn-success" id="save-gambar">
                                                    <i class="ri-add-box-line"></i>&nbsp;<span>Upload</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <img src="/assets/img/user.png" alt="" id="photo-preview" style="width: 300px; height:300px" class="img-thumbnail">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h2>Photo Fasilitas</h2>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <div class="row mt-2" id="card"></div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="btn-action">
            </div>
        </div>
    </div>
</div>
