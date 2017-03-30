<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="/css/style.css">

<link rel="stylesheet" href="/css/bootstrap.min.css">

<script   src="https://code.jquery.com/jquery-3.2.1.js"   integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="   crossorigin="anonymous"></script>  

<script src="/js/login.js"></script>
    <title></title>
</head>
<body>
 <div class="container">
        <div class="card card-container">
           
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="post" action="{{route('login')}}">
            {{csrf_field()}}
                <span id="reauth-email" class="reauth-email"></span>
                <input type="text" id="inputName" name="name" class="form-control" placeholder="Name" required autofocus>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
               
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>

                @if(Session::has('error'))
                <div class="alert alert-danger">
                {{Session::get('error')}}
                </div>
                @endif

            </form>
            
        </div>
    </div>

</body>
</html>
   