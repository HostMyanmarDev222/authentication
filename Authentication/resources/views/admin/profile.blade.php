<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-4 col-md-offset-4">
        <h4>User Login</h4>
        <table class="table table-hover">
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th></th>
            </thead>
            <tbody>
            <th>{{$LoggedUserInfo->name}}</th>
                <th>{{$LoggedUserInfo->email}}</th>
                <th><a href="logout">Logout</a></th>
            </tbody>
        </table>
        </div>
        </div>
    </div>
</body>
</html>