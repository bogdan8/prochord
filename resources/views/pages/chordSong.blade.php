@extends('layouts.default')

@section('content')
    <div class="container">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="/">{{trans('translation.Головна')}}</a></li>
                <li>{{trans('translation.Акорди')}}</li>
            </ol>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 style="text-align: center;">{{trans('translation.Часто_вжиті_акорди')}}</h2>
                <br />
                @foreach($chordSong as $item)
                    <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
                        <h2 style="text-align: center;">{{$item->title}}</h2>
                        <img class="img-thumbnail" src="/uploads/chord/original/{{$item->image}}"/>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop