@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/">{{trans('translation.Головна')}}</a></li>
                    <li>{{trans('translation.Результат_пошуку')}}</li>
                </ol>
            </div>
            <div> @include("song.top_song")</div>
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
                        @foreach($search as $item)
                            <a class="btn btn-primary my_btn"
                               href="/songs/{{$item->slug}}">
                                <p>
                                    {{$item->title}}
                                </p>
                            <span class="songIconCount">
                                <i class="fa fa-eye"></i>
                                {{$item->count_views_song}}
                                <i class="fa fa-comments-o"></i>
                                {!! count($item->songComment) !!}
                            </span>
                            </a>
                        @endforeach
                        @if(!isset($item))
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-3 col-xs-3">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                                    {!! HTML::image('/image/errors/searchError.png', 'error' , ['class'=>'search-error-img']) !!}
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-3 col-xs-3">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h1 class="search-error-text">{{trans('translation.За_вашим_запитом_нічого_не_знайдено')}}</h1>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="panel panel-success" style="margin-top: 20px;">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('translation.Найбільш_переглянуті_пісні')}}</h3>
                    </div>
                    <div class="panel-body">
                        @foreach($most_popular as $item)
                            <a class="btn btn-primary my_btn"
                               href="/songs/{{$item->slug}}">
                                <p style="float: left;">
                                    {{$item->title}}
                                </p>
                            <span class="songIconCountRight">
                                <i class="fa fa-eye"></i>
                                {{$item->count_views_song}}
                                <i class="fa fa-comments-o"></i>
                                {!! count($item->songComment) !!}
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
                        @foreach($most_popular as $item)
                            <a class="btn btn-primary my_btn"
                               href="/song/{{$item->slug}}">
                                <p style="float: left;">
                                    {{$item->title}}
                                </p>
                            <span class="songIconCountRight">
                                <i class="fa fa-eye"></i>
                                {{$item->count_views_song}}
                                <i class="fa fa-comments-o"></i>
                                {!! count($item->songComment) !!}
                            </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="ajaxPaginatesIndex">
            @include('partials.paginate', ['pager'=>$search])
        </div>
    </div>
@stop