$(document).ready(function () {
    let fotoVis
    let renderProfil = () => {
        $("#spinner").html(loader)
        $.ajax({
            url: "/render-profil",
            type: "GET",
            dataType: 'json',
            success: function (response) {
                let card = $("#card")
                let card2 = $("#card2")
                if (response.data) {
                    let data = response.data
                    if (data.misi == null) {
                        var element = `
                            <div class="row no-gutters">
                                <div class="col-md-4 p-4">
                                    <img src="/assets/img/avatar5.png" alt="Photo Kepala Sekolah" style="height:250px;width:250px" class="img-thumbnail">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h2>VISI</h2>
                                        <p class="card-text">Belum Ada Visi</p>
                                        <h2>MISI</h2>
                                        <p class="card-text">Belum Ada Misi</p>
                                    </div>
                                </div>
                            </div>`
                    } else {
                        var element = `
                            <div class="row no-gutters">
                                <div class="col-md-4 p-4">
                                    <img src="/storage/${data.photo}" alt="Photo Kepala Sekolah" style="height:250px;width:250px" class="img-thumbnail">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h2>VISI</h2>
                                        <p class="card-text">${data.visi}</p>
                                        <h2>MISI</h2>
                                        <p class="card-text">${data.misi}</p>
                                    </div>
                                </div>
                            </div>`
                        document.querySelector('#photo-misi').src = `/storage/${data.photo}`
                        $("#visi").val(data.visi)
                        $("trix-editor[input='visi']").val(data.visi)
                        $("#misi").val(data.misi)
                        $("trix-editor[input='misi']").val(data.misi)
                        fotoVis = `/storage/${data.photo}`
                    }
                    if (data.tujuan == null) {
                        var element2 = `
                            <div class="row no-gutters">
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <h2>TUJUAN</h2>
                                        <p class="card-text">Belum Ada Tujuan</p>
                                        <h2>STRATEGI</h2>
                                        <p class="card-text">Belum Ada Strategi</p>
                                    </div>
                                </div>
                            </div>
                            `
                    } else {
                        var element2 = `
                            <div class="row no-gutters">
                                <div class="col-md-12">
                                    <div class="card-body">
                                        <h2>TUJUAN</h2>
                                        <p class="card-text">${data.tujuan}</p>
                                        <h2>STRATEGI</h2>
                                        <p class="card-text">${data.strategi}</p>
                                    </div>
                                </div>
                            </div>
                            `
                        $("#tujuan").val(data.tujuan)
                        $("trix-editor[input='tujuan']").val(data.tujuan)
                        $("#strategi").val(data.strategi)
                        $("trix-editor[input='strategi']").val(data.strategi)
                    }
                    card.html(element)
                    card2.html(element2)
                    $("#spinner").html("")
                } else {
                    let element = `
                    <div class="row no-gutters">
                    <div class="col-md-6">
                                <img src="/assets/img/avatar5.png" alt="...">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                <h2>VISI</h2>
                                <p class="card-text">Silahkan Masukan Visi</p>
                                <h2>MISI</h2>
                                <p class="card-text">Silahkan Masukan Misi</p>
                                </div>
                            </div>
                            </div>
                            `
                    let element2 = `
                        <div class="row no-gutters">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <h2>TUJUAN</h2>
                                    <p class="card-text">Silahkan Masukan Tujuan</p>
                                    <h2>STRATEGI</h2>
                                    <p class="card-text">Silahkan Masukan Misi</p>
                                </div>
                            </div>
                        </div>
                        `
                    card.html(element)
                    card2.html(element2)
                    document.querySelector('#photo-misi').src = `/assets/img/avatar5.png`
                    $("#spinner").html("")
                    fotoVis = `/assets/img/avatar5.png`
                }
            }
        });
    }
    // LOAD PAGE
    renderProfil()

    // Buka Modal
    $("#btn-add-data").on("click", function () {
        $("#modal-profil #modal-title").html("Update Visi Misi")
        $("#modal-profil .modal-footer").html(`<button class="btn btn-primary" id="update-data">Update</button>`)
        $("#modal-profil").modal("show");
    })

    $("#modal-profil").on("click", "#update-data", function () {
        $("#spinner").html(loader)
        let button = $(this)
        $(button).attr("disabled", "true");
        let photo = document.querySelector("input[name='photo']")

        let formData = new FormData();
        if (photo.value != '') {
            formData.append('photo', photo.files[0]);
        }

        // Mendapatkan data inputan lainnya dari hasil serialize
        let serializedData = $("form[id='form-profil']").serialize();;// Ganti #form dengan ID formulir Anda
        let otherData = serializedData.split("&");

        otherData.forEach(function (item) {
            let keyValue = item.split("=");
            formData.append(keyValue[0], decodeURIComponent(keyValue[1]));
        });
        $.ajax({
            data: formData,
            url: "/update-profil",
            type: "POST",
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                $(button).removeAttr("disabled");
                reset();
                renderProfil()
                $("#spinner").html("")
                Swal.fire("Success!", response.success, "success");
            },
            error: function (xhr, status, error) {
                if (xhr.status == 400) {
                    $(button).removeAttr("disabled");
                    let errors = xhr.responseJSON.errors
                    $("#spinner").html("")
                    displayErrors(errors)
                }
            }
        });
    })

    $("#btn-add-data-tujuan").on("click", function () {
        $("#modal-tujuan #modal-title").html("Update Tujuan & Strategi")
        $("#modal-tujuan .modal-footer").html(`<button class="btn btn-primary" id="update-data">Update</button>`)
        $("#modal-tujuan").modal("show");
    })

    $("#modal-tujuan").on("click", "#update-data", function () {
        $("#spinner").html(loader)
        let button = $(this)
        $(button).attr("disabled", "true");
        $.ajax({
            data: $('form[id="form-tujuan"]').serialize(),
            url: "/update-tujuan",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                $(button).removeAttr("disabled");
                reset();
                renderProfil()
                $("#spinner").html("")
                $("#modal-tujuan").modal("hide")
                Swal.fire("Success!", response.success, "success");
            },
            error: function (xhr, status, error) {
                if (xhr.status == 400) {
                    $(button).removeAttr("disabled");
                    let errors = xhr.responseJSON.errors
                    $("#spinner").html("")
                    displayErrors(errors)
                }
            }
        });
    })

    $("#btn-close").on("click", function () {
        reset();
        renderProfil()
    })
    $("#btn-close2").on("click", function () {
        renderProfil()
    })

    $(".trix-button--icon-attach").addClass('d-none')

    // CROPPER
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
            aspectRatio: 1 / 1,
            preview: '.preview'
        })
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    })

    $("#modal-cropper").on("click", ".crop_photo", function () {
        canvas = cropper.getCroppedCanvas({
            width: 1000,
            height: 1000,
        })
        canvas.toBlob(function (blob) {
            let image = document.querySelector("#photo");
            const imgPre = document.querySelector("#photo-misi");
            // const imgPre = document.querySelector("#");
            const oFReader = new FileReader();
            oFReader.readAsDataURL(blob);
            oFReader.onload = function (oFREvent) {
                imgPre.src = oFREvent.target.result
                var file = dataURLtoFile(oFREvent.target.result, "photo-sampul-visi-misi.png");
                let container = new DataTransfer();
                container.items.add(file);
                image.files = container.files;
                var newfile = image.files[0];
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

    //KOSONGKAN SEMUA INPUTAN
    function reset() {
        let form = $("form[id='form-profil']").serializeArray();
        form.map((a) => {
            $(`#${a.name}`).val("");
        })
        $("#modal-profil #modal-title").html("")
        $("#modal-profil .modal-footer").html("")
        $("#modal-profil").modal("hide");
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
