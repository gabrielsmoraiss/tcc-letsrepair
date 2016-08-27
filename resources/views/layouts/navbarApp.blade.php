<div class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ url('index') }}">Let's Repair</a>
    </div>
    <div class="navbar-collapse collapse navbar-inverse-collapse">
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