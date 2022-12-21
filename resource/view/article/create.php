<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="/article/store" method="post">
    <label for="name">
        title
    </label>
    <input type="text" id="name" name="name">
    <label for="category_id">
        category_id
    </label>
    <input type="number" id="category_id" name="category_id">
    <input type="submit" value="submit">
</form>
</body>
</html>