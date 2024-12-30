$(document).ready(function () {
    let tableGuru = $("#table-guru").DataTable({
        responsive: true,
        responsive: !0,
        autoWidth: false,
        serverSide: true,
        ajax: {
            url: "/dataTablesGuru",
        },
        columns: [
            {
                data: null,
                orderable: false,
                render: function (data, type, row, meta) {
                    var pageInfo = $("#table-guru").DataTable().page.info();
                    var index = meta.row + pageInfo.start + 1;
                    return index;
                },
            },
            {
                data: "nama",
            },
            {
                data: "status",
            },
            {
                data: null,
                render: function (a) {
                    return `<button class="btn btn-primary badge" id="view-photo" data-photo="/storage/${a.photo}">Lihat Photo</button>`;
                },
            },
            {
                data: "action",
                orderable: true,
                searchable: true,
            },
        ],
        columnDefs: [
            {
                targets: [4], // index kolom atau sel yang ingin diatur
                className: "text-center", // kelas CSS untuk memposisikan isi ke tengah
            },
            {
                searchable: false,
                orderable: false,
                targets: 0, // Kolom nomor, dimulai dari 0
            },
        ],
    });

    $("#table-guru").on("click", "#view-photo", function () {
        let photo = $(this).data("photo");
        document.querySelector("#image").src = photo;
        $("#modal-photo").modal("show");
    });
    $("#table-staff").on("click", "#view-photo", function () {
        let photo = $(this).data("photo");
        document.querySelector("#image").src = photo;
        $("#modal-photo").modal("show");
    });

    // KETIKA MODAL DI TUTUP
    $("#btn-close").on("click", function () {
        reset();
    });

    $("#btn-add-data").on("click", function () {
        $("#modal-pegawai .modal-title").html("Tambah Pesan");
        $("#modal-pegawai .modal-footer").html(
            `<button class="btn btn-primary" id="save-data">Tambah</button>`
        );
        $("#modal-pegawai").modal("show");
    });

    $("#modal-pegawai").on("click", "#save-data", function () {
        $("#spinner").html(loader);
        let button = $(this);
        $(button).attr("disabled", "true");
        let photo = document.querySelector("input[name='photo']");

        let formData = new FormData();
        if (photo.value != "") {
            formData.append("photo", photo.files[0]);
        }
        // Mendapatkan data inputan lainnya dari hasil serialize
        let serializedData = $("form[id='form-pegawai']").serialize(); // Ganti #form dengan ID formulir Anda
        let otherData = serializedData.split("&");

        otherData.forEach(function (item) {
            let keyValue = item.split("=");
            formData.append(keyValue[0], decodeURIComponent(keyValue[1]));
        });
        $.ajax({
            data: formData,
            url: "/admin/pegawai",
            type: "POST",
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                $(button).removeAttr("disabled");
                $("#spinner").html("");
                tableGuru.ajax.reload();
                reset();
                Swal.fire("Success!", response.success, "success");
            },
            error: function (xhr, status, error) {
                if (xhr.status == 400) {
                    $("#spinner").html("");
                    $(button).removeAttr("disabled");
                    let errors = xhr.responseJSON.errors;
                    displayErrors(errors);
                }
            },
        });
    });

    $("#table-guru").on("click", ".edit-button", function () {
        let uuid = $(this).data("uuid");
        $.ajax({
            url: "/admin/pegawai/" + uuid + "/edit",
            type: "GET",
            dataType: "json",
            success: function (response) {
                let data = response.data;
                $("#nama").val(data.nama);
                $("#status").val(data.status);
                $("#modal-pegawai .modal-title").html("Ubah Pesan");
                $("#modal-pegawai .modal-footer").html(
                    `<button class="btn btn-primary" data-uuid="${uuid}" id="update-data">Ubah</button>`
                );
                $("#modal-pegawai").modal("show");
            },
        });
    });

    $("#modal-pegawai").on("click", "#update-data", function () {
        let uuid = $(this).data("uuid");
        $("#spinner").html(loader);
        let button = $(this);
        $(button).attr("disabled", "true");
        let photo = document.querySelector("input[name='photo']");

        let formData = new FormData();
        if (photo.value != "") {
            formData.append("photo", photo.files[0]);
        }
        formData.append("_method", "PUT");
        // Mendapatkan data inputan lainnya dari hasil serialize
        let serializedData = $("form[id='form-pegawai']").serialize(); // Ganti #form dengan ID formulir Anda
        let otherData = serializedData.split("&");

        otherData.forEach(function (item) {
            let keyValue = item.split("=");
            formData.append(keyValue[0], decodeURIComponent(keyValue[1]));
        });
        $.ajax({
            data: formData,
            url: "/admin/pegawai/" + uuid,
            type: "POST",
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (response) {
                $(button).removeAttr("disabled");
                $("#spinner").html("");
                tableGuru.ajax.reload();
                reset();
                Swal.fire("Success!", response.success, "success");
            },
            error: function (xhr, status, error) {
                if (xhr.status == 400) {
                    $("#spinner").html("");
                    $(button).removeAttr("disabled");
                    let errors = xhr.responseJSON.errors;
                    displayErrors(errors);
                }
            },
        });
    });

    //HAPUS DATA
    $("#table-guru").on("click", ".delete-button", function () {
        let uuid = $(this).attr("data-uuid");
        let token = $(this).attr("data-token");
        Swal.fire({
            title: "Apakah Kamu Yakin?",
            text: "Kamu akan menghapus pesan!",
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
                        _token: token,
                    },
                    url: "/admin/pegawai/" + uuid,
                    type: "POST",
                    dataType: "json",
                    success: function (response) {
                        tableGuru.ajax.reload();
                        Swal.fire("Deleted!", response.success, "success");
                    },
                });
            }
        });
    });

    $("#table-staff").on("click", ".delete-button", function () {
        let uuid = $(this).attr("data-uuid");
        let token = $(this).attr("data-token");
        Swal.fire({
            title: "Apakah Kamu Yakin?",
            text: "Kamu akan menghapus data staff!",
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
                        _token: token,
                    },
                    url: "/admin/pegawai/" + uuid,
                    type: "POST",
                    dataType: "json",
                    success: function (response) {
                        tableStaff.ajax.reload();
                        Swal.fire("Deleted!", response.success, "success");
                    },
                });
            }
        });
    });

    let modal = $("#modal-cropper");
    let image = document.getElementById("image2");
    let cropper, reader, file;
    $("body").on("change", "#photo", function (e) {
        let files = e.target.files;
        let done = function (url) {
            image.src = url;
            modal.modal("show");
        };
        if (files && files.length > 0) {
            file = files[0];
            if (URL) {
                done(URL.createObjectURL(file));
            } else if (FileReader) {
                reader = new FileReader();
                reader.onload = function (e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    modal
        .on("shown.bs.modal", function () {
            cropper = new Cropper(image, {
                aspectRatio: 1 / 1.1,
                preview: ".preview",
            });
        })
        .on("hidden.bs.modal", function () {
            cropper.destroy();
            cropper = null;
        });

    $("#modal-cropper").on("click", ".crop_photo", function () {
        canvas = cropper.getCroppedCanvas({
            width: 1000,
            height: 1183,
        });
        canvas.toBlob(function (blob) {
            let image = document.querySelector("#photo");
            // const imgPre = document.querySelector("#photo-preview");
            // const imgPre = document.querySelector("#");
            const oFReader = new FileReader();
            oFReader.readAsDataURL(blob);
            oFReader.onload = function (oFREvent) {
                var file = dataURLtoFile(
                    oFREvent.target.result,
                    "photo-staff-guru.png"
                );
                let container = new DataTransfer();
                container.items.add(file);
                image.files = container.files;
                var newfile = image.files[0];
                // imgPre.src = oFREvent.target.result
                modal.modal("hide");
            };
        });
    });

    function dataURLtoFile(dataurl, filename) {
        var arr = dataurl.split(","),
            mime = arr[0].match(/:(.*?);/)[1],
            bstr = atob(arr[1]),
            n = bstr.length,
            u8arr = new Uint8Array(n);

        while (n--) {
            u8arr[n] = bstr.charCodeAt(n);
        }

        return new File([u8arr], filename, { type: mime });
    }

    //KOSONGKAN SEMUA INPUTAN
    function reset() {
        let form = $("form[id='form-pegawai']").serializeArray();
        form.map((a) => {
            $(`#${a.name}`).val("");
        });
        $("#modal-pegawai .modal-title").html("");
        $("#modal-pegawai .modal-footer").html("");
        $("#modal-pegawai").modal("hide");
        $("#input-ampuan").html("");
        $("#photo").val("");
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

            $("#btn-close").on("click", function () {
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
                    $(
                        '<p class="p-0 m-0" style="font-style:italic">' +
                            message +
                            "</p>"
                    )
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
                if (
                    inputElement.attr("type") == "text" ||
                    inputElement.attr("type") == "number"
                ) {
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
