<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Título de tu página</title>
    <!-- Enlace a tus archivos de estilos CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
     <link href="{{ asset('css/inicio2.css') }}" rel="stylesheet">
     <link href="{{ asset('css/inicio.css') }}" rel="stylesheet">
     <link href="{{ asset('css/contac2.css') }}" rel="stylesheet">
     <link href="{{ asset('css/inicio3.css') }}" rel="stylesheet">
     <link rel="stylesheet" href="{{ asset('css/formularios1.css') }}">
</head>
<body>
    
    <div class="container mt-1 mb-1">
        <div class="row align-items-center">
            <!-- Logotipo  -->
            <div class="col">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('img/logoofi2.png') }}" alt="Logo de Frutivegetal" width="200"> 
                </a>
            </div>
 <!-- buscador -->
            <div class="col">
                <form class="form-inline">
                    <div class="input-group search-input">
                        <input class="form-control border-0" type="search" placeholder="Buscar" aria-label="Buscar">
                        <div class="input-group-append search-icon-container">
                            <span class="input-group-text border-0 search-icon"><i class="fas fa-search"></i></span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col"></div>
            <div class="col-auto">
            </div>
        </div>
    </div>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-success-light">
        <div class="container">
            <a class="navbar-brand" href="{{route('index')}}">Inicio</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav navbar-custom">
                   
                    <li class="nav-item dropdown"> 
                        <a class="nav-link dropdown-toggle" href="#" id="categoriasDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categorías
                        </a>
                        <div class="dropdown-menu" aria-labelledby="categoriasDropdown">
                            <a class="dropdown-item" href="{{route('inorganico')}}">Inorgánicos</a>
                            <a class="dropdown-item" href="{{route('organico')}}">Orgánicos</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown"> 
                        <a class="nav-link dropdown-toggle" href="#" id="categoriasDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Compras
                        </a>
                        <div class="dropdown-menu" aria-labelledby="categoriasDropdown">
                            <a class="dropdown-item" href="#">carrito de Compras</a>
                         
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contactenos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('pqrs.create')}}">PQRS</a>
                    </li>
                </ul>
                

            </div>
        </div>
    </nav>
    <br>
    <script>
        function validateForm() {
            var nombres = document.querySelector('input[name="nombres"]').value;
            var apellidos = document.querySelector('input[name="apellidos"]').value;
            var edad = document.querySelector('input[name="edad"]').value;
            var telefono = document.querySelector('input[name="telefono"]').value;
            var email = document.querySelector('input[name="email"]').value;
            var password = document.querySelector('input[name="password"]').value;
    
            if (nombres === "") {
                alert("Por favor, ingrese el nombre.");
                return false;
            }
            if (nombres.length > 30) {
            alert("El nombre no puede tener más de 30 caracteres.");
            return false;
        }
            if (apellidos === "") {
                alert("Por favor, ingrese los apellidos.");
                return false;
            }
            if (edad === "") {
                alert("Por favor, ingrese la edad.");
                return false;
            }
            if (telefono === "") {
                alert("Por favor, ingrese el teléfono.");
                return false;
            }
            if (email === "") {
                alert("Por favor, ingrese el correo electrónico.");
                return false;
            }
            if (password === "") {
                alert("Por favor, ingrese la contraseña.");
                return false;
            }
    
            return true;
        }
    </script>
    
    <div class="users-form">
        <form action="{{ route('users.update', $user->id) }}" method="POST" onsubmit="return validateForm();">
            @csrf
            @method('put')
    
            <h3>Editar datos</h3>
    
            <input type="text" name="nombres" placeholder="nombre" value="{{ $user->nombres }}" autofocus>
            <input type="text" name="apellidos" placeholder="apellidos" value="{{ $user->apellidos }}" autofocus>
            <input type="text" name="edad" placeholder="edad" value="{{ $user->edad }}" autofocus>
            <input type="text" name="telefono" placeholder="telefono" value="{{ $user->telefono }}" autofocus>
            <input type="text" name="email" placeholder="email" value="{{ $user->email }}" autofocus>
            <input type="password" name="password" placeholder="contraseña" value="{{ $user->password }}" autofocus>
    
            <input type="submit" value="actualizar formulario">
        </form>
    </div>
    

    
<footer>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" id="wave">
        <path fill="#35ea35" fill-opacity="1" d="M0,224L26.7,218.7C53.3,213,107,203,160,213.3C213.3,224,267,256,320,261.3C373.3,267,427,245,480,218.7C533.3,192,587,160,640,170.7C693.3,181,747,235,800,245.3C853.3,256,907,224,960,192C1013.3,160,1067,128,1120,128C1173.3,128,1227,160,1280,170.7C1333.3,181,1387,171,1413,165.3L1440,160L1440,0L1413.3,0C1386.7,0,1333,0,1280,0C1226.7,0,1173,0,1120,0C1066.7,0,1013,0,960,0C906.7,0,853,0,800,0C746.7,0,693,0,640,0C586.7,0,533,0,480,0C426.7,0,373,0,320,0C266.7,0,213,0,160,0C106.7,0,53,0,27,0L0,0Z"></path>
        <image href="{{ asset('img/logito.jpg') }}" x="20" y="80" width="300" height="90" />
        <text x="300" y="120" font-size="30" font-weight="bold" fill="#000"> Descárga nuestra app</text>
        <a href="#" x="500" y="120" style="text-decoration: none;">
            <rect x="750" y="100" rx="10" ry="10" width="170" height="50" style="fill:#fcf8f8ea;" />
            <text x="830" y="130" font-size="20" fill="#060606" text-anchor="middle">Descargar ahora</text>
        </a>
    </svg>

    <div class="social-icons">
       
        <a href="https://web.facebook.com/" class="social-icon"><i class="fab fa-facebook"></i></a>
        <a href="https://twitter.com/?logout=1697589605669" class="social-icon">
            <img src="{{ asset('img/twitter.jpg') }}" alt="Twitter" class="social-icon-img">
        </a>
        <a href="https://www.instagram.com/" class="social-icon"><i class="fab fa-instagram"></i></a>
        <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
    </div>

   <!-- Agrega la imagen "playstore.png" al frente y en la misma línea de los iconos -->
   <img src="{{ asset('img/playstore.png') }}" alt="Play Store" class="playstore-icon">

   <!-- Línea divisoria -->
   <hr class="footer-divider">

   <!-- Enlaces de políticas y logo con versión en la misma línea -->
   <div class="footer-links">
       <a href="{{ route('politicas') }}">Política de Privacidad</a>
       <a href="{{ route('terminos') }}">Términos y Condiciones</a>
       <a href="{{ route('datospersonales') }}">Protección  Datos Personales</a>
       <img src="{{ asset('img/logoofi.png') }}" alt="Logo Versión" class="footer-logo">
       <span class="version">2023 frutivegetal</span>
    </div>

</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/productos.js"></script> <!-- Ruta al archivo JavaScript externo -->

  <!-- Template Javascript -->
  <script src="js/main.js"></script>


<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
      
</body>
</html>



