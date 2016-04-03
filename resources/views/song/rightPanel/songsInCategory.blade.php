<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="panel panel-success" style="margin-top: 20px;">
        <div class="panel-heading">
            <h3 class="panel-title">{{trans('translation.Найбільш_переглянуті_пісні')}}</h3>
        </div>
        <div class="panel-body">
            @foreach($most_popular as $item)
                <a class="btn btn-primary my_btn"
                   href="/song/{{$get->title_eng}}/{{$item->slug}}">
                    <p style="float: left;">
                        {!! mb_substr(strip_tags($item->title),0 , 13)!!}...
                    </p>
                        <span class="songIconCountRight">
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
    </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="float: right;">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">{{trans('translation.Остані_додані_пісні')}}</h3>
        </div>
        <div class="panel-body">
            @foreach($last_add as $item)
                <a class="btn btn-primary my_btn"
                   href="/song/{{$get->title_eng}}/{{$item->slug}}">
                    <p style="float: left;">
                        {!! mb_substr(strip_tags($item->title),0 , 13)!!}...
                    </p>
                        <span class="songIconCountRight">
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
    </div>
</div>