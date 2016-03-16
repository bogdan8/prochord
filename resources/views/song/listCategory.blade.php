@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/">{{trans('translation.Головна')}}</a></li>
                    <li><a href="/songs">{{trans('translation.Пісні')}}</a></li>
                    <li>{{trans('translation.Категорії')}}</li>
                </ol>
            </div>
            @include("song.sort.top_cat")
        </div>
    </div>
    <div class="ajaxPaginateIndex" style="margin-top: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{trans('translation.Категорії')}}</h3>
                        </div>
                        <div class="panel-body">
                            @foreach($category as $item)
                                @if($url_lang === 'uk')
                                    <a class="btn btn-primary my_btn"
                                       href="/song/{{$item->title_eng}}">
                                        <p class="computer-title">
                                            {{$item->title}}
                                        </p>

                                        <p class="phone-title" style="display: none; float: left;">
                                            {!! mb_substr(strip_tags($item->title),0 , 15)!!}...
                                        </p>
                                        <span class="songIconCount">
                                            <i class="fa fa-eye"></i>
                                            {{$item->count_views_cat}}
                                            <i class="fa fa-music"></i>
                                            {!! count($item->song) !!}
                                        </span>
                                    </a>
                                @elseif($url_lang === 'ru')
                                    <a class="btn btn-primary my_btn"
                                       href="/song/{{$item->title_eng}}">
                                        <p class="computer-title">
                                            {{$item->title_rus}}
                                        </p>

                                        <p class="phone-title" style="display: none; float: left;">
                                            {!! mb_substr(strip_tags($item->title_rus),0 , 15)!!}...
                                        </p>
                                        <span class="songIconCount">
                                            <i class="fa fa-eye"></i>
                                            {{$item->count_views_cat}}
                                            <i class="fa fa-music"></i>
                                            {!! count($item->song) !!}
                                        </span>
                                    </a>
                                @elseif($url_lang === 'en')
                                    <a class="btn btn-primary my_btn"
                                       href="/song/{{$item->title_eng}}">
                                        <p class="computer-title">
                                            {{$item->title_eng}}
                                        </p>

                                        <p class="phone-title" style="display: none; float: left;">
                                            {!! mb_substr(strip_tags($item->title_eng),0 , 15)!!}...
                                        </p>
                                        <span class="songIconCount">
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
                @include('song.listCategoryRight')
            </div>
            <!-- Comments -->
            @include('song.comments.category')
            <!-- End comments -->
        </div>
@stop