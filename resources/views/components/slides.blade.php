<div id="carousel" class="carousel Sliders">
    <div class="carousel-inner">
        @foreach($slider as $item)
            <div class="active">
                <img class="SlidersImg" src="/uploads/slides/large/{{$item->image}}">
            </div>
        @endforeach
        <div class="flags_position">
            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <a rel="alternate" hreflang="{{$localeCode}}"
                   href="{{LaravelLocalization::getLocalizedURL($localeCode) }}">
                    @if($properties['name'] == 'English')
                        {!! HTML::image('/image/flags/en.png', 'localization' ) !!}
                    @elseif($properties['name'] == 'Russian')
                        {!! HTML::image('/image/flags/ru.png', 'localization' ) !!}
                    @elseif($properties['name'] == 'Ukrainian')
                        {!! HTML::image('/image/flags/uk.png', 'localization' ) !!}
                    @endif
                </a>
            @endforeach
        </div>
    </div>
    <div class="alphabet-block">
        @foreach($alphabet as $item)
            @if($url_lang == 'uk')
                <a class="btn btn-primary" href="/song_sort/{!! $item->title !!}">{!! $item->title !!}</a>
            @elseif($url_lang == 'ru')
                <a class="btn btn-primary" href="/song_sort/{!! $item->title_rus !!}">{!! $item->title_rus !!}</a>
            @elseif($url_lang == 'en')
                @if(!empty($item->title_eng))
                    <a class="btn btn-primary" href="/song_sort/{!! $item->title_eng !!}">{!! $item->title_eng !!}</a>
                @endif
            @endif
        @endforeach
    </div>
</div>



