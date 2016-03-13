@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/">{{trans('translation.Головна')}}</a></li>
                    <li>{{trans('translation.Уроки')}}</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('translation.Уроки')}}</h3>
                    </div>
                    <div class="panel-body">
                        @foreach($lessons as $item)
                            @if($url_lang === 'uk')
                                <a class="btn btn-success my_btn index-lessons-btn"
                                   href="/lessons/{{$item->id}}">
                                    <p class="computer-title">
                                        {{trans('translation.Урок')}} №{{$item->number_lesson}}:
                                        {{$item->title}}
                                    </p>
                                    <p class="phone-title" style="float: left;">
                                        {{trans('translation.Урок')}} №{{$item->number_lesson}}:
                                        <?php
                                        $str=strpos($item->title, " ");
                                        $title = substr($item->title, 0 , $str);
                                        echo $title. '...';
                                        ?>
                                    </p>
                                    <span class="songIconCount">
                                        <i class="fa fa-eye"></i>
                                        {{$item->viewed_lesson}}
                                    </span>
                                </a>
                            @elseif($url_lang === 'ru')
                                <a class="btn btn-success my_btn index-lessons-btn"
                                   href="/lessons/{{$item->id}}">
                                    <p class="computer-title">
                                        {{trans('translation.Урок')}} №{{$item->number_lesson}}:
                                        {{$item->title_rus}}
                                    </p>
                                    <p class="phone-title" style="float: left;">
                                        {{trans('translation.Урок')}} №{{$item->number_lesson}}:
                                        <?php
                                        $str=strpos($item->title_rus, " ");
                                        $title = substr($item->title_rus, 0 , $str);
                                        echo $title. '...';
                                        ?>
                                    </p>
                                    <span class="songIconCount">
                                        <i class="fa fa-eye"></i>
                                        {{$item->viewed_lesson}}
                                    </span>
                                </a>
                            @elseif($url_lang === 'en')
                                <a class="btn btn-success my_btn index-lessons-btn"
                                   href="/lessons/{{$item->id}}">
                                    <p class="computer-title">
                                        {{trans('translation.Урок')}} №{{$item->number_lesson}}:
                                        {{$item->title_eng}}
                                    </p>
                                    <p class="phone-title" style="float: left;">
                                        {{trans('translation.Урок')}} №{{$item->number_lesson}}:
                                        <?php
                                        $str=strpos($item->title_eng, " ");
                                        $title = substr($item->title_eng, 0 , $str);
                                        echo $title. '...';
                                        ?>
                                    </p>
                                    <span class="songIconCount">
                                        <i class="fa fa-eye"></i>
                                        {{$item->viewed_lesson}}
                                    </span>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop