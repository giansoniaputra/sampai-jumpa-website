@extends('front-end.layouts.main')
@section('gambar_sampul')
<!-- Open Graph Metadata -->
<meta property="og:title" content="{{ $post->title }}" />
<meta property="og:description" content="{{ $post->excerpt }}" />
<meta property="og:image" content="{{ url('/storage/'.$post->image) }}" />
<meta property="og:url" content="{{ url('/news/'.$post->slug) }}" />

<!-- Twitter Card Metadata -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="{{ $post->title }}" />
<meta name="twitter:description" content="{{ $post->excerpt }}" />
<meta name="twitter:image" content="{{ url('/storage/'.$post->image) }}" />

<!-- Generic Meta Tags -->
<meta name="description" content="{{ $post->excerpt }}" />
<meta name="image" content="{{ url('/storage/'.$post->image) }}" />

<!-- Additional SEO tags -->
<meta property="og:type" content="{{ $post->category->name }}" />
<meta property="og:site_name" content="{{ url()->current() }}" />
@endsection
@section('container')
<section class="module-small">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="post">
                    <div class="post-thumbnail"><img src="{{ ($post->image != null) ? '/storage/'.$post->image : 'https://source.unsplash.com/random/800x600/?news' }}" alt="Blog Featured Image" /></div>
                    <div class="post-header font-alt">
                        <h1 class="post-title">{{ $post->title }}</h1>
                        <div class="post-meta">By&nbsp;<a href="javascript:;">{{ $post->author }}</a>| {{ tanggal_hari(date('Y-m-d',strtotime($post->created_at))) }} {{ date("h:i", strtotime($post->created_at)) }} | {{ commnet_count($post->id) }} Comments | <a href="/news?category={{ $post->category->uuid }}">{{ $post->category->name }}, </a>
                        </div>
                    </div>
                    <div class="post-entry">
                        <?= $post->body; ?>
                    </div>
                </div>
                <div class="comments">
                    <h4 class="comment-title font-alt">There are comments</h4>
                    <div class="comment clearfix" style="height:500px; overflow-y:scroll " id="element-comment">

                    </div>
                </div>
                <div class="comment-form">
                    <h4 class="comment-form-title font-alt">Add your comment</h4>
                    <form id="post-comment" action="javascript:;">
                        @csrf
                        <div class="form-group">
                            <label class="sr-only" for="nama">Nama</label>
                            <input class="form-control" id="nama" type="text" name="nama" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="email">Email</label>
                            <input class="form-control" id="email" type="text" name="email" placeholder="E-mail" required>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" id="comment" name="comment" rows="5" placeholder="Comment" required></textarea>
                        </div>
                        <button class="btn btn-round btn-d" type="button" id="btn-comment" data-slug="{{ $post->slug }}">Post comment</button>
                    </form>
                </div>
            </div>
            <div class="col-sm-4 col-md-3 col-md-offset-1 sidebar">
                <div class="widget">
                    <form role="form" action="/news">
                        <div class="search-box">
                            <input class="form-control" name="search" type="text" placeholder="Search..." />
                            <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="widget">
                    <h5 class="widget-title font-alt">Blog Categories</h5>
                    <ul class="icon-list">
                        <li><a href="/news">All News</a></li>
                        @foreach ($categories as $category)
                        <li><a href="/news?category={{ $category->uuid }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="widget">
                    <h5 class="widget-title font-alt">Popular Posts</h5>
                    <ul class="widget-posts">
                        @foreach ($populars as $row)
                        @if($row->category->name == 'Zona Integrasi')
                        <li class="clearfix">
                            <div class="widget-posts-image"><a href="/news/{{ $row->slug }}"><img src="{{ ($row->image != null) ? '/storage/'.$row->image : 'https://source.unsplash.com/random/800x600/?news' }}" alt="Post Thumbnail" /></a></div>
                            <div class="widget-posts-body">
                                <div class="widget-posts-title"><a href="/news/{{ $row->slug }}">{{ $row->title }}</a></div>
                                <div class="widget-posts-meta">{{ tanggal_hari(date('Y-m-d',strtotime($post->created_at)))}}</div>
                            </div>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="module-small bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="widget">
                    <h5 class="widget-title font-alt">Blog Categories</h5>
                    <ul class="icon-list">
                        <li><a href="/news">All News</a></li>
                        @foreach ($categories as $category)
                        <li><a href="/news?category={{ $category->uuid }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="widget">
                    <h5 class="widget-title font-alt">Popular Posts</h5>
                    <ul class="widget-posts">
                        @foreach ($populars as $row)
                        <li class="clearfix">
                            <div class="widget-posts-image"><a href="/news/{{ $row->slug }}"><img src="{{ ($row->image != null) ? '/storage/'.$row->image : 'https://source.unsplash.com/random/800x600/?news' }}" alt="Post Thumbnail" /></a></div>
                            <div class="widget-posts-body">
                                <div class="widget-posts-title"><a href="/news/{{ $row->slug }}">{{ $row->title }}</a></div>
                                <div class="widget-posts-meta">{{ tanggal_hari(date('Y-m-d',strtotime($post->created_at)))}}</div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="{{ $post->id }}" id="hidden-id">
<script src="/assets/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function() {
        let id = $("#hidden-id").val()
        let renderComment = (id) => {
            $.ajax({
                url: "/render-comment/" + id
                , type: "GET"
                , dataType: 'json'
                , success: function(response) {
                    let data = response.data
                    let element = data.map((a) => {
                        return `
                        <div class="comment-avatar"><img src="/assets/img/user2.png" alt="avatar" /></div>
                        <div class="comment-content clearfix">
                            <div class="comment-author font-alt"><a href="javascript:;">${a.nama}</a></div>
                            <div class="comment-body">
                                <p>${a.comment}</p>
                            </div>
                            <div class="comment-meta font-alt"> ${tanggal(a.created_at)}
                            </div>
                        </div>

                        `
                    })
                    $("#element-comment").html(element)
                }
            });
        }
        renderComment(id)
        $("#btn-comment").on("click", function() {
            let button = $(this)
            $(button).attr("disabled", "true");
            let slug = $(this).data("slug");
            let formdata = $('form[id="post-comment"]').serialize();
            $.ajax({
                data: formdata
                , url: "/comment-news/" + slug
                , type: "POST"
                , dataType: 'json'
                , success: function(response) {
                    $(button).removeAttr("disabled");
                    reset();
                    renderComment(response.id)
                }
            });
        })
        //KOSONGKAN SEMUA INPUTAN
        function reset() {
            let form = $('form[id="post-comment"]').serializeArray();
            form.map((a) => {
                $(`#${a.name}`).val("");
            })
        }

        let tanggal = (date) => {
            const d = new Date(date);
            let months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            return d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
        }
    });

</script>
@endsection
