<div class="modal fade" id="modal-sub-mapel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Sub Mata pelajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close2">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-header">
                    <form action="javascript:;" class="d-inline" id="form-sub-mapel">
                        <input type="hidden" name="current_uuid" id="current_uuid">
                        <input type="hidden" name="mapel_uuid" id="mapel_uuid">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="sub_mmapel">Sub Mata Pelajaran</label>
                            </div>
                            <div class="col-sm-2">
                                <label for="jumlah_jam_sub_2" id="sub-jam1">Sub Mata Pelajaran</label>
                            </div>
                            <div class="col-sm-2">
                                <label for="jumlah_jam_sub_2" id="sub-jam2">Sub Mata Pelajaran</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="sub_mapel" id="sub_mapel">&nbsp; &nbsp;
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="jumlah_jam" id="jumlah_jam_sub">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" name="jumlah_jam_2" id="jumlah_jam_sub_2">
                            </div>
                            <div class="col-sm-4" id="btn-action-add-sub-mapel"><button class="btn btn-primary" id="save-data-sub">Tambah</button></div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <table id="table-sub-mapel" class="table table-bordered table-hover dataTable dtr-inline">
                        <thead>
                            <th>No</th>
                            <th>Sub Mapel</th>
                            <th id="sub1">Jumlah Jam</th>
                            <th id="sub2">Jumlah Jam</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
