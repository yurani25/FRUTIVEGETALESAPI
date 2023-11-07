
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>frutivegetal</title>
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
     <link href="{{ asset('css/inicio2.css') }}" rel="stylesheet">
     
     <link href="{{ asset('css/inicio.css') }}" rel="stylesheet">
     <link href="{{ asset('css/inicio3.css') }}" rel="stylesheet">
     <link href="{{ asset('css/inicio4.css') }}" rel="stylesheet">
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

            <!-- Botón de inicio de sesión -->
            
        </div>
    </div>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-success-light ">
        <div class="container">
            <a class="navbar-brand" href="{{route('index')}}">Inicio</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav navbar-custom">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('pqrs.create')}}">PQRS</a>
                    </li>
<!--  menú desplegable -->
                    <li class="nav-item dropdown"> 
                        <a class="nav-link dropdown-toggle" href="#" id="categoriasDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categorías
                        </a>
                        <div class="dropdown-menu" aria-labelledby="categoriasDropdown">
                            <a class="dropdown-item" href="#">Orgánicos</a>
                            <a class="dropdown-item" href="#">Inorgánicos</a>
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

                    </li>
                </ul>
            </div>
        </div>
    </nav>


</head>
<body>
    <div class="users-form">
        <h1>Crear Producto</h1>
        <form action="{{ route('productos.store') }}" method="post" enctype="multipart/form-data" id="product-form">
            @csrf
    
            <input type="text" name="nombres" placeholder="Nombres" required>
    
            <input type="text" name="tiempo_reclamo" placeholder="Tiempo de Reclamo" required>
    
            <input type="file" name="imagen" required>
    
            <input type="number" name="precio" placeholder="Precio" required>
    
            <input type="text" name="descripcion" placeholder="Descripción" required>
    
            <select name="user_id" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->id }} {{ $user->nombres }}</option>
                @endforeach
            </select>
    
            <input type="submit" value="Enviar formulario" id="submit-button">
        </form>
    </div>
    <script>
        document.getElementById('product-form').onsubmit = function(event) {
            var nombres = document.querySelector('input[name="nombres"]').value;
            var tiempoReclamo = document.querySelector('input[name="tiempo_reclamo"]').value;
            var precio = document.querySelector('input[name="precio"]').value;
    
            // Validaciones personalizadas
            if (nombres.trim() === '') {
                alert('Por favor, ingrese un nombre válido.');
                event.preventDefault();
            }
    
            if (tiempoReclamo.trim() === '') {
                alert('Por favor, ingrese un tiempo de reclamo válido.');
                event.preventDefault();
            }
    
            if (isNaN(precio) || precio <= 0) {
                alert('El precio debe ser un número válido y mayor que cero.');
                event.preventDefault();
            }
        };
    </script>
        

</body>
</html>