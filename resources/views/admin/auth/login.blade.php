<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="Favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style type="text/css">
      @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);

      body {
        margin: 0;
        font-size: .9rem;
        font-weight: 400;
        line-height: 1.6;
        color: #212529;
        text-align: left;
        background-color: #f5f8fa;
      }

      .navbar-laravel {
        box-shadow: 0 2px 4px rgba(0, 0, 0, .04);
      }

      .navbar-brand,
      .nav-link,
      .my-form,
      .login-form {
        font-family: Raleway, sans-serif;
      }

      .my-form {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
      }

      .my-form .row {
        margin-left: 0;
        margin-right: 0;
      }

      .login-form {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
      }

      .login-form .row {
        margin-left: 0;
        margin-right: 0;
      }
    </style>
    <title>Admin Login</title>
  </head>
  <body>
    <main class="login-form">
      <div class="cotainer">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">Admin Login</div>
              <div class="card-body">
                @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
                 @endif
                <form method="POST" action="{{ route('login') }}">
                @csrf
                  <div class="form-group row">
                    <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                    <div class="col-md-6">
                      <input type="text" id="username" class="form-control" name="username" required autofocus>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                    <div class="col-md-6">
                      <input type="password" id="password" class="form-control" name="password" required>
                    </div>
                  </div>
                  <!-- <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="remember"> Remember Me </label>
                      </div>
                    </div>
                  </div> -->
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary"> Login </button>
                  </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      </div>
    </main>
  </body>
</html>