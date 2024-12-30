$(document).ready(function () {
    let renderInformasi = () => {
        $("#spinner").html(loader)
        let form = $("#form-info")
        $.ajax({
            url: "/render-form-informasi",
            type: "GET",
            dataType: 'json',
            success: function (response) {
                let data = response.data
                let element = `
                    <input type="hidden" value="${csrfToken}" name="_token">
                     ${(response.data) ? `<input type="hidden" name="current_uuid" value="${data.uuid}">` : ''}
                    <div class="mb-3">
                        <label for="nama_madrasah" class="form-label">Nama Madrasah</label>
                        <input type="text" class="form-control" name="nama_madrasah" id="nama_madrasah" placeholder="Masukan Nama Madrasah" value="${(response.data) ? data.nama_madrasah : ''}">
                    </div>
                    <div class="mb-3">
                        <label for="npsn" class="form-label">NPSN</label>
                        <input type="text" class="form-control" name="npsn" id="npsn" placeholder="Masukan NPSN" value="${(response.data) ? data.npsn : ''}">
                    </div>
                    <div class="mb-3">
                        <label for="nsm" class="form-label">NPSN</label>
                        <input type="text" class="form-control" name="nsm" id="nsm" placeholder="Masukan NSM" value="${(response.data) ? data.nsm : ''}">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="3">${(response.data) ? data.alamat : ''}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="telepon" class="form-label">Telepon</label>
                        <input type="text" class="form-control" name="telepon" id="telepon" placeholder="Masukan Nomor Telepon" value="${(response.data) ? data.telepon : ''}">
                    </div>
                    <div class="mb-3">
                        <label for="sk" class="form-label">Nomor SK</label>
                        <input type="text" class="form-control" name="sk" id="sk" placeholder="Masukan Nomor SK" value="${(response.data) ? data.sk : ''}">
                    </div>
                `
                form.html(element)
                $("#spinner").html("")
            }
        });
    }
    renderInformasi()
    let table = $("#table-informasi").DataTable({
        responsive: true,
        responsive: !0,
        autoWidth: false,
        serverSide: true,
        ajax: {
            url: "/dataTablesInformation",
        },
        columns: [
            {
                data: "nama_madrasah",
            },
            {
                data: "npsn",
            },
            {
                data: "nsm",
            },
            {
                data: "alamat",
            },
            {
                data: "telepon",
            },
            {
                data: "sk",
            },
        ],
        columnDefs: [
            {
                targets: [0, 1, 2, 3, 4, 5], // index kolom atau sel yang ingin diatur
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
        $("#modal-info").modal("show");
    })

    $("#btn-close").on("click", function () {
        renderInformasi();
    })

    $("#update-data").on("click", function () {
        $("#spinner").html(loader)
        let button = $(this)
        $(button).attr("disabled", "true");
        let formdata = $('form[id="form-info"]').serialize();
        $.ajax({
            data: formdata,
            url: "/update-informasi",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                $("#spinner").html("")
                $(button).removeAttr("disabled");
                renderInformasi
                table.ajax.reload()
                $("#modal-info").modal("hide")
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
