$(document).ready(function () {
    let notSampul = `<div class="alert alert-info" role="alert">Belum ada Sampul. Silahkan Upload</div>`;
    let renderPage = () => {
        let home = $("#card-home");
        let profil = $("#card-profil");
        let guru = $("#card-guru");
        let kurikulum = $("#card-kurikulum");
        let siswa = $("#card-siswa");
        let prestasi = $("#card-prestasi");
        let ppdb = $("#card-ppdb");
        let berita = $("#card-berita");
        let sarana = $("#card-sarana");
        let humas = $("#card-humas");
        let layanan = $("#card-layanan");
        let gallery = $("#card-gallery");
        let integrity = $("#card-integrity");
        $("#spinner").html(loader);
        $.ajax({
            url: "/render-sampul",
            type: "GET",
            dataType: "json",
            success: function (response) {
                if (response.data) {
                    let data = response.data;
                    home.html(
                        data.home != null
                            ? `<img class="img-fluid" src="/storage/${data.home}">`
                            : notSampul
                    );
                    profil.html(
                        data.profil != null
                            ? `<img class="img-fluid" src="/storage/${data.profil}">`
                            : notSampul
                    );
                    guru.html(
                        data.guru != null
                            ? `<img class="img-fluid" src="/storage/${data.guru}">`
                            : notSampul
                    );
                    kurikulum.html(
                        data.kurikulum
                            ? `<img class="img-fluid" src="/storage/${data.kurikulum}">`
                            : notSampul
                    );
                    siswa.html(
                        data.siswa != null
                            ? `<img class="img-fluid" src="/storage/${data.siswa}">`
                            : notSampul
                    );
                    prestasi.html(
                        data.prestasi != null
                            ? `<img class="img-fluid" src="/storage/${data.prestasi}">`
                            : notSampul
                    );
                    ppdb.html(
                        data.ppdb != null
                            ? `<img class="img-fluid" src="/storage/${data.ppdb}">`
                            : notSampul
                    );
                    berita.html(
                        data.berita != null
                            ? `<img class="img-fluid" src="/storage/${data.berita}">`
                            : notSampul
                    );
                    sarana.html(
                        data.sarana != null
                            ? `<img class="img-fluid" src="/storage/${data.sarana}">`
                            : notSampul
                    );
                    humas.html(
                        data.humas != null
                            ? `<img class="img-fluid" src="/storage/${data.humas}">`
                            : notSampul
                    );
                    layanan.html(
                        data.layanan != null
                            ? `<img class="img-fluid" src="/storage/${data.layanan}">`
                            : notSampul
                    );
                    gallery.html(
                        data.gallery != null
                            ? `<img class="img-fluid" src="/storage/${data.gallery}">`
                            : notSampul
                    );
                    integrity.html(
                        data.integrity != null
                            ? `<img class="img-fluid" src="/storage/${data.integrity}">`
                            : notSampul
                    );
                    $("#home").val("");
                    $("#profil").val("");
                    $("#guru").val("");
                    $("#kurikulum").val("");
                    $("#siswa").val("");
                    $("#prestasi").val("");
                    $("#ppdb").val("");
                    $("#berita").val("");
                    $("#sarana").val("");
                    $("#humas").val("");
                    $("#layanan").val("");
                    $("#gallery").val("");
                    $("#integrity").val("");
                    $("#spinner").html("");
                } else {
                    home.html(`<div class="alert alert-info" role="alert">
                    Belum ada Sampul. Silahkan Upload
                </div>`);
                    profil.html(`<div class="alert alert-info" role="alert">
                    Belum ada Sampul. Silahkan Upload
                </div>`);
                    guru.html(`<div class="alert alert-info" role="alert">
                    Belum ada Sampul. Silahkan Upload
                </div>`);
                    kurikulum.html(`<div class="alert alert-info" role="alert">
                    Belum ada Sampul. Silahkan Upload
                </div>`);
                    siswa.html(`<div class="alert alert-info" role="alert">
                    Belum ada Sampul. Silahkan Upload
                </div>`);
                    prestasi.html(`<div class="alert alert-info" role="alert">
                    Belum ada Sampul. Silahkan Upload
                </div>`);
                    ppdb.html(`<div class="alert alert-info" role="alert">
                    Belum ada Sampul. Silahkan Upload
                </div>`);
                    berita.html(`<div class="alert alert-info" role="alert">
                    Belum ada Sampul. Silahkan Upload
                </div>`);
                    sarana.html(`<div class="alert alert-info" role="alert">
                    Belum ada Sampul. Silahkan Upload
                </div>`);
                    humas.html(`<div class="alert alert-info" role="alert">
                    Belum ada Sampul. Silahkan Upload
                </div>`);
                    layanan.html(`<div class="alert alert-info" role="alert">
                    Belum ada Sampul. Silahkan Upload
                </div>`);
                    gallery.html(`<div class="alert alert-info" role="alert">
                    Belum ada Sampul. Silahkan Upload
                </div>`);
                    integrity.html(`<div class="alert alert-info" role="alert">
                    Belum ada Sampul. Silahkan Upload
                </div>`);
                    $("#home").val("");
                    $("#profil").val("");
                    $("#guru").val("");
                    $("#kurikulum").val("");
                    $("#siswa").val("");
                    $("#prestasi").val("");
                    $("#ppdb").val("");
                    $("#berita").val("");
                    $("#sarana").val("");
                    $("#layanan").val("");
                    $("#humas").val("");
                    $("#spinner").html("");
                    $("#gallery").html("");
                    $("#integrity").html("");
                }
            },
        });
    };
    // RENDER LOKASI
    renderPage();
    // RENDER LOKASI

    $("#jenis-sampul").on("change", function () {
        let value = $(this).val();
        if (value == "") {
            $("#input-photo").html(``);
        } else {
            $("#input-photo").html(`
                <div class="mb-3">
                    <label for="photo_${value}" class="form-label">Sampul ${value}</label>
                    <input type="file" class="form-control" name="photo_${value}" id="photo_${value}" />
                </div>
            `);
        }
    });

    $("#btn-add-data").on("click", function () {
        $("#modal-sampul").modal("show");
    });

    $("#btn-close").on("click", function () {
        $("#jenis-sampul").val(``);
        $("#input-photo").html(``);
    });

    $("#update-data").on("click", function () {
        let jenis = $("#jenis-sampul").val();
        if (jenis == null) {
            Swal.fire("Warning!", "Silahkan Pilih Jenis Sampul!", "warning");
        }
        if ($("#photo_" + jenis).val() == "") {
            Swal.fire("Warning!", "Silahkan Pilih Gambar!", "warning");
        } else {
            $("#spinner").html(loader);
            let button = $(this);
            $(button).attr("disabled", "true");
            let photo = document.querySelector(`input[name='photo_${jenis}']`);

            let formData = new FormData();
            if (photo.value != "") {
                formData.append(`photo_${jenis}`, photo.files[0]);
            }

            // Mendapatkan data inputan lainnya dari hasil serialize
            let serializedData = $("form[id='form-sampul']").serialize(); // Ganti #form dengan ID formulir Anda
            let otherData = serializedData.split("&");

            otherData.forEach(function (item) {
                let keyValue = item.split("=");
                formData.append(keyValue[0], decodeURIComponent(keyValue[1]));
            });

            $.ajax({
                data: formData,
                url: "/store-" + jenis,
                type: "POST",
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (response) {
                    $(button).removeAttr("disabled");
                    $("#jenis-sampul").val("");
                    $("#photo_" + jenis).val("");
                    renderPage();
                    $("#modal-sampul").modal("hide");
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

    // $("#btn-add-data").on("click", function () {
    //     $("#modal-lokasi").modal("show")
    // })

    // $("#btn-close").on("click", function () {
    //     renderlokasi()
    // })

    // $("#update-data").on("click", function () {
    //     $("#spinner").html(loader)
    //     let button = $(this)
    //     $(button).attr("disabled", "true");
    //     let formdata = $('form[id="form-lokasi"]').serialize();
    //     $.ajax({
    //         data: formdata,
    //         url: "/update-lokasi",
    //         type: "POST",
    //         dataType: 'json',
    //         success: function (response) {
    //             $(button).removeAttr("disabled");
    //             renderlokasi()
    //             $("#spinner").html("")
    //             $("#modal-lokasi").modal("hide")
    //             Swal.fire("Success!", response.success, "success");
    //         },
    //         error: function (xhr, status, error) {
    //             if (xhr.status == 400) {
    //                 $("#spinner").html("")
    //                 $(button).removeAttr("disabled");
    //                 let errors = xhr.responseJSON.errors
    //                 displayErrors(errors)
    //             }
    //         }
    //     });
    // })

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
