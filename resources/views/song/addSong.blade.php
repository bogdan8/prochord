@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/">{{trans('translation.Головна')}}</a></li>
                    <li>{{trans('translation.Додати_пісню')}}</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-0">
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="panel panel-success" style="margin-top: 20px;">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <p>{{trans('translation.Тут_ви_можете_додати_пісню')}}</p>
                        </h3>
                    </div>
                    <div class="panel-body">
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
                            {!! Form::open(['method'=>'POST' , 'id'=>'formAddSong']) !!}<br/>
                            {!! Form::label(trans("translation.Ваше_ім'я").' *:') !!}
                            {!! Form::text('you_name',null,['id'=>'you_name','placeholder'=>trans("translation.Ваше_ім'я").' :','required','class'=>'form-control'],Input::old('name')) !!}
                            <br/>
                            {!! Form::label(trans('translation.Назва_пісні').' *:') !!}
                            {!! Form::text('name',null,['id'=>'name','placeholder'=>trans('translation.Назва_пісні').' :','required','class'=>'form-control'],Input::old('name')) !!}
                            <br/>
                            {!! Form::label(trans('translation.Музика_та_слова').' *:') !!}
                            {!! Form::text('description',null,['id'=>'description','placeholder'=>trans('translation.Музика_та_слова').' :','required','class'=>'form-control'],Input::old('description')) !!}
                            <br/>
                            {!! Form::label(trans('translation.Виберіть_виконавця').' *:') !!}
                            <div class="btn-group bootstrap-select" style="margin-top: 0px;">
                                <select name="performer" id="performer" class="form-control">
                                    <option disabled>{{trans('translation.Виконавці')}}:</option>
                                    @foreach($performer as $item)
                                        <option value="{{$item->id}}">{{$item->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br/>
                            {!! Form::textarea('active',0,['id'=>'active' , 'style'=>'display:none']) !!}
                            <br/>
                            {!! Form::label(trans('translation.Виберіть_категорію').' *:') !!}
                            <div class="btn-group bootstrap-select" style="margin-top: 0px;">
                                <select name="category" id="category" class="form-control">
                                    <option disabled>{{trans('translation.Категорії')}}:</option>
                                    @foreach($category as $item)
                                        @if($url_lang == 'uk')
                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                        @elseif($url_lang == 'ru')
                                            <option value="{{$item->id}}">{{$item->title_rus}}</option>
                                        @elseif($url_lang == 'en')
                                            <option value="{{$item->id}}">{{$item->title_eng}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <br/>
                            <br/>
                            {!! Form::label(trans('translation.Як_грати').' *:') !!}
                            {!! Form::textarea('tabulature',null,['id'=>'tabulature','placeholder'=>trans('translation.Як_грати').' :','required','class'=>'form-control','rows'=>'4'],Input::old('tabulature')) !!}
                            <br/>
                            {!! Form::label(trans('translation.Ваш_текст').' *:') !!}
                            {!! Form::textarea('body',null,['id'=>'body','placeholder'=>trans('translation.Ваш_текст').' :','required', 'class'=>'form-control','rows'=>'5'],Input::old('body')) !!}
                            <br/>
                            {!! Form::submit(trans('translation.Додати'),['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop