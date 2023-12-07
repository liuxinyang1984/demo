<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>
<body>
<form action="/task/form" method="post">
    <!--
    <input type="" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="_method" value="PUT">
    -->
    @csrf
    @method('delete')
    <button type="submit">提交</button>
</form>
</body>
</html>
