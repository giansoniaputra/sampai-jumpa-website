<div class="modal fade" id="modal-jenis-mapel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:;" id="form-jenis-mapel">
                    @csrf
                    <div class="mb-3">
                        <label for="jenis_mapel" class="form-label">Jenis Mapel</label>
                        <input type="text" class="form-control" name="jenis_mapel" id="jenis_mapel" placeholder="Masukan Jenis Mapel">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_jam" class="form-label">Jumlah Jam</label>
                        <input type="number" class="form-control" name="jumlah_jam" id="jumlah_jam" placeholder="Masukan Jumlah Jam">
                        <small class="text-success fst-italic">*&nbsp;Boleh dikosongkan</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer" id="btn-action">
                <button class="btn btn-primary" id="update-data">Update</button>
            </div>
        </div>
    </div>
</div>
