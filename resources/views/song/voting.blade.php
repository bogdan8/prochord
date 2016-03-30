<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
    <div class="alert alert-success infoSuccessVoting">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>{{trans('translation.Успішно')}}</strong>
        <ul></ul>
    </div>
    <div class="alert alert-dismissible alert-danger infoErrorVoting">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>{{trans('translation.Помилка')}}</strong>
        <ul></ul>
    </div>
    <?php $i = 0; ?>
    @foreach($voting as $vot)
        <?php $i++; ?>
        @if($vot->show_list == 1)
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">{{trans('translation.Голосування')}} :</h3>
                    <br/>
                    @if($url_lang == 'uk')
                        <p>{{$vot->title}}</p>
                    @elseif($url_lang == 'ru')
                        <p>{{$vot->title_rus}}</p>
                    @elseif($url_lang == 'en')
                        <p>{{$vot->title_eng}}</p>
                    @endif
                    <div class="voting-btn">
                        <button class="btn btn-success btn-show">Показати поля</button>
                        <button class="btn btn-danger btn-hide">Сховати поля</button>
                    </div>
                </div>
                <div class="panel-body voting">
                    <form method="post" id="formVoting{{$i}}">
                        {!! csrf_field() !!}
                        @foreach($voting_list as $vot_list)
                            @if($vot->id == $vot_list->voting_id )
                                <?php
                                if ($vot->sumVotingList != 0) {
                                    $shareSum = $vot->sumVotingList / 100;
                                    $percentage = $vot_list->count / $shareSum;
                                } else {
                                    $percentage = 0;
                                }
                                ?>
                                <div class="radio">
                                    <label>
                                        <input id="voting_value" type="radio" value="{{$vot_list->id}}"
                                               name="voting">
                                        @if($url_lang == 'uk')
                                            {{$vot_list->title}}
                                        @elseif($url_lang == 'ru')
                                            {{$vot_list->title_rus}}
                                        @elseif($url_lang == 'en')
                                            {{$vot_list->title_eng}}
                                        @endif

                                    </label>

                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped" role="progressbar"
                                             style="width:{{$percentage}}%;">
                                            <?= substr($percentage, 0, 4); ?>%
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <p>{{trans('translation.Кількість_голосів')}} : {!! count($votingIp) !!}</p>

                        <div>
                            <button type="submit"
                                    class="btn btn-success">{{trans('translation.Проголосувати')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="panel panel-success">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <p>{{$vot->title}}</p>
                    </h4>
                </div>
                @foreach($voting_list as $vot_list)
                    @if($vot->id == $vot_list->voting_id )
                        <?php
                        if ($vot->sumVotingList != 0) {
                            $shareSum = $vot->sumVotingList / 100;
                            $percentage = $vot_list->count / $shareSum;
                        } else {
                            $percentage = 0;
                        }
                        ?>
                        <div class="radio">
                            <label>
                                <p> {{$vot_list->title}} </p>
                            </label>

                            <div class="progress">
                                <div class="progress-bar progress-bar-striped" role="progressbar"
                                     style="width:{{$percentage}}%;">
                                    <?= substr($percentage, 0, 4); ?>%
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif
    @endforeach
</div>