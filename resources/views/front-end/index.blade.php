<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="/assets-ucapan/css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Pacifico&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400;500;600&family=Great+Vibes&family=Pacifico&display=swap"
        rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Abel&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.all.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.11.0/dist/sweetalert2.min.css
" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- Feather Icon -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script src=""></script>

    <title>Thank You Teh Tania & Teh Rina</title>
</head>

<body>
    <i id="pause" data-feather="pause-circle" class="text-white" style="
                position: fixed;
                left: 10px;
                border-radius: 50%;
                bottom: 100px;
                background-color: rgba(59, 72, 109, 0.8);
                z-index: 100;
            "></i>
    <i id="play" data-feather="play-circle" class="text-white d-none" style="
                position: fixed;
                left: 10px;
                border-radius: 50%;
                bottom: 100px;
                background-color: rgba(59, 72, 109, 0.8);
                z-index: 100;
            "></i>
    <div class="container-fluid d-flex justify-content-center pt-4" id="background">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 pt-5">
                <p class="happy text-center" style="padding: 0">
                    Sampai Jumpa
                </p>
            </div>
            <div id="kerangka" class="d-flex justify-content-center">
                <div class="col-sm-6" id="photo">
                    <!-- <img src="/assets-ucapan/img/bintang.png" class="/assets-ucapan/img-fluid love" alt="..." width="200vh" /> -->
                    <img src="/assets-ucapan/img/tania.jpg" class="/assets-ucapan/img-fluid foto-bayangan" alt="..." />
                    <img src="/assets-ucapan/img/rina.jpg" class="/assets-ucapan/img-fluid foto-sampul" alt="..." />
                    <img src="/assets-ucapan/img/bintang.png" class="/assets-ucapan/img-fluid foto-bintang" alt="..." />
                    <p class="nama" style="font-size:2em">Rina & Tania</p>
                </div>
            </div>
            <div class="col-sm-12">
                <p class="fs-6 text-dark text-end pe-4 wish" style="font-family: 'Abel', sans-serif">
                    See You <br />
                    On Top
                </p>
            </div>
        </div>
        <img src="/assets-ucapan/img/awan-start.png" alt="" class="awan-start" />
        <img src="/assets-ucapan/img/awan-end.png" alt="" class="awan-end" />
        <img src="/assets-ucapan/img/kupu-kupu.png" alt="" class="kupu-kupu" />
        <img src="/assets-ucapan/img/kupu-kupu.png" alt="" class="kupu-kupu2" />
    </div>
    <div id="navigasi" class="d-none">
        <div class="position-absolute bottom-0 start-50 translate-middle-x mb-4">
            <button class="btn border-0 d-none" id="previous">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                    class="bi bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                </svg>
            </button>
            <button class="btn border-0 next-1" id="next">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                    class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z" />
                </svg>
            </button>
        </div>
    </div>
    <!-- new -->
    <div class="container-fluid d-flex justify-content-center pt-4" id="background">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12 pt-5">
                <p class="font-vibes text-center terimakasih" style="padding: 0">
                    Terimakasih
                </p>
                <p class="fs-5 text-dark text-center ps-4 pe-4 ucapan_t"
                    style="font-family: 'Abel', sans-serif;padding-top:10vh;opacity:0;">
                    "Hari ini adalah hari yang berat karena kalian akan pergi. Terima kasih atas semua kebersamaan dan
                    kenangan indah yang sudah kalian bagi bersama.

                    Kami akan selalu mendukung keputusan kalian menuju perjalanan baru dan yakin kalian akan sukses di
                    sana. Jangan
                    lupakan kami dan semua cerita kita di sini ya. Semoga kita bisa bertemu lagi di lain waktu.

                    Selamat dan sukses selalu!"
                </p>
            </div>
        </div>
        <img src="/assets-ucapan/img/awan-start.png" alt="" class="awan-start" />
        <img src="/assets-ucapan/img/awan-end.png" alt="" class="awan-end" />
        <img src="/assets-ucapan/img/kupu-kupu.png" alt="" class="kupu-kupu" />
        <img src="/assets-ucapan/img/kupu-kupu.png" alt="" class="kupu-kupu2" />
    </div>
    <link rel="stylesheet" href="/assets-ucapan/carosel/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets-ucapan/carosel/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
    <link rel="stylesheet" href="/assets-ucapan/carosel/css/style.css">
    <section class="ftco-section" id="background">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <p class="mb-5 font-vibes" style="font-size: 4em;" id="caros">Ucapan</p>
                </div>
                <div class="col-sm-12">
                    <div class="featured-carousel owl-carousel">
                        @foreach ($pesan as $row)
                        <div class="item">
                            <div class="work">
                                <div class="img d-flex align-items-end justify-content-center"
                                    style="background-image: url(storage/{{ $row->photo }});">
                                    <div class="text w-100">
                                        <span class="cat">{{ $row->nama }}</span>
                                        <h5><a href="#">{{ $row->status }}</a></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="/assets-ucapan/carosel/js/jquery.min.js"></script>
    <script src="/assets-ucapan/carosel/js/popper.js"></script>
    <script src="/assets-ucapan/carosel/js/bootstrap.min.js"></script>
    <script src="/assets-ucapan/carosel/js/owl.carousel.min.js"></script>
    <script src="/assets-ucapan/carosel/js/main.js"></script>
    <img src="/assets-ucapan/img/awan-start.png" alt="" class="awan-start" />
    <img src="/assets-ucapan/img/awan-end.png" alt="" class="awan-end" />
    <img src="/assets-ucapan/img/kupu-kupu.png" alt="" class="kupu-kupu" />
    <img src="/assets-ucapan/img/kupu-kupu.png" alt="" class="kupu-kupu2" />
    <div class="container-fluid d-flex justify-content-center align-items-center" id="background">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-12">
                <p class="happy text-center" style="padding: 0">
                    Terimakasih dan Semoga Sukses Selalu
                </p>
            </div>
        </div>
        <img src="/assets-ucapan/img/awan-start.png" alt="" class="awan-start" />
        <img src="/assets-ucapan/img/awan-end.png" alt="" class="awan-end" />
        <img src="/assets-ucapan/img/kupu-kupu.png" alt="" class="kupu-kupu" />
        <img src="/assets-ucapan/img/kupu-kupu.png" alt="" class="kupu-kupu2" />
    </div>
    <!-- new -->
    <audio id="audio" src="/assets-ucapan/music/SampaiJumpa.mp3" autoplay></audio>
    <!-- Feater Icon -->
    <script>
        feather.replace();
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#audio")[0].autoplay = true
            $("#pause").on("click", function () {
                $("#audio")[0].pause();
                $("#pause").addClass("d-none");
                $("#play").removeClass("d-none");
            });
            $("#play").on("click", function () {
                $("#audio")[0].play();
                $("#play").addClass("d-none");
                $("#pause").removeClass("d-none");
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
    <script src="/assets-ucapan/js/script.js"></script>
</body>

</html>
