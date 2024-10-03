<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - XRP Platform</title>
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-secondary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5 bg-dark text-light">

                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">Login</h3>
                                    </div>
                                    <div class="card-body">
                                        @if ($errors->any())
                                        @foreach ($errors->all() as $item)
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{$item}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @endforeach
                                        @endif
                                        <form action="/login" method="post">
                                            @csrf
                                            <div class="form-floating mb-3">
                                                <input class="form-control bg-dark text-light" name="email" id="inputEmail" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail" class="text-light">Correo Electrónico</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control bg-dark text-light" name="password" id="inputPassword" type="password" placeholder="Password" />
                                                <label for="inputPassword" class="text-light">Contaseña</label>
                                            </div>
                                            {{-- <div class="form-check mb-3">
                                                <input class="form-check-input bg-dark" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label text-light" for="inputRememberPassword">Recordar contraseña</label>
                                            </div> --}}
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                {{-- <a class="small text-light" href="password.html">¿Olvidó su contraseña?</a> --}}
                                                <button type="submit" class="btn btn-primary" style="width: 100%;">Ingresar</button>

                                            </div>
                                        </form>
                                    </div>
                                    {{-- <div class="card-footer text-center py-3">
                                        <div class="small"><a class="text-light" href="register.html">Need an account? Sign up!</a></div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-dark mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; XRP Comunicaciones 2024</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>
