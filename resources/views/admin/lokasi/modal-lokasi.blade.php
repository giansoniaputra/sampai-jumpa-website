<!-- Modal -->
<div class="modal fade" id="modal-lokasi" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title">Update Lokasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="javascript:;" id="form-lokasi">
                    @csrf
                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Masukan Lokasi</label>
                        <textarea class="form-control" name="lokasi" id="lokasi" rows="5"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer" id="btn-action">
                <button class="btn btn-primary" id="update-data">Update</button>
            </div>
        </div>
    </div>
</div>
