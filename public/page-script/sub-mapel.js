$(document).ready(function () {
    let table2 = $("#table-sub-mapel").DataTable({
        responsive: true,
        responsive: !0,
        autoWidth: false,
        serverSide: true,
        ajax: {
            url: "/dataTablesSubMapel",
            type: "GET",
            data: function (a) {
                a.mapel_uuid = $("#mapel_uuid").val()
            }
        },
        columns: [
            {
                data: null,
                orderable: false,
                render: function (data, type, row, meta) {
                    var pageInfo = $("#table-sub-mapel").DataTable().page.info();
                    var index = meta.row + pageInfo.start + 1;
                    return index;
                },
            },
            {
                data: "sub_mapel",
            },
            {
                data: "jumlah_jam",
            },
            {
                data: "jumlah_jam_2",
            },
            {
                data: "action",
                orderable: true,
                searchable: true,
            },
        ],
        columnDefs: [
            {
                targets: [3], // index kolom atau sel yang ingin diatur
                className: "text-center", // kelas CSS untuk memposisikan isi ke tengah
            },
            {
                searchable: false,
                orderable: false,
                targets: 0, // Kolom nomor, dimulai dari 0
            },
        ],
    });

    $("#table-mapel").on("click", ".add-button", function () {
        let uuid = $(this).data("uuid");
        $("#mapel_uuid").val(uuid)
        table2.ajax.reload()
        $("#modal-sub-mapel").modal("show")
    })

    // KETIKA MODAL DI TUTUP
    $("#btn-close2").on("click", function () {
        $("#jumlah_jam_sub").val("")
        $("#current_uuid").val("")
        $("#sub_mapel").val("")
        $("#btn-action-add-sub-mapel").html(saveButton());
    })

    $("#modal-sub-mapel").on("click", "#save-data-sub", function () {
        $("#spinner").html(loader)
        let button = $(this)
        $(button).attr("disabled", "true");
        let formdata = $('form[id="form-sub-mapel"]').serialize();
        $.ajax({
            data: formdata,
            url: "/admin/sub-mapel",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                $(button).removeAttr("disabled");
                $("#spinner").html("")
                table2.ajax.reload()
                reset2();
            },
            error: function (xhr, status, error) {
                if (xhr.status == 400) {
                    $("#spinner").html("")
                    $(button).removeAttr("disabled");
                    let errors = xhr.responseJSON.errors
                    displayErrors(errors)
                }
            }
        });
    })

    $("#table-sub-mapel").on("click", ".edit-button", function () {
        let uuid = $(this).data("uuid");
        $.ajax({
            url: "/admin/sub-mapel/" + uuid + "/edit",
            type: "GET",
            dataType: 'json',
            success: function (response) {
                let data = response.data
                $("#btn-action-add-sub-mapel").html(updateButton(data.uuid))
                $("#current_uuid").val(data.uuid)
                $("#mapel_uuid").val(data.mapel_uuid)
                $("#sub_mapel").val(data.sub_mapel)
                $("#jumlah_jam_sub").val(parseInt(data.jumlah_jam))
                $("#jumlah_jam_sub_2").val(parseInt(data.jumlah_jam_2))
            }
        });
    })

    $("#modal-sub-mapel").on("click", "#batal-data-sub", function () {
        $("#jumlah_jam_sub").val("")
        $("#current_uuid").val("")
        $("#sub_mapel").val("")
        $("#btn-action-add-sub-mapel").html(saveButton());
    })


    $("#modal-sub-mapel").on("click", "#update-data-sub", function () {
        let uuid = $(this).data("uuid");
        $("#spinner").html(loader)
        let button = $(this)
        $(button).attr("disabled", "true");
        let formdata = $('form[id="form-sub-mapel"]').serialize();
        $.ajax({
            data: formdata + "&_method=PUT",
            url: "/admin/sub-mapel/" + uuid,
            type: "POST",
            dataType: 'json',
            success: function (response) {
                $(button).removeAttr("disabled");
                $("#spinner").html("")
                table2.ajax.reload()
                $("#jumlah_jam_sub").val("")
                $("#current_uuid").val("")
                $("#sub_mapel").val("")
                $("#btn-action-add-sub-mapel").html(saveButton());
            },
            error: function (xhr, status, error) {
                if (xhr.status == 400) {
                    $("#spinner").html("")
                    $(button).removeAttr("disabled");
                    let errors = xhr.responseJSON.errors
                    displayErrors(errors)
                }
            }
        });
    })

    //HAPUS DATA
    $("#table-sub-mapel").on("click", ".delete-button", function () {
        $("#jumlah_jam_sub").val("")
        $("#current_uuid").val("")
        $("#sub_mapel").val("")
        $("#btn-action-add-sub-mapel").html(saveButton());
        let uuid = $(this).attr("data-uuid");
        let token = $(this).attr("data-token");
        Swal.fire({
            title: "Apakah Kamu Yakin?",
            text: "Kamu akan menghapus sub mata pelajaran!",
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
                    url: "/admin/sub-mapel/" + uuid,
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

    let saveButton = () => {
        return `
        <button class="btn btn-primary" id="save-data-sub">Tambah</button>
        `
    }
    let updateButton = (uuid) => {
        return `
        <button class="btn btn-warning text-white" data-uuid="${uuid}" id="update-data-sub">Ubah</button>
        <button class="btn btn-danger" id="batal-data-sub">Batal</button>
        `
    }

    //KOSONGKAN SEMUA INPUTAN
    function reset2() {
        let form = $("form[id='form-sub-mapel']").serializeArray();
        form.map((a) => {
            $(`#${a.name}`).val("");
        })
        $("#mapel_uuid").val("")
        $("#btn-action-add-sub-mapel").html(saveButton())
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
                    $('<p class="p-0 m-0" style="font-style:italic">' + message + "</p>")
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
