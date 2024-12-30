$(document).ready(function () {
    let table = $("#table-mapel").DataTable({
        responsive: true,
        responsive: !0,
        autoWidth: false,
        serverSide: true,
        processing: true,
        ajax: {
            url: "/dataTablesMapel",
            type: "GET",
            data: function (a) {
                let uuid = $("#option-kelas").val();
                let text = $("#option-kelas option:selected").text();
                let split = uuid.split("&-&");
                a.uuid = split[0];
            }
        },
        columns: [
            {
                data: null,
                orderable: false,
                render: function (data, type, row, meta) {
                    var pageInfo = $("#table-mapel").DataTable().page.info();
                    var index = meta.row + pageInfo.start + 1;
                    return index;
                },
            },
            {
                data: "jenis_mapel",
            },
            {
                data: "nama_mapel",
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
    // KETIKA MODAL DI TUTUP
    $("#btn-close").on("click", function () {
        reset();
    })

    $("#btn-add-data").on("click", function () {
        $("#modal-mapel .modal-title").html("Tambah Mata Pelajaran")
        $("#modal-mapel .modal-footer").html(`<button class="btn btn-primary" id="save-data">Tambah</button>`)
        $("#modal-mapel").modal("show")
    })

    $("#modal-mapel").on("click", "#save-data", function () {
        $("#spinner").html(loader)
        let button = $(this)
        $(button).attr("disabled", "true");
        let formdata = $('form[id="form-mapel"]').serialize();
        $.ajax({
            data: formdata,
            url: "/admin/mapel",
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

    $("#table-mapel").on("click", ".edit-button", function () {
        let uuid = $(this).data("uuid");
        $.ajax({
            url: "/admin/mapel/" + uuid + "/edit",
            type: "GET",
            dataType: 'json',
            success: function (response) {
                let data = response.data
                $("#jenis_mapel_uuid").val(data.jenis_mapel_uuid)
                $("#is_parent").val(data.is_parent)
                $("#nama_mapel").val(data.nama_mapel)
                $("#jumlah_jam").val(data.jumlah_jam)
                $("#jumlah_jam_2").val(data.jumlah_jam_2)
                $("#modal-mapel .modal-title").html("Ubah Mata Pelajaran")
                $("#modal-mapel .modal-footer").html(`<button class="btn btn-primary" data-uuid="${uuid}" id="update-data">Ubah</button>`)
                $("#modal-mapel").modal("show")
            }
        });
    })

    $("#modal-mapel").on("click", "#update-data", function () {
        let uuid = $(this).data("uuid");
        $("#spinner").html(loader)
        let button = $(this)
        $(button).attr("disabled", "true");
        let formdata = $('form[id="form-mapel"]').serialize();
        $.ajax({
            data: formdata + "&_method=PUT",
            url: "/admin/mapel/" + uuid,
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

    // KETIKA KELAS DIPILIH
    $("#option-kelas").on("change", function () {
        table.ajax.reload()
        let uuid = $(this).val();
        let text = $("#option-kelas option:selected").text();
        let split = uuid.split("&-&");
        let kurikulum = split[1];
        let jam1 = $("label[for='jumlah_jam']")
        let jam2 = $("label[for='jumlah_jam_2']")
        if (kurikulum == 0) {
            $("#jam1").html("Regular")
            $("#jam2").html("Proyek PPPP")
            $("#sub1").html("Regular")
            $("#sub2").html("Proyek PPPP")
            $("#sub-jam2").html("Proyek PPPP")
            $("#sub-jam1").html("Regular")
            jam1.html("Regular")
            jam2.html("Proyek PPPP")
            $("#kelas").val(split[0])
            $("#kelas-input").val(text)
        } else {
            jam1.html("Alokasi Waktu S1")
            jam2.html("Alokasi Waktu S2")
            $("#jam1").html("Alokasi Waktu S1")
            $("#jam2").html("Alokasi Waktu S2")
            $("#sub1").html("Alokasi Waktu S1")
            $("#sub2").html("Alokasi Waktu S2")
            $("#sub-jam1").html("Alokasi Waktu S1")
            $("#sub-jam2").html("Alokasi Waktu S2")
            $("#kelas").val(split[0])
            $("#kelas-input").val(text)
        }
    })

    let uuid = $("#option-kelas").val();
    let text = $("#option-kelas option:selected").text();
    let split = uuid.split("&-&");
    let kurikulum = split[1];
    let jam1 = $("label[for='jumlah_jam']")
    let jam2 = $("label[for='jumlah_jam_2']")
    if (kurikulum == 0) {
        $("#jam1").html("Regular")
        $("#jam2").html("Proyek PPPP")
        $("#sub-jam2").html("Proyek PPPP")
        $("#sub-jam1").html("Regular")
        jam1.html("Regular")
        jam2.html("Proyek PPPP")
    } else {
        $("#jam1").html("Alokasi Waktu S1")
        $("#jam2").html("Alokasi Waktu S2")
        $("#sub-jam1").html("Alokasi Waktu S1")
        $("#sub-jam2").html("Alokasi Waktu S2")
        $("#kelas").val(split[0])
        $("#kelas-input").val(text)
        jam1.html("Alokasi Waktu S1")
        jam2.html("Alokasi Waktu S2")
    }
    $("#kelas").val(split[0])
    $("#kelas-input").val(text)


    //HAPUS DATA
    $("#table-mapel").on("click", ".delete-button", function () {
        let uuid = $(this).attr("data-uuid");
        let token = $(this).attr("data-token");
        Swal.fire({
            title: "Apakah Kamu Yakin?",
            text: "Kamu akan menghapus mata pelajaran!",
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
                    url: "/admin/mapel/" + uuid,
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
        let form = $("form[id='form-mapel']").serializeArray();
        form.map((a) => {
            if (a.name != 'kelas') {
                $(`#${a.name}`).val("");
            }
        })
        $("#modal-mapel .modal-title").html("")
        $("#modal-mapel .modal-footer").html("")
        $("#modal-mapel").modal("hide")
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
