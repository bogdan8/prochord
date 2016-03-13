@extends('layouts.default')

@section('content')
    @if($url_lang === 'uk')
        <title>{!! $lessons_cart->title !!}</title>
    @elseif($url_lang === 'ru')
        <title>{!! $lessons_cart->title_rus !!}</title>
    @elseif($url_lang === 'en')
        <title>{!! $lessons_cart->title_eng !!}</title>
    @endif
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
                        <h3 class="panel-title">{{trans('translation.Урок')}} №{{$lessons_cart->number_lesson}}:
                            @if($url_lang === 'uk')
                                {{$lessons_cart->title}}
                            @elseif($url_lang === 'ru')
                                {{$lessons_cart->title_rus}}
                            @elseif($url_lang === 'en')
                                {{$lessons_cart->title_eng}}
                            @endif
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 style="text-align: center;">
                                    @if($url_lang === 'uk')
                                        {{$lessons_cart->title}}
                                    @elseif($url_lang === 'ru')
                                        {{$lessons_cart->title_rus}}
                                    @elseif($url_lang === 'en')
                                        {{$lessons_cart->title_eng}}
                                    @endif
                                </h3>
                                @if($lessons_cart->id != $countLessons)
                                    <div class="row">
                                        <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                                            <a class="btn btn-success my_btn index-lessons-btn"
                                               href="/lessons/{{$lessons_cart->id + 1}}">
                                                <p>
                                                    >> {{trans('translation.Наступний_урок')}}
                                                    №{{$lessons_cart->number_lesson + 1}}:
                                                </p>
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                                @if($url_lang === 'uk')
                                    {!! $lessons_cart->body !!}
                                @elseif($url_lang === 'ru')
                                    {!! $lessons_cart->body_rus !!}
                                @elseif($url_lang === 'en')
                                    {!! $lessons_cart->body_eng !!}
                                @endif
                            </div>
                            @if($lessons_cart->id != 1)
                                <div class="row">
                                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
                                        <a class="btn btn-success my_btn index-lessons-btn"
                                           href="/lessons/{{$lessons_cart->id - 1}}">
                                            <p>
                                                << {{trans('translation.Попередній_урок')}}
                                                №{{$lessons_cart->number_lesson - 1}}:
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Comments -->
        @include('lessons.cart_comments_section')
                <!-- End comments -->
    </div>
@stop