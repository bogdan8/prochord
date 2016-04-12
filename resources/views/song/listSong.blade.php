@extends('layouts.default')

@section('content')
    @if(isset($letter))
        <title>{!! trans('translation.Сортувати').' '.$letter !!}</title>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/">{{trans('translation.Головна')}}</a></li>
                    <li>{{trans('translation.Пісні')}}</li>
                </ol>
            </div>
            <div> @include("song.sort.top_song")</div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="panel panel-success" style="margin-top: 20px;">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            {{trans('translation.Всі_пісні')}}
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="ajaxPaginateIndex">
                            @foreach($listSongs as $item)
                                <a class="btn btn-primary my_btn"
                                   href="/songs/{{$item->slug}}">
                                    <p class="computer-title">
                                        {{$item->title}} -
                                    @foreach($performer as $perf)
                                            @if($item->performer_id == $perf->id)
                                                {{$perf->title}}
                                            @endif
                                        @endforeach
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
                                        @if(!empty($item->media_document))
                                            <i class="fa fa-file"></i>
                                        @endif
                                    </span>
                                </a>
                            @endforeach

                            <div class="ajaxPaginatesIndex">
                                @include('partials.paginate', ['pager'=>$listSongs])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- right panel -->
            @include('song.rightPanel.listSong')
                    <!-- end right panel -->

        </div>
    </div>
@stop