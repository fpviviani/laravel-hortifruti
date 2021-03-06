<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Hortifruti</title>

    <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('css/front_style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/front_bootstrap.min.css') }}">

  <!-- Custom styles for this template -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        #mainNav {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            background-color: #fff;
            transition: background-color 0.2s ease;
        }
        .bg-light {
            background-color: #f4623a !important;
        }
        .header-bg{
            filter: brightness(60%) blur(9px) grayscale(20%);
        }
        .font-weight-bold {
            font-weight: 700 !important;
        }
        .text-uppercase {
            text-transform: uppercase !important;
        }
        .header-loja {
            padding-top: 10rem;
            padding-bottom: calc(10rem - 4.5rem);
            background: linear-gradient(to bottom, rgba(92, 77, 66, 0.8) 0%, rgba(92, 77, 66, 0.8) 100%), url("{{ asset('images/bg3.jpg') }}");
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: scroll;
            background-size: cover;
        }
        .text-muted {
            color: #ffffff!important;
        }
        #mainNav .navbar-nav .nav-item .nav-link {
            color: #212529;
            font-family: "Merriweather Sans", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-weight: 700;
            font-size: 0.9rem;
            padding: 0 1rem;
        }
        .btn-primary {
            color: #fff;
            background-color: #f4623d;
            border-color: #c64402;
        }
        .btn-primary:hover {
            background-color: #c64402!important;
            border-color: #c64402!important;
            box-shadow: 0 0 0 0.2rem rgba(38,143,255,.5)!important;
        }
        .btn-primary:focus {
            background-color: #c64402!important;
            border-color: #c64402!important;
            box-shadow: 0 0 0 0.2rem rgba(38,143,255,.5)!important;
        }
    </style>
</head>

<body>
  <!-- Navigation -->
  @include('layouts.front_navbar')

  <div class="header-loja">
  </div>

  <div class="container">
    <div class="row">
        @foreach($products as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 col-6 mb-4">
                <div class="card h-100">
                    <a href="#"><img class="card-img-top" src="{{$product->photo}}" alt=""></a>
                    <div class="card-body">
                        <h5 class="card-title">
                        {{$product->name}}
                        </h5>
                        <h5>R${{str_replace(".", ",", $product->price)}}</h5>
                        <h5>Disponível: {{$product->stock}} unidades.</h5>
                        <button type="button" class="btn btn-primary btn-loja"  product-id="{{$product->id}}" quantity="{{$product->stock}}"  data-toggle="modal" data-target="#exampleModalCenter">
                        Adicionar ao carrrinho
                        </button>
                    </div>
                </div>
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Quantas unidades?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group input-numero mb-3">
                            <input type="number" class="form-control quantity-input" placeholder="Unidades" aria-label="quantidade" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary add-button">Adicionar</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if(Auth::user() && Auth::user()->name != "Super Admin")
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('cart.index', Auth::user()->id) }}">
                    <button type="button" class="btn btn-primary">
                        Visualizar carrrinho
                    </button>
                </a>
            </div>
        </div>
    @endif
    <!-- /.row -->
  </div>
  @include('layouts.front_footer')

  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('js/front_jquery.min.js') }}"></script>
  <script src="{{ asset('js/front_bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/front_script.js') }}"></script>

    <!-- Custom Scripts -->
    <script type="text/javascript">

        // Dynamically fill address
        $(document).ready(function() {
            var authUser = "{{{ (Auth::user()) ? Auth::user() : null }}}";
            if(authUser.length != 0){
                var authUserParsed = JSON.parse(authUser.replace(/&quot;/g,'"'));
            }else{
                var authUserParsed = null;
            }
            var inputQuantity = 0;
            var productId = 0;
            var availableQuantity = 0;

            $(".quantity-input").on("change", function() {
                if(authUser.length == 0){
                    alert("É necessário logar primeiro.");
                    window.location.href = "{{ url('/login') }}";
                }

                inputQuantity = $(this).val();
                if (parseInt(inputQuantity) > parseInt(availableQuantity) || parseInt(inputQuantity) < 0){
                    alert("Não é possível encomendar a quantidade desejada. Disponíveis: " + availableQuantity);
                    $(this).val("0");
                    return false;
                }
            });

            $(".btn-loja").on("click", function() {
                availableQuantity = $(this).attr("quantity");
                productId = $(this).attr("product-id");
            });

            $(".add-button").on("click", function() {
                if(authUser.length != 0){
                    var userId = authUserParsed["id"];
                }   
                route = "{{ route('cart.modify', ':user_id') }}";
                route = route.replace(":user_id", userId);

                // Ajax request
                $.ajax({
                    url: route,
                    dataType: "json",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        productId: productId,
                        quantity: inputQuantity,
                        type: "add"
                    },
                    success: function(response) {
                        if(response.inserted == true){
                            alert("Produto adicionado ao carrinho com sucesso!");
                        }else{
                            alert("Não foi possível adicionar o produto ao carrinho.");
                        }
                        location.reload();
                    }
                });
            });

        });
    </script>
</body>
</html>