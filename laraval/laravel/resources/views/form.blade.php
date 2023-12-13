<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
<form action="/user/10/5" method="get">
    <!--
    <input type="" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="_method" value="PUT">
    -->
     @csrf
    <input type="checkbox" name="select[]" id=""value="1">
    <input type="checkbox" name="select[]" id=""value="2">
    <input type="checkbox" name="select[]" id=""value="3">
    <button type="submit">提交</button>
</form>
</body>
</html>
