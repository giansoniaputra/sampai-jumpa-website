<div class="modal fade" id="modal-prestasi" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:;" id="form-prestasi">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Jenis Prestasi</label>
                        <select class="form-control" name="jenis_prestasi" id="jenis_prestasi">
                            <option selected disabled value="">Pilih Salah Satu</option>
                            <option value="Lembaga">Lembaga</option>
                            <option value="Pendidik & Kependidikan">Pendidik & Kependidikan</option>
                            <option value="Akademik Peserta Didik">Akademik Peserta Didik</option>
                            <option value="Non Akademik Peserta Didik">Non Akademik Peserta Didik</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="even" class="form-label">Even</label>
                        <input type="text" class="form-control" name="even" id="even" placeholder="Masukan Nama Even">
                    </div>
                    <div class="mb-3">
                        <label for="penyelenggara" class="form-label">Penyelenggara</label>
                        <input type="text" class="form-control" name="penyelenggara" id="penyelenggara" placeholder="Masukan Penyelenggara">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal">
                    </div>
                    <div class="mb-3">
                        <label for="prestasi" class="form-label">Prestasi</label>
                        <input type="text" class="form-control" name="prestasi" id="prestasi" placeholder="Masukan Prestasi">
                    </div>
                </form>
            </div>
            <div class="modal-footer" id="btn-action">
            </div>
        </div>
    </div>
</div>
