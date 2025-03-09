<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

        <style>

          
            .login .login-logo{
  text-align: center;
  width: 90%;
  margin: auto;
  margin-top: -110px;
  margin-bottom: 30px
}

.login .login-logo img{
  width: 130px;
  margin: auto;
  background: #fff;
  padding: 8px;
  box-shadow: 2px 2px 10px 5px rgba(0, 0, 0, 0.1);
  border-radius: 50%;
  margin-bottom: 10px;
}
.login .login-logo h2{
  font-size: 21px;
}

.login {
  margin-top: 120px;
  padding: 40px;
  border-radius: 10px;
  width: 90%;
  box-shadow: 2px 2px 10px 5px rgba(0, 0, 0, 0.1);
}

.carousel img{
  height: 100vh;
  object-fit: cover; 
}

.carousel {
  margin-left: -12px;
  clip-path: circle(72.7% at 15% 61%);
}

.login button{
  width: 100%;
  background: #4484c5;
  transition: .5s;
  margin-top: 10px;
}

.login button:hover{
  box-shadow: 2px 2px 10px 5px rgba(0, 0, 0, 0.1);
}
        </style>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased ">
            {{ $slot }}
        </div>
    </body>
</html>
