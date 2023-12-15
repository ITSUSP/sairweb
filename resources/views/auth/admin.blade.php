@extends('auth.master')

@section('content')

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAIR - Sistema que Avisa sobre InteRvenções</title>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <style>
        html {
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
 
        div.link h3 {
            font-size: large;
        }
 
        div.link p {
            font-size: small;
            color: #718096;
        }
    </style>
</head>
<body>
 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<section class="section">
    <div class="container">
        <h1 class="title">
            Usuários pendentes
        </h1>
 
        <section class="invalids">
            @foreach ($invalids as $invalid)
<div class="card">
  <div class="card-body">
    <h5 class="card-title">{{ $invalid->name }}</h5>
    <p class="card-text">{{$invalid->email}}</p>
<form method="get">
        <input type="submit" name="Aprovar"
                class="button" value="Aprovar" />  
        <input type="submit" name="Remover"
                class="button" value="Remover"/> 
    </form> 
  </div>
</div>
            @endforeach
        </section>
    </div>
</section>
<section class="section">
    <div class="container">
        <h1 class="title">
            Usuários ativos
        </h1>
 
        <section class="users">
            @foreach ($users as $user)
<div class="card">
  <div class="card-body">
    <h5 class="card-title">{{ $user->name }}</h5>
    <p class="card-text">{{$user->email}}</p>
    <form method="get"> 
        <input type="submit" name="Remover" class="button" value="Remover"/> 
         
    </form> 
            @endforeach
        </section>
    </div>

<?php
use App\Models\User;
        if(array_key_exists('Remover', $_GET)) { 
User::where('email',$user->email) -> first()->delete();
return redirect()->route('login');
        } 
        else if(array_key_exists('Aprovar', $_GET)) { 
echo($invalid->email);
        } 
    ?> 
  


</section>
</body>
</html>
@endsection