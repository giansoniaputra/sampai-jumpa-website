$(document).ready(function () {
    let limit = 8;
    let akhir
    let renderPage = (limit) => {
        $("#spinner").html(loader)
        $.ajax({
            data: { limit: limit },
            url: "/render-gallery",
            type: "GET",
            dataType: 'json',
            success: function (response) {
                let data = response.data;
                let card = $("#card")
                akhir = response.max
                if (limit == 8) {
                    $("#btn-previous").attr('disabled', 'true')
                } else {
                    $("#btn-previous").removeAttr('disabled')
                }
                if (limit + 8 == akhir || akhir <= 8) {
                    $("#btn-next").attr('disabled', 'true')
                } else {
                    $("#btn-next").removeAttr('disabled')
                }
                if (data.length == 0) {
                    let element = `
                    <div class="alert alert-info" role="alert">
                        Belum ada gambar. Silahkan Masukan Gambar
                    </div>
                    `
                    card.html(element)
                    $("#spinner").html("")
                } else {
                    let element = data.map((gallery) => {
                        return `
                        <div class="col-sm-12 col-lg-3 col-md-4">
                            <div class="card" style="width: 12rem;">
                                <img src="/storage/${gallery.photo}" class="card-img-top" alt="Gallery">
                                <div class="card-body">
                                    <button class="btn btn-danger badge hapus-gambar" data-uuid="${gallery.uuid}">Hapus</button>
                                </div>
                            </div>
                        </div>
                        `
                    })
                    card.html(element)
                    $("#spinner").html("")
                }
            }
        });
    }
    renderPage(limit);

    $("#btn-next").on("click", function () {
        limit += 8;
        renderPage(limit);
    })
    $("#btn-previous").on("click", function () {
        limit -= 8;
        renderPage(limit);
    })

    $("#save-gambar").on("click", function () {
        if ($("#photo").val() == "") {
            Swal.fire("Warning!", "Silahkan Pilih Gambar!", "warning");
        } else {
            $("#spinner").html(loader)
            let button = $(this)
            $(button).attr("disabled", "true");
            let photo = document.querySelector("input[name='photo']")

            let formData = new FormData();
            if (photo.value != '') {
                formData.append('photo', photo.files[0]);
            }

            // Mendapatkan data inputan lainnya dari hasil serialize
            let serializedData = $("form[id='form-gallery']").serialize();// Ganti #form dengan ID formulir Anda
            let otherData = serializedData.split("&");

            otherData.forEach(function (item) {
                let keyValue = item.split("=");
                formData.append(keyValue[0], decodeURIComponent(keyValue[1]));
            });

            $.ajax({
                data: formData,
                url: "/store-photo-gallery",
                type: "POST",
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (response) {
                    $(button).removeAttr("disabled");
                    $("#photo").val("")
                    document.querySelector("#photo-preview").src = "/assets/img/user.png"
                    renderPage(limit)
                }
            });

        }
    })

    //HAPUS DATA
    $("#card").on("click", ".hapus-gambar", function () {
        let uuid = $(this).data("uuid");
        Swal.fire({
            title: "Apakah Kamu Yakin?",
            text: "Kamu akan menghapus gambar ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Hapus!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    data: {
                        _method: "DELETE",
                        _token: csrfToken,
                    },
                    url: "/destroy-gallery/" + uuid,
                    type: "POST",
                    dataType: "json",
                    success: function (response) {
                        renderPage(limit);
                    },
                });
            }
        });
    });

    let modal = $("#modal-cropper")
    let image = document.getElementById('image');
    let cropper, reader, file
    $("body").on("change", "#photo", function (e) {
        let files = e.target.files;
        let done = function (url) {
            image.src = url;
            modal.modal("show");
        }
        if (files && files.length > 0) {
            file = files[0];
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                }
                reader.readAsDataURL(file)
            }
        }

    })

    modal.on('shown.bs.modal', function () {
        cropper = new Cropper(image, {
            aspectRatio: 3 / 2,
            preview: '.preview'
        })
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    })

    $("#modal-cropper").on("click", ".crop_photo", function () {
        canvas = cropper.getCroppedCanvas({
            width: 1080,
            height: 720,
        })
        canvas.toBlob(function (blob) {
            let image = document.querySelector("#photo");
            const imgPre = document.querySelector("#photo-preview");
            // const imgPre = document.querySelector("#");
            const oFReader = new FileReader();
            oFReader.readAsDataURL(blob);
            oFReader.onload = function (oFREvent) {
                var file = dataURLtoFile(oFREvent.target.result, "photo-gallery.png");
                let container = new DataTransfer();
                container.items.add(file);
                image.files = container.files;
                var newfile = image.files[0];
                imgPre.src = oFREvent.target.result
                modal.modal("hide")
            }
        })
    })

    function dataURLtoFile(dataurl, filename) {

        var arr = dataurl.split(','),
            mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]),
            n = bstr.length,
            u8arr = new Uint8Array(n);

        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }

        return new File([u8arr], filename, { type: mime });
    }
});
