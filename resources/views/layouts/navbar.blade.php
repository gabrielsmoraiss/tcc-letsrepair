<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Let's Repair</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="{{-- active('admin/index') --}}" >
                        <a href="{{-- route('admin.index') --}}">Home</a>
                    </li>
                    <li class="{{-- active('admin/pessoas*') --}}">
                        <a href="{{-- route('admin.pessoas.index') --}}" >Pessoas</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">//<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{-- route('admin.logout') --}}" >Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
