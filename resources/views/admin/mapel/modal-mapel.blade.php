<div class="modal fade" id="modal-mapel" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:;" id="form-mapel">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="kelas" id="kelas">
                        <label for="kelas-input" class="form-label">Kelas</label>
                        <input type="text" class="form-control" id="kelas-input" placeholder="Masukan Mata Pelajaran" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_mapel_uuid" class="form-label">Jenis Mata Pelajaran</label>
                        <select class="form-control" name="jenis_mapel_uuid" id="jenis_mapel_uuid">
                            <option selected disabled value="">Pilih Jenis Mata Pelajaran</option>
                            @foreach ($jenis_mapel as $row)
                            <option value="{{ $row->uuid }}">{{ $row->jenis_mapel }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="is_parent" class="form-label">Apakah Pelajaran Memiliki Sub Mata Pelajaran?</label>
                        <select class="form-control" name="is_parent" id="is_parent">
                            <option selected disabled value="">Pilih Salah Satu</option>
                            <option value="0">Tidak Memiliki</option>
                            <option value="1">Memiliki</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_mapel" class="form-label">Nama Mata Pelajaran</label>
                        <input type="text" class="form-control" name="nama_mapel" id="nama_mapel" placeholder="Masukan Mata Pelajaran">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_jam" class="form-label">Jumlah Jam</label>
                        <input type="text" class="form-control" name="jumlah_jam" id="jumlah_jam" placeholder="Masukan Jumlah Jam">
                        <small class="text-success fst-italic">*&nbsp;Boleh dikosongkan</small>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_jam_2" class="form-label">Jumlah Jam</label>
                        <input type="text" class="form-control" name="jumlah_jam_2" id="jumlah_jam_2" placeholder="Masukan Jumlah Jam">
                        <small class="text-success fst-italic">*&nbsp;Boleh dikosongkan</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer" id="btn-action">
            </div>
        </div>
    </div>
</div>
