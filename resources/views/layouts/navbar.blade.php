<div class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('index-admin') }}">Let's Repair</a>
    </div>
    <div class="navbar-collapse collapse navbar-inverse-collapse">
        <ul class="nav navbar-nav">
            <li class="{{ active('admin/index') }}" >
                <a href="{{ route('admin.index') }}">
                    Home
                </a>
            </li>
            <li class="{{ active('admin/assistence*') }}">
                <a href="{{ route('auth-google') }}" >
                    Assistências
                </a>
            </li>
            <li class="{{ active('admin/assistence-requests*') }}">
                <a href="{{ route('assistence-request.index') }}" >
                    Aprovar assistências
                </a>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">Cadastros <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('type-product.index') }}" >Tipos de Produto</a></li>
                    <li><a href="{{ route('brands-attended.index') }}" >Marcas Atendidas</a></li>
                </ul>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"></a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                   aria-expanded="false">{{ words($current_user->name, 2,'') }} <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('auth.logout') }}" >Sair</a></li>
                </ul>
            </li>
        </ul>
    </div>
  </div>
</div>