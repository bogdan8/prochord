<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
    <title>Помилка</title>

    <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            color: #4CAE4C;
            font-size: 72px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">{{trans('translation.404_Сторінка_не_знайдена!_Будь_ласка,_перейдіть_назад_на_головну!')}}</div>
        <a class="title"
           href="/">{{trans('translation.Назад_на_головну!')}}</a>
    </div>
</div>
</body>
</html>
