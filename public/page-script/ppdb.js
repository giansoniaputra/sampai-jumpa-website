$(document).ready(function () {
    let tablePrestasi = $("#table-ppdb-prestasi").DataTable({
        responsive: true,
        responsive: !0,
        autoWidth: false,
        serverSide: true,
        ajax: {
            url: "/dataTablesPPDBPrestasi",
        },
        columns: [
            {
                data: null,
                orderable: false,
                render: function (data, type, row, meta) {
                    var pageInfo = $("#table-ppdb-prestasi").DataTable().page.info();
                    var index = meta.row + pageInfo.start + 1;
                    return index;
                },
            },
            {
                data: "kegiatan",
            },
            {
                data: "tanggal",
            },
            {
                data: "tanggal2",
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

    let renderLink = () => {
        $.ajax({
            url: "/render-link-ppdb",
            type: "GET",
            dataType: 'json',
            success: function (response) {
                $("#view-link").html(response.view);

            }
        });
    }

    renderLink()

    $("#view-link").on("click", "#update-ppdb", function () {
        $("#spinner").html(loader)
        let button = $(this)
        $(button).attr("disabled", "true");
        let formdata = $('form[id="form-ppdb"]').serialize();
        $.ajax({
            data: formdata,
            url: "/update-ppdb",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                $(button).removeAttr("disabled");
                renderLink()
                $("#spinner").html("")
                Swal.fire("Success!", response.success, "success");
            }
        });
    })
    $("#view-link").on("click", "#update-ulang", function () {
        $("#spinner").html(loader)
        let button = $(this)
        $(button).attr("disabled", "true");
        let formdata = $('form[id="form-ulang"]').serialize();
        $.ajax({
            data: formdata,
            url: "/update-ulang",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                $(button).removeAttr("disabled");
                renderLink()
                $("#spinner").html("")
                Swal.fire("Success!", response.success, "success");
            }
        });
    })

    $("#view-link").on("click", "#update-sampul", function () {
        let button = $(this)
        $(button).attr("disabled", "true");
        $("#spinner").html(loader)
        let photo = document.querySelector("input[name='link_ppdb']")

        let formData = new FormData();
        if (photo.value != '') {
            formData.append('link_ppdb', photo.files[0]);
            let serializedData = $("form[id='form-sampul']").serialize();;// Ganti #form dengan ID formulir Anda
            let otherData = serializedData.split("&");

            otherData.forEach(function (item) {
                let keyValue = item.split("=");
                formData.append(keyValue[0], decodeURIComponent(keyValue[1]));
            });

            $.ajax({
                data: formData,
                url: "/update-sampul-link",
                type: "POST",
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (response) {
                    $(button).removeAttr("disabled");
                    renderLink()
                    $("#spinner").html("")
                    Swal.fire("Success!", response.success, "success");
                }
            });
        } else {
            $(button).removeAttr("disabled");
            $("#spinner").html("")
            Swal.fire("Info!", "Sampul tidak boleh kosong", "warning");
        }

        // Mendapatkan data inputan lainnya dari hasil serialize
    })
    $("#view-link").on("click", "#update-sampul-bawah", function () {
        let button = $(this)
        $(button).attr("disabled", "true");
        $("#spinner").html(loader)
        let photo = document.querySelector("input[name='link_ppdb_bawah']")

        let formData = new FormData();
        if (photo.value != '') {
            formData.append('link_ppdb_bawah', photo.files[0]);
            let serializedData = $("form[id='form-sampul-bawah']").serialize();;// Ganti #form dengan ID formulir Anda
            let otherData = serializedData.split("&");

            otherData.forEach(function (item) {
                let keyValue = item.split("=");
                formData.append(keyValue[0], decodeURIComponent(keyValue[1]));
            });

            $.ajax({
                data: formData,
                url: "/update-sampul-link-bawah",
                type: "POST",
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (response) {
                    $(button).removeAttr("disabled");
                    renderLink()
                    $("#spinner").html("")
                    Swal.fire("Success!", response.success, "success");
                }
            });
        } else {
            $(button).removeAttr("disabled");
            $("#spinner").html("")
            Swal.fire("Info!", "Sampul tidak boleh kosong", "warning");
        }

        // Mendapatkan data inputan lainnya dari hasil serialize
    })

    $("#btn-action-prestasi").on("click", "#save-data-prestasi", function () {
        $("#spinner").html(loader)
        let button = $(this)
        let formData = $("form[id='form-ppdb-prestasi']").serialize()
        $.ajax({
            data: formData,
            url: "/admin/ppdb",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                $(button).removeAttr("disabled");
                $("#spinner").html("")
                tablePrestasi.ajax.reload()
                $("#kegiatan-prestasi").val("")
                $("#tanggal-prestasi2").val("")
                $("#tanggal-prestasi").val("")
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



    $("#table-ppdb-prestasi").on("click", ".edit-button", function () {
        let uuid = $(this).data("uuid");
        $.ajax({
            url: "/admin/ppdb/edit/" + uuid,
            type: "GET",
            dataType: 'json',
            success: function (response) {
                let data = response.data
                console.log(data);
                $("#btn-action-prestasi").html(updateButton(uuid, 'prestasi'))
                $("#kegiatan-prestasi").val(data.kegiatan)
                $("#tanggal-prestasi").val(data.tanggal)
                $("#tanggal-prestasi2").val(data.tanggal2)
            }
        });
    })
    $("#btn-action-prestasi").on("click", "#batal-data-prestasi", function () {
        $("#btn-action-prestasi").html(saveButton('prestasi'))
        $("#kegiatan-prestasi").val("")
        $("#tanggal-prestasi").val("")
        $("#tanggal-prestasi2").val("")
    })


    $("#btn-action-prestasi").on("click", "#update-data-prestasi", function () {
        let uuid = $(this).data("uuid");
        $("#spinner").html(loader)
        let button = $(this)
        $(button).attr("disabled", "true");
        let formData = $("form[id='form-ppdb-prestasi']").serialize()
        $.ajax({
            data: formData + "&_method=PUT",
            url: "/admin/ppdb/update/" + uuid,
            type: "POST",
            dataType: 'json',
            success: function (response) {
                $(button).removeAttr("disabled");
                $("#spinner").html("")
                tablePrestasi.ajax.reload()
                $("#kegiatan-prestasi").val("")
                $("#tanggal-prestasi").val("")
                $("#tanggal-prestasi2").val("")
                $("#btn-action-prestasi").html(saveButton('prestasi'))
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
    $("#table-ppdb-prestasi").on("click", ".delete-button", function () {
        let uuid = $(this).attr("data-uuid");
        let token = $(this).attr("data-token");
        Swal.fire({
            title: "Apakah Kamu Yakin?",
            text: "Kamu akan menghapus ppdb!",
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
                    url: "/delete-ppdb/" + uuid,
                    type: "POST",
                    dataType: "json",
                    success: function (response) {
                        $("#kegiatan-prestasi").val("")
                        $("#tanggal-prestasi").val("")
                        $("#btn-action-prestasi").html(saveButton('prestasi'))
                        tablePrestasi.ajax.reload();
                    },
                });
            }
        });
    });


    //KOSONGKAN SEMUA INPUTAN

    let saveButton = (jenis) => {
        return `
        <button class="btn btn-primary" id="save-data-${jenis}">Tambah</button>
        `
    }
    let updateButton = (uuid, jenis) => {
        return `
        <button class="btn btn-warning text-white" data-uuid="${uuid}" id="update-data-${jenis}">Ubah</button>
        <button class="btn btn-danger" id="batal-data-${jenis}">Batal</button>
        `
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
