$(document).ready(function () {
    let fotoKep
    let renderHome = () => {
        $("#spinner").html(loader)
        $.ajax({
            url: "/render-home",
            type: "GET",
            dataType: 'json',
            success: function (response) {
                let card = $("#card")
                if (response.data) {
                    let data = response.data
                    let element = `
                        <div class="row no-gutters">
                            <div class="col-md-4 p-4">
                                <img src="/storage/${data.photo}" alt="Photo Kepala Sekolah" style="height:250px;width:250px" class="img-thumbnail">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <p class="card-text">${data.welcome}</p>
                                </div>
                            </div>
                        </div>
                        `
                    card.html(element)
                    $("#spinner").html("")
                    document.querySelector('#photo-kepsek').src = `/storage/${data.photo}`
                    $("#welcome").val(data.welcome)
                    $("trix-editor[input='welcome']").val(data.welcome)
                    fotoKep = `/storage/${data.photo}`
                } else {
                    let element = `
                    <div class="row no-gutters">
                            <div class="col-md-6">
                                <img src="/assets/img/avatar5.png" alt="...">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h5 class="card-title">Judul Deskripsi</h5>
                                    <p class="card-text">Deskripsi: Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima perspiciatis, at nobis minus sequi commodi distinctio fugit ratione illum dolore suscipit! Laborum hic ducimus omnis veritatis recusandae similique nemo ex!</p>
                                </div>
                            </div>
                            </div>
                            `
                    card.html(element)
                    document.querySelector('#photo-kepsek').src = `/assets/img/avatar5.png`
                    $("#spinner").html("")
                    fotoKep = `/assets/img/avatar5.png`
                }
            }
        });
    }

    // RENDER HOME
    renderHome()
    // Add Data
    $("#btn-add-data").on("click", function () {
        $("#modal-home").modal('show');
        $("#modal-home .modal-title").html("Update Deskripsi")
        $("#modal-home .modal-footer").html(`<button class="btn btn-primary" id="update-data">Update Deskripsi</button>`)
    })
    $("#btn-close").on("click", function () {
        reset()
        renderHome()
    })
    // SIMPAN DESKRIPSI
    $("#modal-home").on("click", "#update-data", function () {
        $("#spinner").html(loader)
        let button = $(this)
        $(button).attr("disabled", "true");
        let photo = document.querySelector("input[name='photo']")

        let formData = new FormData();
        if (photo.value != '') {
            formData.append('photo', photo.files[0]);
        }

        // Mendapatkan data inputan lainnya dari hasil serialize
        let serializedData = $("form[id='form-home']").serialize();;// Ganti #form dengan ID formulir Anda
        let otherData = serializedData.split("&");

        otherData.forEach(function (item) {
            let keyValue = item.split("=");
            formData.append(keyValue[0], decodeURIComponent(keyValue[1]));
        });
        $.ajax({
            data: formData,
            url: "/update-home",
            type: "POST",
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                $(button).removeAttr("disabled");
                renderHome()
                $("#spinner").html("")
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
            aspectRatio: 3 / 4,
            preview: '.preview'
        })
    }).on('hidden.bs.modal', function () {
        cropper.destroy();
        cropper = null;
    })

    $("#modal-cropper").on("click", ".crop_photo", function () {
        canvas = cropper.getCroppedCanvas({
            width: 750,
            height: 1000,
        })
        canvas.toBlob(function (blob) {
            let image = document.querySelector("#photo");
            const imgPre = document.querySelector("#photo-kepsek");
            // const imgPre = document.querySelector("#");
            const oFReader = new FileReader();
            oFReader.readAsDataURL(blob);
            oFReader.onload = function (oFREvent) {
                imgPre.src = oFREvent.target.result
                var file = dataURLtoFile(oFREvent.target.result, "photo-kepala-sekolah.png");
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
        let form = $("form[id='form-home']").serializeArray();
        form.map((a) => {
            $(`#${a.name}`).val("");
        })
        $("#modal-home .modal-title").html("")
        $("#modal-home .modal-footer").html("")
        document.querySelector("#photo-kepsek").src = fotoKep
        document.querySelector("#photo").value = ""
        $("#modal-home").modal('hide')
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
