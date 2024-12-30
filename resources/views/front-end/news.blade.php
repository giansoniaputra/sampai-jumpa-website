@extends('front-end.layouts.main')
@section('container')
<section class="module">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h2>{{ $judul }}</h2>
                <hr>
                <div class="row post-masonry post-columns">
                    @if(count($posts) > 0)
                    @foreach($posts as $post)
                    <div class="col-md-6 col-lg-6">
                        <div class="post">
                            <div class="post-thumbnail"><a href="/news/{{ $post->slug }}"><img src="{{ ($post->image != null) ? '/storage/'.$post->image : 'https://source.unsplash.com/random/800x600/?news' }}" alt="Blog-post Thumbnail" /></a></div>
                            <div class="post-header font-alt">
                                <h2 class="post-title"><a href="/news/{{ $post->slug }}">{{ $post->title }}</a></h2>
                                <div class="post-meta">By&nbsp;<a href="javascript:;">{{ $post->author }}</a>&nbsp;| {{ tanggal_hari(date('Y-m-d',strtotime($post->created_at))) }} {{ date("h:i", strtotime($post->created_at)) }} | <a href="/news?category={{ $post->uuid }}">{{ $post->name }}
                                </div>
                            </div>
                            <div class="post-entry">
                                <?= $post->excerpt; ?>
                            </div>
                            <div class="post-more"><a class="more-link" href="/news/{{ $post->slug }}">Read more</a></div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p>Tidak Ada Postingan!</p>
                    @endif
                </div>
                @if(isset($category))
                <div class="pagination font-alt">
                    @if(isset($page))
                    @if($page - 1 == 1)
                    <a href="/news?category={{ $category }}"><i class="fa fa-angle-left"></i></a>
                    @else
                    <a href="/news?page={{ $page - 1 }}&category={{ $category }}"><i class="fa fa-angle-left"></i></a>
                    @endif
                    @else
                    <a href="javascript:;"><i class="fa fa-angle-left"></i></a>
                    @endif
                    @if($halaman > 0)
                    @for ($i = 1; $i <= $halaman; $i++) @if($i==1) <a class="{{ (isset($page) && $page == 1 || !isset($page)) ? 'active' : '' }}" href="/news?category={{ $category }}">{{ $i }}</a>
                        @else
                        <a class="{{ (isset($page) && $page == $i) ? 'active' : '' }}" href="/news?page={{ $i }}&category={{ $category }}">{{ $i }}</a>
                        @endif
                        @endfor
                        @endif
                        @if(isset($page))
                        @if($page == $halaman)
                        <a href="javascript:;"><i class="fa fa-angle-right"></i></a>
                        @else
                        <a href="/news?page={{ $page + 1 }}&category={{ $category }}"><i class="fa fa-angle-right"></i></a>
                        @endif
                        @else
                        @if($halaman > 1)
                        <a href="/news?page=2&category={{ $category }}"><i class="fa fa-angle-right"></i></a>
                        @else
                        <a href="javascript:;"><i class="fa fa-angle-right"></i></a>
                        @endif
                        @endif
                </div>
                @elseif(isset($search))
                <div class="pagination font-alt">
                    @if(isset($page))
                    @if($page - 1 == 1)
                    <a href="/news?search={{ $search }}"><i class="fa fa-angle-left"></i></a>
                    @else
                    <a href="/news?page={{ $page - 1 }}&search={{ $search }}"><i class="fa fa-angle-left"></i></a>
                    @endif
                    @else
                    <a href="javascript:;"><i class="fa fa-angle-left"></i></a>
                    @endif
                    @if($halaman > 0)
                    @for ($i = 1; $i <= $halaman; $i++) @if($i==1) <a class="{{ (isset($page) && $page == 1 || !isset($page)) ? 'active' : '' }}" href="/news?search={{ $search }}">{{ $i }}</a>
                        @else
                        <a class="{{ (isset($page) && $page == $i) ? 'active' : '' }}" href="/news?page={{ $i }}&search={{ $search }}">{{ $i }}</a>
                        @endif
                        @endfor
                        @endif
                        @if(isset($page))
                        @if($page == $halaman)
                        <a href="javascript:;"><i class="fa fa-angle-right"></i></a>
                        @else
                        <a href="/news?page={{ $page + 1 }}&search={{ $search }}"><i class="fa fa-angle-right"></i></a>
                        @endif
                        @else
                        @if($halaman > 1)
                        <a href="/news?page=2&search={{ $search }}"><i class="fa fa-angle-right"></i></a>
                        @else
                        <a href="javascript:;"><i class="fa fa-angle-right"></i></a>
                        @endif
                        @endif
                </div>
                @else
                <div class="pagination font-alt">
                    @if(isset($page))
                    @if($page - 1 == 1)
                    <a href="/news"><i class="fa fa-angle-left"></i></a>
                    @else
                    <a href="/news?page={{ $page - 1 }}"><i class="fa fa-angle-left"></i></a>
                    @endif
                    @else
                    <a href="javascript:;"><i class="fa fa-angle-left"></i></a>
                    @endif
                    @if($halaman > 0)
                    @for ($i = 1; $i <= $halaman; $i++) @if($i==1) <a class="{{ (isset($page) && $page == 1 || !isset($page)) ? 'active' : '' }}" href="/news">{{ $i }}</a>
                        @else
                        <a class="{{ (isset($page) && $page == $i) ? 'active' : '' }}" href="/news?page={{ $i }}">{{ $i }}</a>
                        @endif
                        @endfor
                        @endif
                        @if(isset($page))
                        @if($page == $halaman)
                        <a href="javascript:;"><i class="fa fa-angle-right"></i></a>
                        @else
                        <a href="/news?page={{ $page + 1 }}"><i class="fa fa-angle-right"></i></a>
                        @endif
                        @else
                        @if($halaman > 1)
                        <a href="/news?page=2"><i class="fa fa-angle-right"></i></a>
                        @else
                        <a href="javascript:;"><i class="fa fa-angle-right"></i></a>
                        @endif
                        @endif
                </div>

                @endif
            </div>
            <div class="col-sm-4 col-md-3 col-md-offset-1 sidebar">
                <div class="widget">
                    <form role="form" action="/news">
                        <div class="search-box">
                            <input class="form-control" name="search" type="text" placeholder="Search..." / value="{{ request('search') }}">
                            <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <div class="widget">
                    <h5 class="widget-title font-alt">Blog Categories</h5>
                    <ul class="icon-list">
                        <li><a href="/news">All News</a></li>
                        @foreach ($categories as $category)
                        @if(isset($page))
                        <li><a href="/news?category={{ $category->uuid }}">{{ $category->name }}</a></li>
                        @else
                        <li><a href="/news?category={{ $category->uuid }}">{{ $category->name }}</a></li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                <div class="widget">
                    <h5 class="widget-title font-alt">Popular Posts</h5>
                    <ul class="widget-posts">
                        @foreach ($populars as $row)
                        @if($row->category->name != 'Zona Integrasi')
                        <li class="clearfix">
                            <div class="widget-posts-image"><a href="/news/{{ $row->slug }}"><img src="{{ ($row->image != null) ? '/storage/'.$row->image : 'https://source.unsplash.com/random/800x600/?news' }}" alt="Post Thumbnail" /></a></div>
                            <div class="widget-posts-body">
                                <div class="widget-posts-title"><a href="/news/{{ $row->slug }}">{{ $row->title }}</a></div>
                                <div class="widget-posts-meta">{{ tanggal_hari(date('Y-m-d',strtotime($row->created_at)))}}</div>
                            </div>
                        </li>
                        @endif
                        @endforeach
                    </ul>
                </div>
                {{-- <div class="widget">
                    <h5 class="widget-title font-alt">Tag</h5>
                    <div class="tags font-serif"><a href="#" rel="tag">Blog</a><a href="#" rel="tag">Photo</a><a href="#" rel="tag">Video</a><a href="#" rel="tag">Image</a><a href="#" rel="tag">Minimal</a><a href="#" rel="tag">Post</a><a href="#" rel="tag">Theme</a><a href="#" rel="tag">Ideas</a><a href="#" rel="tag">Tags</a><a href="#" rel="tag">Bootstrap</a><a href="#" rel="tag">Popular</a><a href="#" rel="tag">English</a>
                    </div>
                </div> --}}
                <div class="widget">
                    <h5 class="widget-title font-alt">Text</h5>The languages only differ in their grammar, their pronunciation and their most common words. Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators.
                </div>
                <div class="widget">
                    <h5 class="widget-title font-alt">Recent Comments</h5>
                    <ul class="icon-list">
                        <li>Maria on <a href="#">Designer Desk Essentials</a></li>
                        <li>John on <a href="#">Realistic Business Card Mockup</a></li>
                        <li>Andy on <a href="#">Eco bag Mockup</a></li>
                        <li>Jack on <a href="#">Bottle Mockup</a></li>
                        <li>Mark on <a href="#">Our trip to the Alps</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
