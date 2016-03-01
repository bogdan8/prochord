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
            @include("song.top_cat")
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
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">{{trans('translation.Коментарі')}}
                        <span>
                             <i class="fa fa-comments-o"></i> {{count($getComments)}}
                        </span>
                    </h2>

                    <h3 class="section-subheading">{{trans('translation.Тут_відображуються_ваші_коментарі')}}</h3>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @foreach($getComments as $item)
                        <div class="panel panel-success" style="border-radius: 10px;">
                            <div class="panel-heading"
                                 style="border-radius: 10px 10px 0px 0px;background-color: #603d1b;">
                                <strong>{!! trans('translation.Імя') !!} :</strong>

                                <h3 class="panel-title"><p>{!! $item->name !!}</p></h3>
                            </div>
                            <div class="panel-body">
                                <strong>{!! trans('translation.Дата') !!} :</strong>

                                <p>{!! $item->date !!}</p>
                                <strong>{!! trans('translation.Текст') !!} :</strong>

                                <p>{!! $item->body !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">{{trans('translation.Додати_коментар')}}</h2>

                    <h3 class="section-subheading">{{trans('translation.Тут_ви_можете_додати_свій_коментарій')}}</h3>
                </div>
                <div class="alert alert-danger info">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{trans('translation.Помилка')}}</strong>
                    <ul></ul>
                </div>
                <div class="alert alert-success infoSuccess">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>{{trans('translation.Успішно')}}</strong>
                    <ul></ul>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    {!! Form::open(['method'=>'POST' , 'id'=>'form']) !!}<br/>
                    {!! Form::label(trans('translation.Ваше_імя').' *:') !!}
                    {!! Form::text('name',null,['id'=>'name','placeholder'=>trans('translation.Ваше_імя').' :','required','class'=>'form-control'],Input::old('name')) !!}
                    <br/>
                    {!! Form::label(trans('translation.Ваш_email').' *:') !!}
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">@</span>
                        {!! Form::text('email',null,['id'=>'email','placeholder'=>trans('translation.Ваш_email').' :','required','class'=>'form-control'],Input::old('email')) !!}
                    </div>
                    <br/>
                    {!! Form::label(trans('translation.Ваш_текст').' *:') !!}
                    {!! Form::textarea('body',null,['id'=>'body','placeholder'=>trans('translation.Ваш_текст').' :','required', 'class'=>'form-control','rows'=>'5'],Input::old('body')) !!}
                    <br/>
                    {!! Form::submit(trans('translation.Коментувати'),['class'=>'btn btn-success']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop