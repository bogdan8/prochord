@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/">{{trans('translation.Головна')}}</a></li>
                    <li>{{trans('translation.Написати_нам')}}</li>
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
                            <p>{{trans('translation.Тут_ви_можете_написати_нам')}}</p>
                        </h3>
                    </div>
                    <div class="panel-body">
                        @if(isset($errors_name))
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>{{trans('translation.Помилка')}} :</strong>
                                <ul>{{ $errors_name }}</ul>
                            </div>
                        @endif

                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>{{trans('translation.Помилка')}} :</strong>
                                @foreach ($errors->all() as $error)
                                    <ul>{{ $error }}</ul>
                                @endforeach
                            </div>
                        @endif
                        @if(isset($success))
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>{{trans('translation.Успішно')}}</strong>
                                <ul>{{trans('translation.Дякуємо_ми_розглянем_ваш_запит_якнайшвидше')}}</ul>
                            </div>
                        @endif
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            {!! Form::open(['method'=>'POST' , 'id'=>'formFeedback']) !!}<br/>
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
                            {!! Form::submit(trans('translation.Написати'),['class'=>'btn btn-primary']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Show feedback-->
        @if(!empty($feedback['0']))
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">{{trans('translation.Коментарі')}}
                        <span>
                             <i class="fa fa-comments-o"></i> {{count($feedback)}}
                        </span>
                    </h2>
                    <br/>
                </div>

                @foreach($feedback as $item)
                    @if($item->role == 1)
                        <div class="col-lg-10 col-lg-offset-2 col-md-10 col-lg-offset-2 col-sm-10 col-lg-offset-2 col-xs-12">
                            <div class="panel panel-success" style="border-radius: 10px;">
                                <div class="panel-heading feedback-panel-header">
                                    <h3 class="panel-title"><p>Admin</p></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-2  col-md-2 col-sm-2 col-xs-12">
                                            <i class="fa fa-user-secret font-image"></i>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                            <strong>{!! trans('translation.Текст') !!} :</strong>

                                            <p>{!! nl2br($item->body) !!}</p>

                                            <p><i class="fa fa-clock-o"></i> {!! $item->created_at !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-success" style="border-radius: 10px;">
                                <div class="panel-heading"
                                     style="border-radius: 10px 10px 0px 0px;background-color: #603d1b;">
                                    <strong>{{trans('translation.Імя')}}:</strong>

                                    <h3 class="panel-title"><p>{!! $item->name !!}</p></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                            <i class="fa fa-user font-image"></i>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                            <strong>{!! trans('translation.Текст') !!} :</strong>

                                            <p>{!! nl2br($item->body) !!}</p>

                                            <p><i class="fa fa-clock-o"></i> {!! $item->created_at !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            @endif
                    <!-- End show feedback-->
    </div>
@stop