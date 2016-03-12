<div class="col-lg-4 col-md-4 col-sm-5 col-xs-12">
    <div class="btn-group bootstrap-select">
        {!! Form::open()!!}
        {!! csrf_field() !!}
        @if($url_lang == 'uk')
            {!! Form::select('sort', [
            'title'=>trans('translation.Імям'),
            'created_at'=>trans('translation.Датою'),
            'count_views_song'=>trans('translation.Популярністю')
            ],'null',['class' =>'form_control'])
            !!}
        @elseif($url_lang == 'ru')
            {!! Form::select('sort', [
            'title'=>trans('translation.Імям'),
            'created_at'=>trans('translation.Дата'),
            'count_views_song'=>trans('translation.Популярністю')
            ],'null',['class' =>'form_control'])
            !!}
        @elseif($url_lang == 'en')
            {!! Form::select('sort', [
            'slug'=>trans('translation.Імям'),
            'created_at'=>trans('translation.Дата'),
            'count_views_song'=>trans('translation.Популярністю')
            ],'null',['class' =>'form_control'])
            !!}
        @endif
        {!! Form::select('sortBy', [
       'asc'=>'&darr;',
       'desc'=>'&uarr;',
       ],'null',['class' =>'form_control']) !!}
        <input type="submit" value="{!! trans('translation.Сортувати') !!}" class="btn btn-primary">
        {!! Form::close() !!}
    </div>
</div>