<div class="modal fade" id="modal-siswa" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:;" id="form-siswa">
                    @csrf
                    <div class="mb-3">
                        <label for="tahun_ajaran_uuid" class="form-label">Tahun Ajaran</label>
                        <select class="form-control" name="tahun_ajaran_uuid" id="tahun_ajaran_uuid">
                            <option selected disabled value="">Pilih Tahun Ajaran</option>
                            @foreach ($tahun_ajaran as $row)
                            <option value="{{ $row->uuid }}">{{ $row->tahun_awal }} - {{ $row->tahun_akhir }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Kelas</label>
                        <select class="form-control" name="kelas" id="kelas">
                            <option selected disabled value="">Pilih Kelas</option>
                            <option value="Kelas X">Kelas X</option>
                            <option value="Kelas XI">Kelas XI</option>
                            <option value="Kelas XII">Kelas XII</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="nama_kelas" class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" placeholder="Masukan Nama Kelas">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_lk" class="form-label">Jumlah Laki-Laki</label>
                        <input type="number" class="form-control" name="jumlah_lk" id="jumlah_lk" placeholder="Masukan Jumlah Laki-Laki">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_pr" class="form-label">Jumlah Perempuan</label>
                        <input type="number" class="form-control" name="jumlah_pr" id="jumlah_pr" placeholder="Masukan Jumlah Perempuan">
                    </div>
                </form>
            </div>
            <div class="modal-footer" id="btn-action">
                <button class="btn btn-primary" id="update-data">Update</button>
            </div>
        </div>
    </div>
</div>
