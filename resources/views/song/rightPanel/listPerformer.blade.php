<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="panel panel-success" style="margin-top: 20px;">
        <div class="panel-heading">
            <h3 class="panel-title">{{trans('translation.Найбільш_переглянуті_виконавці')}}</h3>
        </div>
        <div class="panel-body">
            @foreach($most_popular as $item)
                <a class="btn btn-primary my_btn"
                   href="/performers/{{$item->slug}}">
                    @if(!empty($item->image))
                        <img class="a-img-list-performer"
                             src="/uploads/performer/{{$item->image}}">
                    @endif
                    <p class="p-title-list-performer">
                        {!! mb_substr(strip_tags($item->title),0 , 15)!!}...
                    </p>
                        <span class="songIconCountRight">
                            <i class="fa fa-eye"></i>
                            {{$item->count_views_performer}}
                            <i class="fa fa-music"></i>
                            {!! count($item->song) !!}
                        </span>
                </a>

            @endforeach
        </div>
    </div>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h3 class="panel-title">{{trans('translation.Остані_додані_виконавці')}}</h3>
        </div>
        <div class="panel-body">
            @foreach($last_add as $item)
                <a class="btn btn-primary my_btn"
                   href="/performers/{{$item->slug}}">
                    @if(!empty($item->image))
                        <img class="a-img-list-performer"
                             src="/uploads/performer/{{$item->image}}">
                    @endif
                    <p class="p-title-list-performer">
                        {!! mb_substr(strip_tags($item->title),0 , 15)!!}...
                    </p>
                        <span class="songIconCountRight">
                           <i class="fa fa-eye"></i>
                            {{$item->count_views_performer}}
                            <i class="fa fa-music"></i>
                            {!! count($item->song) !!}
                        </span>
                </a>
            @endforeach
        </div>
    </div>
</div>