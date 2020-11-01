<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>InfyOm Laravel Generator | Registration Page</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/AdminLTE.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/css/skins/_all-skins.min.css">

    <!-- iCheck -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/skins/square/_all.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .register-page::before {
            content: "";
            position: fixed;
            left: -5%;
            top: -5%;
            right: 0;
            z-index: -1;

            display: block;
            background-image: url("{{asset('images/bg2.jpg')}}");
            background-size: cover;
            width: 110%;
            height: 110%;

            filter: brightness(60%) blur(9px) grayscale(20%);
        }
    </style>
    @include('vendor.input-customizer.masks')
	@stack('css')
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="{{ url('/home') }}"><img src="{{ asset('images/logo.png') }}" height="80px"></a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Crie sua conta agora mesmo</p>

        <form method="post" action="{{ url('/register') }}">

            {!! csrf_field() !!}

            <div class="form-group has-feedback{{ $errors->has('name') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Nome completo">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('sex') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="sex" value="{{ old('sex') }}" placeholder="Sexo">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('sex'))
                    <span class="help-block">
                        <strong>{{ $errors->first('sex') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('cpf') ? ' has-error' : '' }}">
                <input type="text" class="form-control document-mask" name="cpf" value="{{ old('cpf') }}" placeholder="CPF">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>

                @if ($errors->has('cpf'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cpf') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('adress') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="adress" value="{{ old('adress') }}" placeholder="Endereço">
                <span class="glyphicon glyphicon-globe form-control-feedback"></span>

                @if ($errors->has('adress'))
                    <span class="help-block">
                        <strong>{{ $errors->first('adress') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('neighborhood') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="neighborhood" value="{{ old('neighborhood') }}" placeholder="Bairro">
                <span class="glyphicon glyphicon-globe form-control-feedback"></span>

                @if ($errors->has('neighborhood'))
                    <span class="help-block">
                        <strong>{{ $errors->first('neighborhood') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                <input type="text" class="form-control zipcode-mask" name="zip_code" value="{{ old('zip_code') }}" placeholder="CEP">
                <span class="glyphicon glyphicon-globe form-control-feedback"></span>

                @if ($errors->has('zip_code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('zip_code') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('complement') ? ' has-error' : '' }}">
                <input type="text" class="form-control" name="complement" value="{{ old('complement') }}" placeholder="Complemento">
                <span class="glyphicon glyphicon-globe form-control-feedback"></span>

                @if ($errors->has('complement'))
                    <span class="help-block">
                        <strong>{{ $errors->first('complement') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control email-mask" name="email" value="{{ old('email') }}" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" name="password" placeholder="Senha">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group has-feedback{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmação de senha">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>

                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4 pull-right">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Cadastrar</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <a href="{{ url('/login') }}" class="text-center">Já possuo uma conta</a>
    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/2.4.3/js/adminlte.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/iCheck/1.0.2/icheck.min.js"></script>

<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
@stack('scripts')
</body>
</html>
