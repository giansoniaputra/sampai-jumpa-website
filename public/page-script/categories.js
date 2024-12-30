$(document).ready(function () {
    let table = $("#table-category").DataTable({
        responsive: true,
        responsive: !0,
        autoWidth: false,
        serverSide: true,
        ajax: {
            url: "/dataTablesCategories",
        },
        columns: [
            {
                data: null,
                orderable: false,
                render: function (data, type, row, meta) {
                    var pageInfo = $("#table-category").DataTable().page.info();
                    var index = meta.row + pageInfo.start + 1;
                    return index;
                },
            },
            {
                data: "name",
            },
            {
                data: "action",
                orderable: true,
                searchable: true,
            },
        ],
        columnDefs: [
            {
                targets: [2], // index kolom atau sel yang ingin diatur
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
        $("#modal-category .modal-title").html("Tambah Kategori Berita");
        $("#modal-category .modal-footer").html(
            `<button class="btn btn-primary" id="save-data">tambah</button>`
        );
        $("#modal-category").modal("show");
    });

    $("#modal-category").on("click", "#save-data", function () {
        if ($("#name").val().toLowerCase() == "kegiatan") {
            Swal.fire("Info!", "Kategori Kegiatan Sudah Ada!", "info");
        } else if ($("#name").val().toLowerCase() == "zona integrasi") {
            Swal.fire("Info!", "Kategori Zona Integrasi Sudah Ada!", "info");
        } else {
            $("#spinner").html(loader);
            let button = $(this);
            $(button).attr("disabled", "true");
            let formdata = $('form[id="form-category"]').serialize();
            $.ajax({
                data: formdata,
                url: "/admin/category-news",
                type: "POST",
                dataType: "json",
                success: function (response) {
                    $("#spinner").html("");
                    $(button).removeAttr("disabled");
                    reset();
                    table.ajax.reload();
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
        }
    });

    $("#table-category").on("click", ".edit-button", function () {
        let uuid = $(this).data("uuid");
        $.ajax({
            url: "/admin/get-data-news/" + uuid,
            type: "GET",
            dataType: "json",
            success: function (response) {
                let data = response.data;
                $("#name").val(data.name);
                $("#modal-category .modal-title").html("Ubah Kategori Berita");
                $("#modal-category .modal-footer").html(
                    `<button class="btn btn-primary" data-uuid="${data.uuid}" id="update-data">Ubah</button>`
                );
                $("#modal-category").modal("show");
            },
        });
    });

    $("#modal-category").on("click", "#update-data", function () {
        if ($("#name").val().toLowerCase() == "kegiatan") {
            Swal.fire("Info!", "Kategori Kegiatan Sudah Ada!", "info");
        } else if ($("#name").val().toLowerCase() == "zona integrasi") {
            Swal.fire("Info!", "Kategori Zona Integrasi Sudah Ada!", "info");
        } else {
            let uuid = $(this).data("uuid");
            $("#spinner").html(loader);
            let button = $(this);
            $(button).attr("disabled", "true");
            let formdata = $('form[id="form-category"]').serialize();
            $.ajax({
                data: formdata + "&_method=PUT",
                url: "/update-category-news/" + uuid,
                type: "POST",
                dataType: "json",
                success: function (response) {
                    $(button).removeAttr("disabled");
                    $("#spinner").html("");
                    reset();
                    table.ajax.reload();
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
        }
    });

    //HAPUS DATA
    $("#table-category").on("click", ".delete-button", function () {
        let uuid = $(this).attr("data-uuid");
        let token = $(this).attr("data-token");
        Swal.fire({
            title: "Apakah Kamu Yakin?",
            text: "Kamu akan menghapus data guru!",
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
                    url: "/delete-category-news/" + uuid,
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

    $("#btn-close").on("click", function () {
        reset();
    });

    //KOSONGKAN SEMUA INPUTAN
    function reset() {
        let form = $("form[id='form-category']").serializeArray();
        form.map((a) => {
            $(`#${a.name}`).val("");
        });
        $("#modal-category .modal-title").html("");
        $("#modal-category .modal-footer").html("");
        $("#modal-category").modal("hide");
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
                        '<p class="p-0 m-0" style="font-style=:italic">' +
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
