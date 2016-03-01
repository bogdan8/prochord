<div class="ajaxPaginateIndex">
    @foreach($listSongs as $item)
        <a class="btn btn-primary my_btn"
           href="/songs/{{$item->slug}}">
            <p class="computer-title">
                {{$item->title}}
            </p>
            <p class="phone-title" style="display: none; float: left;">
                {!! mb_substr(strip_tags($item->title),0 , 13)!!}...
            </p>
            <span class="songIconCount">
                <i class="fa fa-eye"></i>
                {{$item->count_views_song}}
                <i class="fa fa-comments-o"></i>
                {!! count($item->songComment) !!}
                @if(!empty($item->video))
                    <i class="fa fa-youtube-play"></i>
                @endif
            </span>
        </a>
    @endforeach
</div>
<div class="ajaxPaginatesIndex">
    @include('partials.paginate', ['pager'=>$listSongs])
</div>