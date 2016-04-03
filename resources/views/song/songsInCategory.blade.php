@extends('layouts.default')

@section('content')
    @if($url_lang == 'uk')
        <title>{{$get->title}}</title>
    @elseif($url_lang == 'ru')
        <title>{{$get->title_rus}}</title>
    @elseif($url_lang == 'en')
        <title>{{$get->title_eng}}</title>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/">{{trans('translation.Головна')}}</a></li>
                    <li><a href="/songs">{{trans('translation.Пісні')}}</a></li>
                    <li><a href="/categories">{{trans('translation.Категорії')}}</a></li>
                    @if($url_lang == 'uk')
                        <li>{{$get->title}}</li>
                    @elseif($url_lang == 'ru')
                        <li>{{$get->title_rus}}</li>
                    @elseif($url_lang == 'en')
                        <li>{{$get->title_eng}}</li>
                    @endif
                </ol>
            </div>
            <div> @include("song.sort.top_song")</div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="panel panel-success" style="margin-top: 20px;">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            @if($url_lang == 'uk')
                                {{$get->title}}
                            @elseif($url_lang == 'ru')
                                {{$get->title_rus}}
                            @elseif($url_lang == 'en')
                                {{$get->title_eng}}
                            @endif
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="ajaxPaginateIndex">
                            @foreach($Song as $item)
                                <a class="btn btn-primary my_btn"
                                   href="/song/{{$get->title_eng}}/{{$item->slug}}">
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
                            <div class="ajaxPaginatesIndex">
                                @include('partials.paginate', ['pager'=>$Song])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- right panel -->
            @include('song.rightPanel.songsInCategory')
                    <!-- end right panel -->
        </div>
    </div>
@stop