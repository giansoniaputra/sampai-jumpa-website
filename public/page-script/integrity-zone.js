$(document).ready(function () {
    let table = $("#table-integrity").DataTable({
        responsive: true,
        responsive: !0,
        autoWidth: false,
        serverSide: true,
        processing: true,
        ajax: {
            url: "/DataTablesIntegrity",
        },
        columns: [
            {
                data: null,
                orderable: false,
                render: function (data, type, row, meta) {
                    var pageInfo = $("#table-integrity")
                        .DataTable()
                        .page.info();
                    var index = meta.row + pageInfo.start + 1;
                    return index;
                },
            },
            {
                data: "title",
            },
            {
                data: "deskripsi",
            },
            {
                data: null,
                render: (data) => {
                    if (data.status == 1) {
                        return `
                        <span class="btn btn-success badge">Utama</span>
                        `;
                    } else {
                        return `
                        <span class="btn btn-secondary badge" id="ubah-status" data-uuid="${data.uuid}">Lainnya</span>
                        `;
                    }
                },
            },
            {
                data: null,
                render: (data) => {
                    return `
                        <a class="btn btn-primary badge" href="${data.file}" target="_blank">Lihat</a>
                    `;
                },
            },
            {
                data: null,
                render: (data) => {
                    return `
                        <a class="btn btn-primary badge" href="/storage/${data.icon}" target="_blank">Lihat</a>
                    `;
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
                targets: [3, 4, 5, 6], // index kolom atau sel yang ingin diatur
                className: "text-center", // kelas CSS untuk memposisikan isi ke tengah
            },
            {
                searchable: false,
                orderable: false,
                targets: 0, // Kolom nomor, dimulai dari 0
            },
        ],
    });
    // KETIKA MODAL DI TUTUP
    $("#btn-close").on("click", function () {
        reset();
    });

    $("#btn-add-data").on("click", function () {
        $("#modal-integrity .modal-title").html("Tambah File");
        $("#modal-integrity .modal-footer").html(
            `<button class="btn btn-primary" id="save-data">Tambah</button>`
        );
        $("#modal-integrity").modal("show");
    });

    $("#modal-integrity").on("click", "#save-data", function () {
        $("#spinner").html(loader);
        let button = $(this);
        $(button).attr("disabled", "true");
        let icon = document.querySelector("input[name='icon']");

        let formData = new FormData();
        if (icon.value != "") {
            formData.append("icon", icon.files[0]);
        }

        // Mendapatkan data inputan lainnya dari hasil serialize
        let serializedData = $('form[id="form-integrity"').serialize(); // Ganti #form dengan ID formulir Anda
        let otherData = serializedData.split("&");

        otherData.forEach(function (item) {
            let keyValue = item.split("=");
            formData.append(keyValue[0], decodeURIComponent(keyValue[1]));
        });
        $.ajax({
            data: formData,
            url: "/admin/integrity-zone",
            type: "POST",
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                $(button).removeAttr("disabled");
                $("#spinner").html("");
                table.ajax.reload();
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

    $("#table-integrity").on("click", ".edit-button", function () {
        let uuid = $(this).data("uuid");
        $.ajax({
            url: "/admin/integrity-zone/" + uuid + "/edit",
            type: "GET",
            dataType: "json",
            success: function (response) {
                let data = response.data;
                $("#title").val(data.title);
                $("#deskripsi").val(data.deskripsi);
                $("#file").val(data.file);
                $("#modal-integrity .modal-title").html("Ubah File");
                $("#modal-integrity .modal-footer").html(
                    `<button class="btn btn-primary" data-uuid="${uuid}" id="update-data">Ubah</button>`
                );
                $("#modal-integrity").modal("show");
            },
        });
    });

    $("#modal-integrity").on("click", "#update-data", function () {
        let uuid = $(this).data("uuid");
        $("#spinner").html(loader);
        let button = $(this);
        $(button).attr("disabled", "true");
        let icon = document.querySelector("input[name='icon']");

        let formData = new FormData();
        if (icon.value != "") {
            formData.append("icon", icon.files[0]);
        }
        formData.append("_method", "PUT");

        // Mendapatkan data inputan lainnya dari hasil serialize
        let serializedData = $('form[id="form-integrity"').serialize(); // Ganti #form dengan ID formulir Anda
        let otherData = serializedData.split("&");

        otherData.forEach(function (item) {
            let keyValue = item.split("=");
            formData.append(keyValue[0], decodeURIComponent(keyValue[1]));
        });

        $.ajax({
            data: formData,
            url: "/admin/integrity-zone/" + uuid,
            type: "POST",
            dataType: "json",
            processData: false,
            contentType: false,
            success: function (response) {
                $(button).removeAttr("disabled");
                $("#spinner").html("");
                table.ajax.reload();
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
    $("#table-integrity").on("click", ".delete-button", function () {
        let uuid = $(this).attr("data-uuid");
        let token = $(this).attr("data-token");
        Swal.fire({
            title: "Apakah Kamu Yakin?",
            text: "Kamu akan menghapus file ini!",
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
                    url: "/admin/integrity-zone/" + uuid,
                    type: "POST",
                    dataType: "json",
                    success: function (response) {
                        table.ajax.reload();
                        Swal.fire("Deleted!", response.success, "success");
                    },
                });
            }
        });
    });

    $("#table-integrity").on("click", "#ubah-status", function () {
        let uuid = $(this).data("uuid");
        Swal.fire({
            title: "Apakah Kamu Yakin?",
            text: "Kamu akan mengubah status file ini!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Ubah!",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    data: {
                        _token: csrfToken,
                    },
                    url: "/ubah-status-integrity/" + uuid,
                    type: "POST",
                    dataType: "json",
                    success: function (response) {
                        table.ajax.reload();
                        Swal.fire("Success!", response.success, "success");
                    },
                });
            }
        });
    });

    //KOSONGKAN SEMUA INPUTAN
    function reset() {
        let form = $("form[id='form-integrity']").serializeArray();
        form.map((a) => {
            $(`#${a.name}`).val("");
        });
        $("#modal-integrity .modal-title").html("");
        $("#modal-integrity .modal-footer").html("");
        $("#modal-integrity").modal("hide");
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
