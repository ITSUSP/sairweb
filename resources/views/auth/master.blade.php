<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SAIR - Sistema que Avisa sobre InteRdições</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src='https://kit.fontawesome.com/3176b763f7.js' crossorigin='anonymous'></script>
    @yield('css')
</head>
<body>
    <header>
<nav class='navbar navbar-light bg-light navbar-fixed-top'>
  <div class='container-fluid'>
<a class='navbar-brand'><i class='fa-solid fa-earth-americas'></i> SAIR</a>
<a class="nav-link" href="logout"><span style="margin-right: 5px;"></span>Logout</a>
</div>
</nav>
        
    </header>
{{--
<script type='module'>
    import { initializeApp } from 'https://www.gstatic.com/firebasejs/10.4.0/firebase-app.js'
    // Add Firebase products that you want to use
import { getDatabase, ref, child, get } from 'firebase/database';
const firebaseConfig = {

    apiKey: 'AIzaSyAduf-O9eko1BDAmfEFXbSnCJ9tR2vFwaI',

    authDomain: 'intervention-project-b7354.firebaseapp.com',

    databaseURL: 'https://intervention-project-b7354.firebaseio.com',

    projectId: 'intervention-project-b7354',

    storageBucket: 'intervention-project-b7354.appspot.com',

    messagingSenderId: '1076644742720',

    appId: '1:1076644742720:web:15482c20832db03b74c1a5',

    measurementId: 'G-BERXMK2MY4'

  };
// Initialize Firebase
const app = initializeApp(firebaseConfig);

    --}}@yield('content'){{--
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/7.12.0/firebase-database.js"></script>
    <script src="http://www.gstatic.com/firebasejs/live/3.1/firebase.js"></script>
    <script src="{{ asset('assets/js/firebase.js') }}"></script>    
    <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
	
        $("#btn-leave").click(function () {
            axios.post("{{ url('/user-logout') }}")
            .then(result => {
                window.location.href = '{{url('/')}}'
            });
        });                
    </script>
--}}
    @yield('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>


</body>
</html>