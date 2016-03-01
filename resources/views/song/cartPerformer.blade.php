@extends('layouts.default')

@section('content')
    <title>{{$cartPerformer->title}}</title>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/">{{trans('translation.Головна')}}</a></li>
                    <li><a href="/performers">{{trans('translation.Виконавці')}}</a></li>
                    <li>{{$cartPerformer->title}}</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <div class="panel panel-success" style="margin-top: 20px;">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <p>{{trans('translation.Пісні')}}</p>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="ajaxPaginateIndex">
                            @foreach($getSong as $item)
                                <a class="btn btn-primary my_btn"
                                   href="/songs/{{$item->title}}">
                                    <p class="computer-title">
                                        {{$item->title}}
                                    </p>

                                    <p class="phone-title" style="display: none; float: left;">
                                        {!! mb_substr(strip_tags($item->title),0 , 15)!!}...
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
                                @include('partials.paginate', ['pager'=>$getSong])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
                <div class="panel panel-success" style="margin-top: 20px;">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <p>{!! $cartPerformer->title!!}</p>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h4 style="text-align: center;">{!! $cartPerformer->title!!}</h4>
                                <br/>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <p>
                                            @if(!empty($cartPerformer->birth))
                                                {{trans('translation.Народився_в')}}:
                                                <br/>
                                                {!! $cartPerformer->birth!!}
                                            @endif
                                            <br/>
                                            @if(!empty($cartPerformer->country))
                                                {{trans('translation.Місце_народження')}}:
                                                <br/>
                                                {!! $cartPerformer->country!!}
                                            @endif
                                            <br/>
                                            @if(!empty($cartPerformer->place))
                                                {{trans('translation.Живе_в')}}:
                                                <br/>
                                                {!! $cartPerformer->place!!}
                                            @endif
                                        </p>
                                    </div>
                                    @if(!empty($cartPerformer->image))
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <img width="100%" height="200px"
                                                 src="/uploads/performer/{{$cartPerformer->image}}">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h4 style="text-align: center;">{{trans('translation.Біографія')}}:</h4>
                                {!! $cartPerformer->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop