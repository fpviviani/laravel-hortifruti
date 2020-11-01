<!DOCTYPE html>
<html lang="en">
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="{{url('')}}"><img src="{{ asset('images/logo.png') }}" height="80px"></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    @if(Request::is('*store*'))
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="{{ url('') }}">Inicio</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact">Contato</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="store">Loja</a></li>
                    @if(Auth::user())
                        @if(Auth::user()->name == "Super Admin")
                            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="buys/not-delivered">Painel</a></li>
                        @endif
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="logout"
                            <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Deslogar
                            </a>
                        </li>
                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @else
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="login">Login</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</html>
