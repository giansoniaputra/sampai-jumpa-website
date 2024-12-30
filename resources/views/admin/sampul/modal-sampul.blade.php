<!-- Modal -->
<div class="modal fade" id="modal-sampul" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Update Sampul</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:;" id="form-sampul">
                    @csrf
                    <div class="mb-3">
                        <label for="jenis-sampul" class="form-label">Jenis Sampul</label>
                        <select class="form-control" id="jenis-sampul">
                            <option selected disabled value="">Pilih Jenis Sampul</option>
                            <option value="home">Home</option>
                            <option value="profil">Profil</option>
                            <option value="guru">Guru</option>
                            <option value="kurikulum">Kurikulum</option>
                            <option value="siswa">Siswa</option>
                            <option value="prestasi">Prestasi</option>
                            <option value="ppdb">PPDB</option>
                            <option value="berita">Berita</option>
                            <option value="sarana">Sarana</option>
                            <option value="humas">Humas</option>
                            <option value="layanan">layanan</option>
                            <option value="gallery">gallery</option>
                            <option value="integrity">Zona Integritas</option>
                        </select>
                    </div>
                    <div id="input-photo"></div>
                </form>
            </div>
            <div class="modal-footer" id="btn-action">
                <button class="btn btn-primary" id="update-data">Update</button>
            </div>
        </div>
    </div>
</div>
