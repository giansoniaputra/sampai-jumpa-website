$(document).ready(function () {
    let table = $("#table-siswa").DataTable({
        responsive: true,
        responsive: !0,
        autoWidth: false,
        serverSide: true,
        ajax: {
            url: "/dataTablesSiswa",
            type: "GET",
            data: function (a) {
                a.tahun_ajaran_uuid = $("#tahun-ajaran-uuid").val()
                a.kelas = $("#select-kelas").val()
            }
        },
        columns: [
            {
                data: null,
                orderable: false,
                render: function (data, type, row, meta) {
                    var pageInfo = $("#table-siswa").DataTable().page.info();
                    var index = meta.row + pageInfo.start + 1;
                    return index;
                },
            },
            {
                data: "nama_kelas",
            },
            {
                data: "jumlah_lk",
            },
            {
                data: "jumlah_pr",
            },
            {
                data: null,
                render: function (data) {
                    return data.jumlah_lk + data.jumlah_pr
                }
            },
            {
                data: "action",
                orderable: true,
                searchable: true,
            },
        ],
        columnDefs: [
            {
                targets: [5], // index kolom atau sel yang ingin diatur
                className: "text-center", // kelas CSS untuk memposisikan isi ke tengah
            },
            {
                searchable: false,
                orderable: false,
                targets: 0, // Kolom nomor, dimulai dari 0
            },
        ],
    });

    $("#tahun-ajaran-uuid").on("change", function () {
        table.ajax.reload()
    })
    $("#select-kelas").on("change", function () {
        table.ajax.reload()
    })

    // KETIKA MODAL DI TUTUP
    $("#btn-close").on("click", function () {
        reset();
    })

    $("#btn-add-data").on("click", function () {
        $("#modal-siswa .modal-title").html("Tambah Kelas dan Jumlah Siswa")
        $("#modal-siswa .modal-footer").html(`<button class="btn btn-primary" id="save-data">Tambah</button>`)
        $("#modal-siswa").modal("show")
    })

    $("#modal-siswa").on("click", "#save-data", function () {
        $("#spinner").html(loader)
        let button = $(this)
        $(button).attr("disabled", "true");
        let formdata = $('form[id="form-siswa"]').serialize();
        $.ajax({
            data: formdata,
            url: "/admin/siswa",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                $(button).removeAttr("disabled");
                $("#spinner").html("")
                table.ajax.reload()
                reset();
                Swal.fire("Success!", response.success, "success");
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

    $("#table-siswa").on("click", ".edit-button", function () {
        let uuid = $(this).data("uuid");
        $.ajax({
            url: "/admin/siswa/" + uuid + "/edit",
            type: "GET",
            dataType: 'json',
            success: function (response) {
                let data = response.data
                $("#tahun_ajaran_uuid").val(data.tahun_ajaran_uuid)
                $("#kelas").val(data.kelas)
                $("#nama_kelas").val(data.nama_kelas)
                $("#jumlah_pr").val(data.jumlah_pr)
                $("#jumlah_lk").val(data.jumlah_lk)
                $("#modal-siswa .modal-title").html("Ubah Kelas dan Jumlah Siswa")
                $("#modal-siswa .modal-footer").html(`<button class="btn btn-primary" data-uuid="${uuid}" id="update-data">Ubah</button>`)
                $("#modal-siswa").modal("show")
            }
        });
    })

    $("#modal-siswa").on("click", "#update-data", function () {
        let uuid = $(this).data("uuid");
        $("#spinner").html(loader)
        let button = $(this)
        $(button).attr("disabled", "true");
        let formdata = $('form[id="form-siswa"]').serialize();
        $.ajax({
            data: formdata + "&_method=PUT",
            url: "/admin/siswa/" + uuid,
            type: "POST",
            dataType: 'json',
            success: function (response) {
                $(button).removeAttr("disabled");
                $("#spinner").html("")
                table.ajax.reload()
                reset();
                Swal.fire("Success!", response.success, "success");
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
    $("#table-siswa").on("click", ".delete-button", function () {
        let uuid = $(this).attr("data-uuid");
        let token = $(this).attr("data-token");
        Swal.fire({
            title: "Apakah Kamu Yakin?",
            text: "Kamu akan menghapus komonen jabatan ini!",
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
                    url: "/admin/siswa/" + uuid,
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

    //KOSONGKAN SEMUA INPUTAN
    function reset() {
        let form = $("form[id='form-siswa']").serializeArray();
        form.map((a) => {
            $(`#${a.name}`).val("");
        })
        $("#modal-siswa .modal-title").html("")
        $("#modal-siswa .modal-footer").html("")
        $("#modal-siswa").modal("hide")
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
