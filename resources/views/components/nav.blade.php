
<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" id="ha-header">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">ProChord</a>
    </div>
    <div class="navbar-collapse collapse ">
      <ul class="nav navbar-nav navbar-right">
          <?php
          // Підсвітка активного пункта меню
          $URL = substr($_SERVER['REQUEST_URI'], 3 );
          $menuLeft = $menu['left'];
          for ($i = 0; $i < count($menuLeft); $i++) {
              $menuLeft_array = $menuLeft[$i];
              if ($URL != $menuLeft_array->url) {
                  if($url_lang == 'uk'){
                      echo "<li><a href='$menuLeft_array->url'>$menuLeft_array->title</a></li>";
                  }elseif($url_lang == 'ru'){
                      echo "<li><a href='$menuLeft_array->url'>$menuLeft_array->title_rus</a></li>";
                  }elseif($url_lang == 'en'){
                      echo "<li><a href='$menuLeft_array->url'>$menuLeft_array->title_eng</a></li>";
                  }
              } else {
                  if($url_lang == 'uk'){
                      echo "<li class=active ><a href='$menuLeft_array->url'>$menuLeft_array->title</a></li>";
                  }elseif($url_lang == 'ru'){
                      echo "<li class=active ><a href='$menuLeft_array->url'>$menuLeft_array->title_rus</a></li>";
                  }elseif($url_lang == 'en'){
                      echo "<li class=active><a href='$menuLeft_array->url'>$menuLeft_array->title_eng</a></li>";
                  }
              }
          }
          // Підсвітка активного пункта меню
          ?>
      </ul>
        <!-- Search -->
        {!! Form::open(['method'=>'get','url' => 'search','class'=>'navbar-form navbar-left','role'=>'search' ]) !!}
        <div class="form-group">
            {!! Form::text('keyword',null,['placeholder'=>trans('translation.Введіть_слово'),'class'=>'form-control']) !!}
        </div>
        {!! Form::submit(trans('translation.Пошук'),['class'=>'btn btn-primary']) !!}
        {!! Form::close() !!}
                <!-- end Search -->
    </div>
    <!--/.nav-collapse -->
  </div>
</div>
