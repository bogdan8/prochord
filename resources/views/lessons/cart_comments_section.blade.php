<div class="row">
    <div class="col-lg-12 text-center">
        <h2 class="section-heading">{{trans('translation.Коментарі')}}
            <span>
                             <i class="fa fa-comments-o"></i> {{count($lessons_comment)}}
                        </span>
        </h2>

        <h3 class="section-subheading">{{trans('translation.Тут_відображуються_ваші_коментарі')}}</h3>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        @foreach($lessons_comment as $item)
            <div class="panel panel-success" style="border-radius: 10px;">
                <div class="panel-heading"
                     style="border-radius: 10px 10px 0px 0px;background-color: #603d1b;">
                    <strong>{!! trans('translation.Імя') !!} :</strong>

                    <h3 class="panel-title"><p>{!! $item->name !!}</p></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <img class="img-comment" src="/image/guitar/guitar-{{rand(1,4)}}.jpg">
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                            <strong>{!! trans('translation.Текст') !!} :</strong>

                            <p>{!! nl2br($item->body) !!}</p>

                            <p><i class="fa fa-clock-o"></i> {!! $item->created_at !!}</p>
                        </div>
                    </div>
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
        {!! Form::open(['method'=>'POST' , 'id'=>'formLessons']) !!}<br/>
        {!! Form::label(trans('translation.Ваше_імя').' *:') !!}
        {!! Form::text('name',null,['id'=>'name','placeholder'=>trans('translation.Ваше_імя').' :','required','class'=>'form-control'],Input::old('name')) !!}
        <br/>
        {!! Form::label(trans('translation.Ваш_email').' *:') !!}
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">@</span>
            {!! Form::text('email',null,['id'=>'email','placeholder'=>trans('translation.Ваш_email').' :','required','class'=>'form-control'],Input::old('email')) !!}
        </div>
        {!! Form::textarea('lessonsId',$lessons_cart->id,['id'=>'lessonsId' , 'style'=>'display:none']) !!}
        <br/>
        {!! Form::label(trans('translation.Ваш_текст').' *:') !!}
        {!! Form::textarea('body',null,['id'=>'body','placeholder'=>trans('translation.Ваш_текст').' :','required', 'class'=>'form-control','rows'=>'5'],Input::old('body')) !!}
        <br/>
        {!! Form::submit(trans('translation.Коментувати'),['class'=>'btn btn-success']) !!}
        {!! Form::close() !!}
    </div>
</div>