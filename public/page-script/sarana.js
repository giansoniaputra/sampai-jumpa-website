$(document).ready(function () {
    let renderSarana = () => {
        $("#spinner").html(loader)
        let form = $("#form-sarana")
        $.ajax({
            url: "/render-form-sarana",
            type: "GET",
            dataType: 'json',
            success: function (response) {
                let data = response.data
                let element = `
                    <input type="hidden" value="${csrfToken}" name="_token">
                     ${(response.data) ? `<input type="hidden" name="current_uuid" value="${data.uuid}">` : ''}
                    <div class="mb-3">
                        <label for="status" class="form-label">Status Tanah dan Bangunan</label>
                        <input type="text" class="form-control" name="status" id="status" placeholder="Masukan Status Tanah dan Bangunan" value="${(response.data) ? data.status : ''}">
                    </div>
                    <div class="mb-3">
                        <label for="luas" class="form-label">Luas Tanah</label>
                        <input type="text" class="form-control" name="luas" id="luas" placeholder="Masukan Luas Tanah" value="${(response.data) ? data.luas : ''}">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Masukan ALamat">${(response.data) ? data.alamat : ''}</textarea>
                    </div>
                `
                form.html(element)
                $("#spinner").html("")
            }
        });
    }
    let renderImage = (photo_uuid) => {
        $("#spinner").html(loader)
        $.ajax({
            url: "/render-photo-fasilitas/" + photo_uuid
            , type: "GET"
            , dataType: 'json'
            , success: function (response) {
                let data = response.data;
                let card = $("#card")
                console.log(data.photo);
                if (data.photo == null) {
                    let element = `
                    <div class="alert alert-info" role="alert">
                        Belum ada gambar. Silahkan Masukan Gambar
                    </div>
                    `
                    card.html(element)
                    $("#spinner").html("")
                } else {
                    let element = `
                        <div class="col-sm-12">
                            <div class="card">
                                <img src="/storage/${data.photo}" class="card-img-top" alt="Gallery">
                            </div>
                        </div>
                        `
                    card.html(element)
                    $("#spinner").html("")
                }
            }
        });
    }
    renderSarana()
    let table = $("#table-sarana").DataTable({
        responsive: true,
        responsive: !0,
        autoWidth: false,
        serverSide: true,
        ajax: {
            url: "/dataTablesSarana",
        },
        columns: [
            {
                data: "status",
            },
            {
                data: "luas",
            },
            {
                data: "alamat",
            },
            {
                data: null,
                render: function (data) {
                    return `<button class="btn btn-info badge" id="view-fasilitas" data-fasilitas_uuid="${data.fasilitas_uuid}">Lihat Fasilitas</button>`
                }
            },
        ],
        columnDefs: [
            {
                targets: [0, 1, 2, 3], // index kolom atau sel yang ingin diatur
                className: "text-center", // kelas CSS untuk memposisikan isi ke tengah
            },
            {
                searchable: false,
                orderable: false,
                targets: 0, // Kolom nomor, dimulai dari 0
            },
        ],
    });
    let table2 = $("#table-fasilitas").DataTable({
        responsive: true,
        responsive: !0,
        autoWidth: false,
        serverSide: true,
        ajax: {
            url: "/dataTablesFasilitas",
            type: "GET",
            data: function (a) {
                a.fasilitas_uuid = $("#current_uuid_fasilitas").val()
            }
        },
        columns: [
            {
                data: null,
                orderable: false,
                render: function (data, type, row, meta) {
                    var pageInfo = $("#table-fasilitas").DataTable().page.info();
                    var index = meta.row + pageInfo.start + 1;
                    return index;
                },
            },
            {
                data: "fasilitas",
            },
            {
                data: 'action',
            },
        ],
        columnDefs: [
            {
                targets: [0, 1, 2], // index kolom atau sel yang ingin diatur
                className: "text-center", // kelas CSS untuk memposisikan isi ke tengah
            },
            {
                searchable: false,
                orderable: false,
                targets: 0, // Kolom nomor, dimulai dari 0
            },
        ],
    });

    $("#btn-add-data").on("click", function () {
        $("#modal-sarana").modal("show")
    })
    $("#update-data").on("click", function () {
        $("#spinner").html(loader)
        let button = $(this)
        $(button).attr("disabled", "true");
        let formdata = $('form[id="form-sarana"]').serialize();
        $.ajax({
            data: formdata,
            url: "/update-sarana",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                $(button).removeAttr("disabled");
                renderSarana()
                $("#spinner").html("")
                table.ajax.reload()
                $("#modal-sarana").modal("hide")
                Swal.fire("Success!", response.success, "success");
            },
            error: function (xhr, status, error) {
                if (xhr.status == 400) {
                    $(button).removeAttr("disabled");
                    $("#spinner").html("")
                    let errors = xhr.responseJSON.errors
                    displayErrors(errors)
                }
            }
        });
    })
    $("#btn-close").on("click", function () {
        renderSarana()
    })

    $("#table-sarana").on("click", "#view-fasilitas", function () {
        $("#current_uuid_fasilitas").val($(this).data("fasilitas_uuid"))
        table2.ajax.reload()
        $("#modal-fasilitas").modal("show");
        $("#btn-action-add-fasilitas").html(`<button class="btn btn-primary" id="add-fasilitas">Tambah Fasilitas</button>`)
    })

    $("#modal-fasilitas").on("click", "#add-fasilitas", function () {
        if ($("#fasilitas").val() == "") {
            Swal.fire("Warning!", "Nama Fasilitas Tidak Boleh Kosong!", "warning");
        } else {
            let button = $(this)
            $(button).attr("disabled", "true");
            $("#spinner").html(loader)
            let formdata = $('form[id="form-fasilitas"]').serialize();
            $.ajax({
                data: formdata,
                url: "/add-fasilitas",
                type: "POST",
                dataType: 'json',
                success: function (response) {
                    $(button).removeAttr("disabled");
                    $("#spinner").html("")
                    $("#fasilitas").val("")
                    table2.ajax.reload()
                }
            });
        }
    })

    $("#table-fasilitas").on("click", ".edit-button", function () {
        let uuid = $(this).attr("data-uuid");
        let fasilitas = $(this).attr("data-fasilitas");
        $("#btn-action-add-fasilitas").html(`
        <button class="btn btn-warning text-white" data-uuid="${uuid}" id="update-fasilitas">Ubah</button>
        <button class="btn btn-danger" id="batal-fasilitas">Batal</button>
        `)
        $("#fasilitas").val(fasilitas)
    })

    $("#modal-fasilitas").on("click", "#batal-fasilitas", function () {
        $("#btn-action-add-fasilitas").html(`<button class="btn btn-primary" id="add-fasilitas">Tambah Fasilitas</button>`)
        $("#fasilitas").val("")
    })

    $("#modal-fasilitas").on("click", "#update-fasilitas", function () {
        if ($("#fasilitas").val() == "") {
            Swal.fire("Warning!", "Nama Fasilitas Tidak Boleh Kosong!", "warning");
        } else {
            let uuid = $(this).data("uuid");
            let button = $(this)
            $(button).attr("disabled", "true");
            $("#spinner").html(loader)
            let formdata = $('form[id="form-fasilitas"]').serialize();
            $.ajax({
                data: formdata + "&_method=PUT",
                url: "/update-fasilitas/" + uuid,
                type: "POST",
                dataType: 'json',
                success: function (response) {
                    $(button).removeAttr("disabled");
                    $("#spinner").html("")
                    $("#fasilitas").val("")
                    $("#btn-action-add-fasilitas").html(`<button class="btn btn-primary" id="add-fasilitas">Tambah Fasilitas</button>`)
                    table2.ajax.reload()
                }
            });
        }

    })

    //HAPUS DATA
    $("#table-fasilitas").on("click", ".delete-button", function () {
        let uuid = $(this).attr("data-uuid");
        let token = $(this).attr("data-token");
        Swal.fire({
            title: "Apakah Kamu Yakin?",
            text: "Kamu akan menghapus fasilitas!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Hapus!",
        }).then((result) => {
            if (result.isConfirmed) {
                $("#spinner").html(loader)
                $.ajax({
                    data: {
                        _method: "DELETE",
                        _token: token,
                    },
                    url: "/delete-fasilitas/" + uuid,
                    type: "POST",
                    dataType: "json",
                    success: function (response) {
                        $("#spinner").html("")
                        table2.ajax.reload();
                    },
                });
            }
        });
    });

    $("#table-fasilitas").on("click", ".photo-button", function () {
        let uuid = $(this).data("uuid");
        $("#photo_uuid").val(uuid);
        $("#modal-photo").modal("show")
        renderImage(uuid);
    })

    $("#save-gambar").on("click", function () {
        let uuid = $("#photo_uuid").val()
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
            let serializedData = $("form[id='form-photo']").serialize();// Ganti #form dengan ID formulir Anda
            let otherData = serializedData.split("&");

            otherData.forEach(function (item) {
                let keyValue = item.split("=");
                formData.append(keyValue[0], decodeURIComponent(keyValue[1]));
            });

            $.ajax({
                data: formData,
                url: "/store-photo/" + uuid,
                type: "POST",
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (response) {
                    $(button).removeAttr("disabled");
                    $("#photo").val("")
                    document.querySelector("#photo-preview").src = "/assets/img/user.png"
                    renderImage(uuid)
                }
            });

        }
    })

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
                    url: "/destroy-photo-fasilitas/" + uuid,
                    type: "POST",
                    dataType: "json",
                    success: function (response) {
                        renderImage(uuid);
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
            aspectRatio: 12 / 8,
            preview: '.preview'
        })
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    })

    $("#modal-cropper").on("click", ".crop_photo", function () {
        canvas = cropper.getCroppedCanvas({
            width: 1200,
            height: 800,
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

    //Hendler Error
    function displayErrors(errors) {
        // menghapus class 'is-invalid' dan pesan error sebelumnya
        $("input.form-control").removeClass("is-invalid");
        $("select.form-control").removeClass("is-invalid");
        $("div.invalid-feedback").remove();

        // menampilkan pesan error baru
        $.each(errors, function (field, messages) {
            let inputElement = $("input[name=" + field + "]");
            let selectElement = $("select[name=" + field + "]");
            let textAreaElement = $("textarea[name=" + field + "]");
            let feedbackElement = $(
                '<div class="invalid-feedback ml-2"></div>'
            );

            $(".btn-close").on("click", function () {
                inputElement.each(function () {
                    $(this).removeClass("is-invalid");
                });
                textAreaElement.each(function () {
                    $(this).removeClass("is-invalid");
                });
                selectElement.each(function () {
                    $(this).removeClass("is-invalid");
                });
            });

            $.each(messages, function (index, message) {
                feedbackElement.append(
                    $('<p class="p-0 m-0 fst-italic">' + message + "</p>")
                );
            });

            if (inputElement.length > 0) {
                inputElement.addClass("is-invalid");
                inputElement.after(feedbackElement);
            }

            if (selectElement.length > 0) {
                selectElement.addClass("is-invalid");
                selectElement.after(feedbackElement);
            }
            if (textAreaElement.length > 0) {
                textAreaElement.addClass("is-invalid");
                textAreaElement.after(feedbackElement);
            }
            inputElement.each(function () {
                if (inputElement.attr("type") == "text" || inputElement.attr("type") == "number") {
                    inputElement.on("click", function () {
                        $(this).removeClass("is-invalid");
                    });
                    inputElement.on("change", function () {
                        $(this).removeClass("is-invalid");
                    });
                } else if (inputElement.attr("type") == "date") {
                    inputElement.on("change", function () {
                        $(this).removeClass("is-invalid");
                    });
                } else if (inputElement.attr("type") == "password") {
                    inputElement.on("click", function () {
                        $(this).removeClass("is-invalid");
                    });
                } else if (inputElement.attr("type") == "email") {
                    inputElement.on("click", function () {
                        $(this).removeClass("is-invalid");
                    });
                }
            });
            textAreaElement.each(function () {
                textAreaElement.on("click", function () {
                    $(this).removeClass("is-invalid");
                });
            });
            selectElement.each(function () {
                selectElement.on("click", function () {
                    $(this).removeClass("is-invalid");
                });
            });
        });
    }
});
