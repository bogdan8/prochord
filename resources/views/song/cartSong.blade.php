@extends('layouts.default')

@section('content')
    <title>{{$cartSong->title}}</title>
    <div class="container">
        <div class="row">
            <!-- Breadcrumb -->
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
                                    <a href="/performers/{{$item->slug}}">
                                        {!! $item->title!!}
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                    <li>{{$cartSong->title}}</li>
                </ol>
            </div>
            <!-- End breadcrumb -->
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="panel panel-success" style="margin-top: 20px;">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <div class="row">
                                <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                                    <p style="margin-top: 10px;">{!! $cartSong->title!!}</p>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                                    <!-- Alert this errors -->
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
                                                <!-- End alert this errors -->
                                        <!-- Form like and unLike -->
                                        {!! Form::open(['method'=>'POST','class'=>'form-un-like']) !!}<br/>
                                        {!! Form::text('song_id',$cartSong -> id,['id' => 'UnLikeId','style' => 'display:none']) !!}
                                        <p>{!! $cartSong->UnLike !!}
                                            {!! Form::button('<i class="fa fa-thumbs-o-down"></i>',['class'=>'btn btn-danger','type'=>'submit', 'name'=>'UnLike']) !!}
                                        </p>
                                        {!! Form::close() !!}
                                        {!! Form::open(['method'=>'POST','class'=>'form-like']) !!}<br/>
                                        {!! Form::text('song_id',$cartSong->id,['id' => 'LikeId','style' => 'display:none']) !!}
                                        <p>{!! $cartSong->Like !!}
                                            {!! Form::button('<i class="fa fa-thumbs-o-up"></i>',['class'=>'btn btn-success','type'=>'submit', 'name'=>'Like']) !!}
                                        </p>
                                        {!! Form::close() !!}
                                                <!-- End form like and unLike -->
                                        <div class="heart-song">
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
                            <!-- song description shows -->
                            <p class="title-song">{!! $cartSong->title!!}
                                <i class="fa fa-eye"></i>
                                {{$cartSong->count_views_song}}
                            </p>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                        @if(!empty($cartSong->performer_id))
                                            <p>
                                                {{trans('translation.Виконавець')}} :
                                                @foreach($performer as $item)
                                                    @if($item->id === $cartSong->performer_id)
                                                        <a href="/performers/{{$item->slug}}">
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
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        @if(!empty($cartSong->tabulature))
                                            <p>
                                                {{trans('translation.Як_грати')}} :
                                                <br/>
                                                <?php
                                                $tabulature = str_replace('Am', '<a href="">Am</a>', $cartSong->tabulature);
                                                for ($i = 0; $i < count($arr_letter); $i++) {
                                                    $tabulature = str_replace($arr_letter[$i] . '&nbsp;', '<a>' . $arr_letter[$i] . '</a>', $tabulature);
                                                    $tabulature = str_replace($arr_letter[$i] . ' ', '<a>' . $arr_letter[$i] . '</a>', $tabulature);
                                                }
                                                echo $tabulature;
                                                ?>
                                            </p>
                                        @endif()
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                        <!-- script to share the song in social networks-->
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
                                            })();
                                        </script>
                                        <div data-description="{{ strtr($cartSong->body,"_"," ")}}" style="margin-left: 20px; "
                                             data-title="{{$cartSong->title}}"
                                             data-url="http://test.ifka.kr.ua/songs/{{$cartSong->title}}" class="pluso"
                                             data-background="transparent"
                                             data-options="medium,square,multiline,horizontal,counter,theme=04"
                                             data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir,email,print">

                                        </div>
                                        <!-- End script to share the song in social networks-->
                                    </div>
                                </div>
                                <!-- text settings -->
                                <br />
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
                                <!-- End text settings -->
                                <div class="row">
                                    <div class="col-lg-1 col-md-1 hidden-sm hidden-xs">
                                    </div>
                                    <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12" id="song-body-fonts">
                                        <?php
                                        $strtr = strtr($cartSong->body, "_", " ");
                                        $body = str_replace('Am', '<a href="">Am</a>', $strtr);
                                        for ($i = 0; $i < count($arr_letter); $i++) {
                                            $body = str_replace($arr_letter[$i] . '&nbsp;', '<a>' . $arr_letter[$i] . '</a>', $body);
                                            $body = str_replace($arr_letter[$i] . ' ', '<a>' . $arr_letter[$i] . '</a>', $body);
                                            $body = str_replace('  ' . $arr_letter[$i], '<a>' . $arr_letter[$i] . '</a>', $body);
                                        }
                                        echo $body;
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- End song description shows -->
                        </div>
                        <div class="row">
                            @if(!empty($cartSong->video))
                                <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs">
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <h2 class="section-heading">{{trans('translation.Відео')}}</h2>

                                    <p style="height: 300px">{!! $cartSong->video!!}</p>
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
                                    <a href="/uploads/media_documents/{{$cartSong->media_document}}">
                                        <p style="text-align: center;">
                                            {{trans('translation.Скачати')}}
                                            <?php
                                            $type = substr($cartSong->media_document, strlen($cartSong->media_document) - 4);
                                            $type == '.zip' ? $type = '.gp3-4-5' : 0;
                                            ?>
                                            {{$type}}
                                        </p>
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if($cartSong->who_added != 'admin')
                        <h3 class="who-added-song">{{trans('translation.Дякуємо').' `'.$cartSong->who_added.'`'}} {{trans('translation.за_добавлену_пісню')}}</h3>
                    @endif
                </div>
            </div>
            <!-- right panel -->
            @include('song.rightPanel.cartSong')
                    <!-- end right panel -->
        </div>
        <!-- comments -->
        @include('song.comments.song')
                <!-- end comments -->
    </div>
@stop