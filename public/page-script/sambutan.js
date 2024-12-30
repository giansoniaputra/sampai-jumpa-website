$(document).ready(function () {
    let renderPage = () => {
        $("#spinner").html(loader)
        $.ajax({
            url: "/render-sambutan",
            type: "GET",
            dataType: 'json',
            success: function (response) {
                let data = response.data
                let card = $("#card")
                let card2 = $("#card2")
                if (data) {
                    if (data.sambutan == null || data.sambutan == '') {
                        var sambutan = 'Belum ada sambutan!'
                    } else {
                        var sambutan = data.sambutan
                        $("#sambutan").val(sambutan)
                        $("trix-editor[input='sambutan']").val(sambutan)
                    }
                    let element = `
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h2>Sambutan</h2>
                                <p class="card-text">${sambutan}</p>
                                </div>
                                </div>
                    </div>`
                    if (data.sejarah == null || data.sejarah == '') {
                        var sejarah = 'Belum ada sejarah!'
                    } else {
                        var sejarah = data.sejarah
                        $("#sejarah").val(sejarah)
                        $("trix-editor[input='sejarah']").val(sejarah)
                    }
                    let element2 = `
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h2>Sejarah</h2>
                                <p class="card-text">${sejarah}</p>
                            </div>
                        </div>
                    </div>`
                    card.html(element)
                    card2.html(element2)
                    $("#spinner").html("")
                } else {
                    let element = `
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h2>Sambutan</h2>
                                <p class="card-text">Belum Ada Sambutan</p>
                            </div>
                        </div>
                    </div>`
                    let element2 = `
                    <div class="row no-gutters">
                        <div class="col-md-12">
                            <div class="card-body">
                                <h2>Sejarah</h2>
                                <p class="card-text">Belum Ada Sejarah</p>
                            </div>
                        </div>
                    </div>`
                    card.html(element)
                    card2.html(element2)
                    $("#spinner").html("")
                }
            }
        });
    }
    // RENDER PAGE
    renderPage()
    //------ RENDER PAGE
    $("#btn-add-data").on("click", function () {
        $("#modal-sambutan").modal("show")
    })

    $("#modal-sambutan").on("click", "#update-data", function () {
        $("#spinner").html(loader)
        let button = $(this)
        $(button).attr("disabled", "true");
        let formdata = $('form[id="form-sambutan"]').serialize();
        $.ajax({
            data: formdata,
            url: "/update-sambutan",
            type: "POST",
            dataType: 'json',
            success: function (response) {
                $(button).removeAttr("disabled");
                renderPage()
                $("#spinner").html("")
                $("#modal-sambutan").modal('hide')
                Swal.fire("Success!", response.success, "success");
            }
        });
    })

    $("#btn-close").on("click", function () {
        renderPage();
    })
});
