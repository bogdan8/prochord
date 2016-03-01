@extends('layouts.default')

@section('content')
    <title>{{$cartSong->title}}</title>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="/">{{trans('translation.Головна')}}</a></li>
                    <li><a href="/songs">{{trans('translation.Пісні')}}</a></li>
                    <li><a href="/categories">{{trans('translation.Категорії')}}</a></li>
                    @if($url_lang == 'uk')
                        <li><a href="/song/{{$get->title_eng}}">{{$get->title}}</a></li>
                    @elseif($url_lang == 'ru')
                        <li><a href="/song/{{$get->title_eng}}">{{$get->title_rus}}</a></li>
                    @elseif($url_lang == 'en')
                        <li><a href="/song/{{$get->title_eng}}">{{$get->title_eng}}</a></li>
                    @endif
                    @if(!empty($cartSong->performer_id))
                        @foreach($performer as $item)
                            @if($item->id === $cartSong->performer_id)
                                <li>
                                    <a href="/performers/{{$item->title}}">
                                        {!! $item->title!!}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                    <li>{{$cartSong->title}}</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="panel panel-success" style="margin-top: 20px;">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <p style="margin-top: 10px;">{!! $cartSong->title!!}</p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                     <span class="view_song">
                                        <i class="fa fa-eye"></i>
                                         {{$cartSong->count_views_song}}
                                     </span>
                                    @if(isset($error_like))
                                        <script>
                                            alert('{{trans('translation.З_вашої_ip_уже_голосували')}}');
                                        </script>
                                    @elseif(isset($Like))
                                        <script>
                                            alert('{{trans('translation.Вам_сподобалось')}}');
                                        </script>
                                    @elseif(isset($UnLike))
                                        <script>
                                            alert('{{trans('translation.Вам_не_сподобалось')}}');
                                        </script>
                                    @endif
                                    {!! Form::open(['method'=>'POST','class'=>'formUnLike']) !!}<br/>
                                    {!! Form::text('song_id',$cartSong -> id,['id' => 'UnLikeId','style' => 'display:none']) !!}
                                    <p>{!! $cartSong->UnLike !!}
                                        {!! Form::button('<i class="fa fa-thumbs-o-down"></i>',['class'=>'btn btn-danger','type'=>'submit', 'name'=>'UnLike']) !!}
                                    </p>
                                    {!! Form::close() !!}
                                    {!! Form::open(['method'=>'POST','class'=>'formLike']) !!}<br/>
                                    {!! Form::text('song_id',$cartSong->id,['id' => 'LikeId','style' => 'display:none']) !!}
                                    <p>{!! $cartSong->Like !!}
                                        {!! Form::button('<i class="fa fa-thumbs-o-up"></i>',['class'=>'btn btn-success','type'=>'submit', 'name'=>'Like']) !!}
                                    </p>
                                    {!! Form::close() !!}
                                    <div class="heart_song">
                                        <span>
                                            <i class="fa fa-heart-o"></i>
                                            {{$cartSong->heart}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <p style="text-align: center; font: italic 14pt 'Times New Roman',Times,serif;">{!! $cartSong->title!!}</p>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        @if(!empty($cartSong->performer_id))
                                            <p>
                                                {{trans('translation.Виконавець')}} :
                                                @foreach($performer as $item)
                                                    @if($item->id === $cartSong->performer_id)
                                                        <a href="/performers/{{$item->title}}">
                                                            <p style="float: left;">
                                                                {!! $item->title!!}
                                                            </p>
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </p>
                                            <br/>
                                        @endif
                                        @if(!empty($cartSong->description))
                                            <p>
                                                <br/>
                                                {{trans('translation.Музика_та_слова')}} :
                                                <br/>
                                                {!! $cartSong->description!!}
                                            </p>

                                        @endif
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        @if(!empty($cartSong->tabulature))
                                            <p>
                                                {{trans('translation.Як_грати')}} :
                                                <br/>
                                                {!! $cartSong->tabulature!!}
                                            </p>
                                        @endif()
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                        <h4 style="color: #1B602C;">{{trans('translation.Шрифт')}} :</h4>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6">
                                        <select id="font-family" class="form_control">
                                            <option>Arial</option>
                                            <option>Times New Roman</option>
                                            <option>Arial Black</option>
                                            <option>Courier New</option>
                                            <option>Tahoma</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <p id="magnification" class="btn btn-primary" style="float: left;">+</p>
                                        <h4 id="value"></h4>

                                        <p id="decrease" class="btn btn-primary" style="float: left;">-</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-1 col-md-1 hidden-sm hidden-xs">
                                    </div>
                                    <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12" id="song-body-fonts">
                                        <p>{!! strtr($cartSong->body,"_"," ")!!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @if(!empty($cartSong->video))
                                <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <h2 class="section-heading">{{trans('translation.Відео')}}</h2>

                                    <p>{!! $cartSong->video!!}</p>
                                </div>
                            @endif
                            @if(!empty($cartSong->note))
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h2 class="section-heading">{{trans('translation.Ноти')}}</h2>

                                    <p>{!! $cartSong->note!!}</p>
                                </div>
                            @endif
                            @if(!empty($cartSong->image))
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <h2 class="section-heading">{{trans('translation.Фото')}}</h2>
                                    <img src="/uploads/song/{{$cartSong->image}}">
                                </div>
                            @endif
                            @if(!empty($cartSong->media_document))
                                <div class="col-lg-1 col-md-1 hidden-sm hidden-xs">
                                </div>
                                <div class="col-lg-11 col-md-11 col-sm-12 col-xs-12">
                                    <h2 class="section-heading">{{trans('translation.Файл_з_нотами')}}</h2>
                                    <a href="/uploads/media_documents/{{$cartSong->media_document}}">{{trans('translation.Скачати')}}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <script type="text/javascript">(function () {
                            if (window.pluso)if (typeof window.pluso.start == "function") return;
                            if (window.ifpluso == undefined) {
                                window.ifpluso = 1;
                                var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                                s.type = 'text/javascript';
                                s.charset = 'UTF-8';
                                s.async = true;
                                s.src = ('https:' == window.location.protocol ? 'https' : 'http') + '://share.pluso.ru/pluso-like.js';
                                var h = d[g]('body')[0];
                                h.appendChild(s);
                            }
                        })();</script>
                    <div data-description="{!! strtr($cartSong->body,"_"," ")!!}" style="margin-left: 20px; "
                         data-title="{{$cartSong->title}}"
                         data-url="http://test.ifka.kr.ua/songs/{{$cartSong->title}}" class="pluso"
                         data-background="transparent"
                         data-options="medium,square,multiline,horizontal,counter,theme=04"
                         data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir,email,print">

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
                                    {!! mb_substr(strip_tags($item->title),0 , 15)!!}...
                                </p>
                            <span class="songIconCountRight">
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
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{trans('translation.Остані_додані_пісні')}}</h3>
                    </div>
                    <div class="panel-body">
                        @foreach($last_add as $item)
                            <a class="btn btn-primary my_btn"
                               href="/songs/{{$item->slug}}">
                                <p style="float: left;">
                                    {!! mb_substr(strip_tags($item->title),0 , 15)!!}...
                                </p>
                            <span class="songIconCountRight">
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
                    </div>
                </div>
            </div>
        </div>
        @if(!empty($songComment['0']))
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">{{trans('translation.Коментарі')}}
                        <span>
                             <i class="fa fa-comments-o"></i> {{count($songComment)}}
                        </span>
                    </h2>

                    <h3 class="section-subheading">{{trans('translation.Тут_відображуються_ваші_коментарі')}}</h3>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @foreach($songComment as $item)
                        <div class="panel panel-success" style="border-radius: 10px;">
                            <div class="panel-heading"
                                 style="border-radius: 10px 10px 0px 0px;background-color: #603d1b;">
                                <strong>{{trans('translation.Імя')}}:</strong>

                                <h3 class="panel-title"><p>{!! $item->name !!}</p></h3>
                            </div>
                            <div class="panel-body">
                                <strong>{{trans('translation.Дата')}}:</strong>

                                <p>{!! $item->date !!}</p>
                                <strong>{{trans('translation.Текст')}}:</strong>

                                <p>{!! $item->body !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
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
                {!! Form::open(['method'=>'POST' , 'id'=>'formSong']) !!}<br/>
                {!! Form::label(trans('translation.Ваше_імя').' *:') !!}
                {!! Form::text('name',null,['id'=>'name','placeholder'=>trans('translation.Ваше_імя').' :','required','class'=>'form-control'],Input::old('name')) !!}
                <br/>
                {!! Form::label(trans('translation.Ваш_email').' *:') !!}
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">@</span>
                    {!! Form::text('email',null,['id'=>'email','placeholder'=>trans('translation.Ваш_email').' :','required','class'=>'form-control'],Input::old('email')) !!}
                </div>
                {!! Form::textarea('songId',$cartSong -> id,['id'=>'songId' , 'style'=>'display:none']) !!}
                <br/>
                {!! Form::label(trans('translation.Ваш_текст').' *:') !!}
                {!! Form::textarea('body',null,['id'=>'body','placeholder'=>trans('translation.Ваш_текст').' :','required', 'class'=>'form-control','rows'=>'5'],Input::old('body')) !!}
                <br/>
                {!! Form::submit(trans('translation.Коментувати'),['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop