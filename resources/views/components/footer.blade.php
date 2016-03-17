<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="footer-copyright">
                    <p><i class="fa fa-pie-chart"></i> {{trans('translation.Статистика')}}:</p>

                    <p>{{trans('translation.Кількість_пісень')}}: <i class="fa fa-music"></i> {{$countSong}}</p>

                    <p>{{trans('translation.Кількість_виконавців')}}: <i class="fa fa-users"></i> {{$countPerformer}}
                    </p>

                    <p>{{trans('translation.Кількість_уроків')}}: <i class="fa fa-book"></i> {{$countLessons}}</p>
                    <!--LiveInternet counter-->
                    <script type="text/javascript">
                        <!--
                        document.write("<a href='//www.liveinternet.ru/click' " +
                                "target=_blank><img src='//counter.yadro.ru/hit?t26.6;r" +
                                escape(document.referrer) + ((typeof(screen) == "undefined") ? "" :
                                ";s" + screen.width + "*" + screen.height + "*" + (screen.colorDepth ?
                                        screen.colorDepth : screen.pixelDepth)) + ";u" + escape(document.URL) +
                                ";" + Math.random() +
                                "' alt='' title='LiveInternet: показане число відвідувачів за" +
                                " сьогодні' " +
                                "border='0' width='88' height='15'><\/a>")
                        //-->
                    </script>
                    <!--/LiveInternet-->
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="footer-copyright">&copy;
                    2016 {{trans('translation.Пісні_під_гітару')}}!
                    <br/>

                    <p>{{trans('translation.На_цьому_сайті_зібрано_багато_різної_музики')}}, </p>

                    <p>{{trans('translation.та_багато_відеоуроків_в_яких_ви_найдете_все')}}, </p>

                    <p>{{trans('translation.для_того_щоб_користувачі_навчились_грати_на_гітарі')}}</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="footer-copyright">
                    <p><i class="fa fa-weixin"></i> {{trans('translation.Звязок_з_нами')}}: </p>
                    <a href="/feedback" class="btn btn-primary">{{trans('translation.Звязатися')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>