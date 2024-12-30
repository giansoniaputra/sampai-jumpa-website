<div class="modal fade" id="modal-kepemimpinan" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:;" id="form-kepemimpinan">
                    @csrf
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukan Nama">
                    </div>
                    <div class="mb-3">
                        <label for="tahun_awal" class="form-label">Tahun Awal</label>
                        <input type="text" class="form-control" name="tahun_awal" id="tahun_awal" placeholder="Masukan Tahun Awal">
                    </div>
                    <div class="mb-3">
                        <label for="tahun_akhir" class="form-label">Tahun Akhir</label>
                        <input type="text" class="form-control" name="tahun_akhir" id="tahun_akhir" placeholder="Masukan Tahun Akhir">
                    </div>
                </form>
            </div>
            <div class="modal-footer" id="btn-action">
            </div>
        </div>
    </div>
</div>
