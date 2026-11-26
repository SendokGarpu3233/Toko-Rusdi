<!DOCTYPE html>
<head>
    <title>Halaman Login</title>
    <link href="{{asset('sbadmin/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js?render={{ env('RECAPTCHA_SITE_KEY') }}"></script>
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-body p-4">
                        <h3 class="text-center font-weight-bold mb-4">Login Toko</h3>

                        <form action="/login" method="POST">
                            @csrf
                            <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">

                            @if (session('error'))
                                <div class="alert alert-danger">{{session('error') }}</div>
                            @endif

                            <div class="form-group mb-3">
                                <label>Email:</label>
                                <input type="email" name="email" class="form-control"  value="{{old('email') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label>Password:</label><br>
                                <input type="password" name="password" class="form-control"     required>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        
                    </div>

                </div>

            </div>

        </div>

    </div>

    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('{{ env("RECAPTCHA_SITE_KEY") }}', {action: 'login'}).then(function(token) {
                document.getElementById('g-recaptcha-response').value = token;
            });                                      
        });
    </script>

        
        
</body>
</html>