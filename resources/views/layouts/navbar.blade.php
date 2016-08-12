<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" target="_blank" href="{{ route('index') }}">Let's Repair</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="{{ active('admin/index') }}" >
                        <a href="{{ route('admin.index') }}">
                            Home
                        </a>
                    </li>
                    <li class="{{ active('admin/assistence*') }}">
                        <a href="{{ route('assistence.index') }}" >
                            Assistências
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">{{ words($current_user->name, 2,'') }}<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('auth.logout') }}" >Sair</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
