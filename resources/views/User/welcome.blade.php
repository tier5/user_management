<!DOCTYPE html>
<html lang="en">

<head>
<title>User Home</title>
</head>
<body>

<p>Welcome,{{$user->user_name}}</p>
<a type="button" href="{{route('logout')}}">LOGOUT</a>
</body>
</html>