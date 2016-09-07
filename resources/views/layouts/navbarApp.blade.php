<div class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand text-bold" href="{{ url('index') }}">Let's Repair</a>
    </div>
    <div class="navbar-collapse collapse navbar-inverse-collapse">
      <ul class="nav navbar-nav">
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
        <li><a href="{{ route('auth.login') }}"><i class="fa fa-sign-in text-lg"></i></a></li>
      </ul>
    </div>
  </div>
</div>