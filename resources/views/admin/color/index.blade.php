@extends('admin.layouts.main')
@section('container')
<style>
    /* styles.css */

    .container {
        text-align: center;
    }

    .color-display {
        width: 200px;
        height: 200px;
        margin-bottom: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 2px solid #ccc;
        border-radius: 10px;
        font-size: 24px;
        color: #333;
        background-color: #fff;
    }

    input[type="color"] {
        margin-bottom: 20px;
        border: none;
        width: 100%;
        height: 50px;
        cursor: pointer;
    }

    button {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        background-color: #333;
        color: #fff;
        cursor: pointer;
    }

    button:hover {
        background-color: #555;
    }

</style>
<div class="row">
    <div class="col-sm-12">
        <label for="colorPicker">Clik untuk memilih warna</label>
    </div>
    <div class="col-sm-4">
        <input type="color" id="colorPicker" value="{{ color() }}" class="d-inline-block">
    </div>
    <div class="col-sm-12 mb-2" style="margin-top:-20px">
        <a href="javascript:;" class="btn btn-primary" id="change-color">Unah Warna</a>
    </div>
    <div class="col-sm-12" id="view-home" style="height: 65vh; overflow-x:scroll">
    </div>
</div>
<script>
    // script.js
    document.addEventListener('DOMContentLoaded', () => {
        const colorDisplay = document.getElementById('colorDisplay');
        const colorPicker = document.getElementById('colorPicker');

        colorPicker.addEventListener('input', updateColor);

        function updateColor() {
            const selectedColor = colorPicker.value;
            colorDisplay.textContent = selectedColor.toUpperCase();
            colorDisplay.style.backgroundColor = selectedColor;
        }

        function getRandomColor() {
            const letters = '0123456789ABCDEF';
            let color = '#';
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    });

    $(document).ready(function() {
        let renderView = () => {
            $("#spinner").html(loader)
            let viewHome = $("#view-home")
            $.ajax({
                url: "/render-view-home"
                , type: "GET"
                , dataType: 'json'
                , success: function(response) {
                    $("#spinner").html("")
                    viewHome.html(response.view);
                    $("#view-home .page-loader").remove()
                    $("#view-home #custom-collapse").remove()
                    $("#view-home .navbar-header").remove()
                }
            });
        }
        renderView();

        $("#change-color").on("click", function() {
            $("#spinner").html(loader)
            let color = $("#colorPicker").val()
            $.ajax({
                data: {
                    _token: csrfToken
                    , color: color
                }
                , url: "/admin/generate-color"
                , type: "POST"
                , dataType: 'json'
                , success: function(response) {
                    Swal.fire("Success!", response.success, "success");
                    renderView()
                }
            });
        })
    });

</script>
@endsection
