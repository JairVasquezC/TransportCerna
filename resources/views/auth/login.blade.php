<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Inicio de sesión del sistema" />
    <meta name="author" content="SakCode" />
    <title> Transportes Cerna - Login</title>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: linear-gradient(to bottom right, #ffffff, #ffffff); /* Fondo degradado en tonos rojizos */
            font-family: 'Roboto', sans-serif;
            color: #343a40;
        }

        .card {
            background: #ffffff;
            border: none;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .card-header {
            background: #c82333; /* Rojo intenso */
            color: #fff;
            text-align: center;
            padding: 20px;
            border-radius: 10px 10px 0 0;
        }

        .card-header img {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .card-header h3 {
            margin: 0;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .btn-primary {
            background-color: #c82333; /* Botón rojo */
            border-color: #c82333;
            border-radius: 25px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #a71d2a; /* Rojo más oscuro */
            border-color: #9f1a24;
        }

        .form-control {
            border-radius: 25px;
            padding: 15px;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            border-color: #c82333;
            box-shadow: 0px 0px 5px rgba(200, 35, 51, 0.5);
        }

        .alert-danger {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
            border-radius: 5px;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            border-radius: 25px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .card-footer {
            text-align: center;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .card-footer a {
            color: #c82333;
            text-decoration: none;
            font-weight: bold;
        }

        .card-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg">
                                <div class="card-header">
                                    <img src="{{ asset('assets/img/logo_blanco.png') }}" alt="Logo Empresa">
                                    <h3>Acceso al Sistema</h3>
                                </div>
                                <div class="card-body">
                                    @if ($errors->any())
                                    @foreach ($errors->all() as $item)
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{$item}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    @endforeach
                                    @endif
                                    <form action="/login" method="post">
                                        @csrf
                                        <div class="form-floating mb-3">
                                            <input autofocus autocomplete="off" value="luz@gmail.com"
                                                class="form-control" name="email" id="inputEmail" type="email"
                                                placeholder="name@example.com" />
                                            <label for="inputEmail">Correo electrónico</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="password" value="12345678"
                                                id="inputPassword" type="password" placeholder="Password" />
                                            <label for="inputPassword">Contraseña</label>
                                        </div>
                                        <div
                                            class="d-flex align-items-center justify-content-center mt-4 mb-0 text-center">
                                            <button class="btn btn-primary" type="submit">Iniciar Sesión</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>
