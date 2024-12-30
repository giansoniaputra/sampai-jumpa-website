<!-- Modal -->
<div class="modal fade" id="modal-fasilitas" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Daftar Fasilitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close2">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <input type="hidden" id="fasilitas_uuid">
                    <div class="card-header">
                        <form action="javascript:;" class="d-inline" id="form-fasilitas">
                            <input type="hidden" name="current_uuid_fasilitas" id="current_uuid_fasilitas">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="fasilitas" id="fasilitas" placeholder="Masukan Nama Fasilitas">
                                </div>
                                <div class="col-sm-4" id="btn-action-add-fasilitas"></div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <table id="table-fasilitas" class="table table-bordered table-hover dataTable dtr-inline">
                            <thead>
                                <th>No</th>
                                <th>Nama Fasilitas</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="btn-action">
            </div>
        </div>
    </div>
</div>
