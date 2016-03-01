<div class="ajaxPaginateIndex">
    @foreach($performer as $item)
        <a class="btn btn-primary my_btn"
           href="/performers/{{$item->title}}">
            <p class="computer-title">
                {{$item->title}}
            </p>

            <p class="phone-title" style="display: none; float: left;">
                {!! mb_substr(strip_tags($item->title),0 , 15)!!}...
            </p>
            <span class="songIconCount">
                <i class="fa fa-eye"></i>
                {{$item->count_views_performer}}
                <i class="fa fa-music"></i>
                {!! count($item->song) !!}
                @if(!empty($item->video))
                    <i class="fa fa-youtube-play"></i>
                @endif
            </span>
        </a>
    @endforeach
</div>
<div class="ajaxPaginatesIndex">
    @include('partials.paginate', ['pager'=>$performer])
</div>

