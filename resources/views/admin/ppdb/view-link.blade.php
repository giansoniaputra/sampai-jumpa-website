<div class="row mt-2">
    <div class="col-sm-6">
        <div class="card text-start">
            <div class="card-header">
                <h2>Link PPDB</h2>
            </div>
            <div class="card-body">
                <form action="javacsript:;" id="form-ppdb">
                    @csrf
                    <div class="row">
                        <div class="col-sm-8">
                            <label for="ppdb" class="form-label">Masukan Link PPDB</label>
                        </div>
                        <div class="col-sm-8">
                            <div class="mb-3">
                                <input type="text" value="{{ ($sosmed == true) ? $sosmed->ppdb : '' }}" name="ppdb" id="ppdb" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-primary" id="update-ppdb">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card text-start">
            <div class="card-header">
                <h2>Link Daftar Ulang</h2>

            </div>
            <div class="card-body">
                <form action="javacsript:;" id="form-ulang">
                    @csrf
                    <div class="row">
                        <div class="col-sm-8">
                            <label for="ulang" class="form-label">Masukan Link Pendaftaran Ulang</label>
                        </div>
                        <div class="col-sm-8">
                            <div class="mb-3">
                                <input type="text" value="{{ ($sosmed == true) ? $sosmed->ulang : '' }}" name="ulang" id="ulang" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-primary" id="update-ulang">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
<div class="row mt-2">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Banner PPDB</h4>
            </div>
            <div class="card-body" id="card-sampul">
                @if (!isset($sampul))
                <div class="alert alert-primary" role="alert">
                    <span>Belum Ada Sampul</span>
                </div>
                @else
                <img class="img-fluid" src="/storage/{{ $sampul }}">
                @endif
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-8">
                        <label for="link_ppdb" class="form-label">Upload Sampul</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <form action="javascript:;" id="form-sampul">
                            @csrf
                            <div class="mb-3">
                                <input type="file" class="form-control" name="link_ppdb" id="link_ppdb" required>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-primary" id="update-sampul">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-2">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4>Banner PPDB Belakang</h4>
            </div>
            <div class="card-body" id="card-sampul">
                @if (!isset($sampul_bawah))
                <div class="alert alert-primary" role="alert">
                    <span>Belum Ada Sampul</span>
                </div>
                @else
                <img class="img-fluid" src="/storage/{{ $sampul_bawah }}">
                @endif
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-sm-8">
                        <label for="link_ppdb_bawah" class="form-label">Upload Sampul Belakang</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8">
                        <form action="javascript:;" id="form-sampul-bawah">
                            @csrf
                            <div class="mb-3">
                                <input type="file" class="form-control" name="link_ppdb_bawah" id="link_ppdb_bawah" required>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-4">
                        <button class="btn btn-primary" id="update-sampul-bawah">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
