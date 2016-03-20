<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">{{trans('translation.Найбільш_переглянуті_категорії')}}</h3>
        </div>
        <div class="panel-body">
            @foreach($most_popular as $item)
                @if($url_lang == 'uk')
                    <a class="btn btn-primary my_btn"
                       href="/song/{{$item->title_eng}}">
                        <p style="float: left;">
                            {!! mb_substr(strip_tags($item->title),0 , 15)!!}...
                        </p>
                            <span class="songIconCountRight">
                                <i class="fa fa-eye"></i>
                                {{$item->count_views_cat}}
                                <i class="fa fa-music"></i>
                                {!! count($item->song) !!}
                            </span>
                    </a>
                @elseif($url_lang == 'ru')
                    <a class="btn btn-primary my_btn"
                       href="/song/{{$item->title_eng}}">
                        <p style="float: left;">
                            {!! mb_substr(strip_tags($item->title_rus),0 , 15)!!}...
                        </p>
                            <span class="songIconCountRight">
                                <i class="fa fa-eye"></i>
                                {{$item->count_views_cat}}
                                <i class="fa fa-music"></i>
                                {!! count($item->song) !!}
                            </span>
                    </a>
                @elseif($url_lang == 'en')
                    <a class="btn btn-primary my_btn"
                       href="/song/{{$item->title_eng}}">
                        <p style="float: left;">
                            {!! mb_substr(strip_tags($item->title_eng),0 , 15)!!}...
                        </p>
                            <span class="songIconCountRight">
                                <i class="fa fa-eye"></i>
                                {{$item->count_views_cat}}
                                <i class="fa fa-music"></i>
                                {!! count($item->song) !!}
                            </span>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">{{trans('translation.Остані_додані_категорії')}}</h3>
        </div>
        <div class="panel-body">
            @foreach($last_add as $item)
                @if($url_lang == 'uk')
                    <a class="btn btn-primary my_btn"
                       href="/song/{{$item->title_eng}}">
                        <p style="float: left;">
                            {!! mb_substr(strip_tags($item->title),0 , 15)!!}...
                        </p>
                            <span class="songIconCountRight">
                                <i class="fa fa-eye"></i>
                                {{$item->count_views_cat}}
                                <i class="fa fa-music"></i>
                                {!! count($item->song) !!}
                            </span>
                    </a>
                @elseif($url_lang == 'ru')
                    <a class="btn btn-primary my_btn"
                       href="/song/{{$item->title_eng}}">
                        <p style="float: left;">
                            {!! mb_substr(strip_tags($item->title_rus),0 , 15)!!}...
                        </p>
                            <span class="songIconCountRight">
                                <i class="fa fa-eye"></i>
                                {{$item->count_views_cat}}
                                <i class="fa fa-music"></i>
                                {!! count($item->song) !!}
                            </span>
                    </a>
                @elseif($url_lang == 'en')
                    <a class="btn btn-primary my_btn"
                       href="/song/{{$item->title_eng}}">
                        <p style="float: left;">
                            {!! mb_substr(strip_tags($item->title_eng),0 , 15)!!}...
                        </p>
                    <span class="songIconCountRight">
                       <i class="fa fa-eye"></i>
                        {{$item->count_views_cat}}
                        <i class="fa fa-music"></i>
                        {!! count($item->song) !!}
                    </span>
                    </a>
                @endif
            @endforeach
        </div>
    </div>
</div>
@include('song.voting')