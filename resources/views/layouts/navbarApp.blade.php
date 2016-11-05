<div class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="pad-rgt" href="{{ url('index') }}">
        <img style="width: 80px; background-color: rgba(0, 0, 0, 0.1);" src="{{ asset('assets/images/logoClean.png') }}">
      </a>
    </div>
    <div class="navbar-collapse collapse navbar-inverse-collapse">
      <ul class="nav navbar-nav">
        <li class="{{ active('admin/assistence*') }}">
            <a href="{{ route('search-assistence.index') }}" >
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
        <li><a href="{{ route('auth.login') }}"><i class="fa fa-sign-in text-lg"></i></a></li>
      </ul>
    </div>
  </div>
</div>