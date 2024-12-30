$(document).ready(function () {
    let renderSosmed = () => {
        $("#spinner").html(loader)
        let form = $("#form-sosmed")
        $.ajax({
            url: "/render-form-sosmed",
            type: "GET",
            dataType: 'json',
            success: function (response) {
                let data = response.data
                console.log(response);
                let element = `
                    <input type="hidden" value="${csrfToken}" name="_token">
                     ${(response.data) ? `<input type="hidden" name="current_uuid" value="${data.uuid}">` : ''}

                    <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="wa" class="form-label">WhatsApp</label>
                            <input type="text" class="form-control" name="wa" id="wa" placeholder="Masukan WhatsApp" value="${(response.data && data.wa != null) ? data.wa : ''}">
                            <small class="text-success fst-italic">* Jangan pakai 0 tapi pakai 62</small>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="ig" class="form-label">Instagram</label>
                            <input type="text" class="form-control" name="ig" id="ig" placeholder="Masukan Instagram" value="${(response.data && data.ig != null) ? data.ig : ''}">
                        </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-6">
                    <div class="mb-3">
                    <label for="yt" class="form-label">Youtube</label>
                    <input type="text" class="form-control" name="yt" id="yt" placeholder="Masukan Youtube" value="${(response.data && data.yt != null) ? data.yt : ''}">
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="mb-3">
                    <label for="fb" class="form-label">Facebook</label>
                    <input type="text" class="form-control" name="fb" id="fb" placeholder="Masukan Facebook" value="${(response.data && data.fb != null) ? data.fb : ''}">
                    </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-6">
                    <div class="mb-3">
                    <label for="x" class="form-label">Twitter</label>
                        <input type="text" class="form-control" name="x" id="x" placeholder="Masukan Twitter" value="${(response.data && data.x != null) ? data.x : ''}">
                        </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="mb-3">
                        <label for="tt" class="form-label">Tiktok</label>
                        <input type="text" class="form-control" name="tt" id="tt" placeholder="Masukan Tiktok" value="${(response.data && data.tt != null) ? data.tt : ''}">
                    </div>
                    </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-6">
                    <div class="mb-3">
                    <label for="gmail" class="form-label">Gmail</label>
                        <input type="text" class="form-control" name="gmail" id="gmail" placeholder="Masukan Gmail" value="${(response.data && data.gmail != null) ? data.gmail : ''}">
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <div class="mb-3">
                    <label for="website" class="form-label">Website</label>
                        <input type="text" class="form-control" name="website" id="website" placeholder="Masukan Website" value="${(response.data && data.webiste != null) ? data.website : ''}">
                    </div>
                    </div>
                    </div>
                `
                form.html(element)
                $("#spinner").html("")
            }
        });
    }
    renderSosmed();

    let table = $("#table-sosmed").DataTable({
        responsive: true,
        responsive: !0,
        autoWidth: false,
        serverSide: true,
        ajax: {
            url: "/dataTablesSosmed",
        },
        columns: [
            {
                data: "wa",
            },
            {
                data: "ig",
            },
            {
                data: "yt",
            },
            {
                data: "fb"
            },
            {
                data: "x"
            },
            {
                data: "tt"
            },
            {
                data: "gmail"
            },
            {
                data: "website"
            }
        ],
    });
    $("#btn-add-data").on("click", function () {
        $("#modal-sosmed").modal("show")
    })
    $("#update-data").on("click", function () {
        $("#spinner").html(loader)
        let button = $(this)
        $(button).attr("disabled", "true");
        let formdata = $('form[id="form-sosmed"]').serialize();
        $.ajax({
            data: formdata,
            url: "/admin/sosmed",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                $(button).removeAttr("disabled");
                renderSosmed()
                $("#spinner").html("")
                table.ajax.reload()
                $("#modal-sosmed").modal("hide")
                Swal.fire("Success!", response.success, "success");
            },
            error: function (xhr, status, error) {
                if (xhr.status == 400) {
                    $(button).removeAttr("disabled");
                    $("#spinner").html("")
                    let errors = xhr.responseJSON.errors
                    displayErrors(errors)
                }
            }
        });
    })
    $("#btn-close").on("click", function () {
        renderSosmed()
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
                    $('<p class="p-0 m-0" style="font-style=:italic">' + message + "</p>")
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
