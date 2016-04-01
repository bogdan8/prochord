@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/">{{trans('translation.Головна')}}</a></li>
                    <li>{{trans('translation.Виконавці')}}</li>
                </ol>
            </div>
            @include("song.sort.top_performer")
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="panel panel-success" style="margin-top: 20px;">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('translation.Виконавці')}}</h3>
                    </div>
                    <div class="panel-body">
                        <div class="ajaxPaginateIndex">
                            @foreach($performer as $item)
                                <a class="btn btn-primary my_btn"
                                   href="/performers/{{$item->slug}}">
                                    @if(!empty($item->image))
                                        <img class="a-img-list-performer"
                                             src="/uploads/performer/{{$item->image}}">
                                    @endif
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
                                        </span>
                                </a>
                            @endforeach
                            <div class="ajaxPaginatesIndex">
                                @include('partials.paginate', ['pager'=>$performer])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="panel panel-success" style="margin-top: 20px;">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('translation.Найбільш_переглянуті_виконавці')}}</h3>
                    </div>
                    <div class="panel-body">
                        @foreach($most_popular as $item)
                            <a class="btn btn-primary my_btn"
                               href="/performers/{{$item->slug}}">
                                @if(!empty($item->image))
                                    <img class="a-img-list-performer"
                                         src="/uploads/performer/{{$item->image}}">
                                @endif
                                <p class="p-title-list-performer">
                                    {!! mb_substr(strip_tags($item->title),0 , 15)!!}...
                                </p>
                                <span class="songIconCountRight">
                                    <i class="fa fa-eye"></i>
                                    {{$item->count_views_performer}}
                                    <i class="fa fa-music"></i>
                                    {!! count($item->song) !!}
                                </span>
                            </a>

                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('translation.Остані_додані_виконавці')}}</h3>
                    </div>
                    <div class="panel-body">
                        @foreach($last_add as $item)
                            <a class="btn btn-primary my_btn"
                               href="/performers/{{$item->slug}}">
                                @if(!empty($item->image))
                                    <img class="a-img-list-performer"
                                         src="/uploads/performer/{{$item->image}}">
                                @endif
                                <p class="p-title-list-performer">
                                    {!! mb_substr(strip_tags($item->title),0 , 15)!!}...
                                </p>
                                    <span class="songIconCountRight">
                                       <i class="fa fa-eye"></i>
                                        {{$item->count_views_performer}}
                                        <i class="fa fa-music"></i>
                                        {!! count($item->song) !!}
                                    </span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop