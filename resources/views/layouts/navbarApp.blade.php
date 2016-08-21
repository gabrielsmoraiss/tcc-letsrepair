<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ url('index') }}">Let's Repair</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="{{-- active('admin/index') --}}" >
                        <a href="{{-- route('admin.index') --}}">
                            Conhecimento
                        </a>
                    </li>
                    <li class="{{-- active('admin/assistence*') --}}">
                        <a href="{{-- route('admin.assistence') --}}" >
                            Pesquisar Assistências
                        </a>
                    </li>
                    <li class="{{ active('admin/assistence-requests*') }}">
                        <a href="{{ route('assistence-solicitation.create') }}" >
                            Cadastrar minha Empresa
                        </a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('auth.login') }}">Admin</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
