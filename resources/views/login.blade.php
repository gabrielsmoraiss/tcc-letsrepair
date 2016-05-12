@extends('admin.layouts.default')
@section('content')
    <section class="unique">
        <div class="container">
            <div class="col-sm-4 col-sm-offset-4">
                <div class="panel panelLogin panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Interako</h3>
                    </div>
                    <div class="panel-body">
                        <div id="form-login-container" class="show">
                            <p>Acesse o sistema com seu e-mail e senha</p>
                        
                            {!! Form::open(['route' => 'admin.authenticate', 'class' => 'form-horizontal']) !!}
                               
                                    <div class="col-sm-12">
                                        {!! Form::emailFieldClean('email', 'Email') !!}
                                    </div>
                                    <div class="col-sm-12">
                                         {!! Form::passwordFieldClean('password', 'Senha') !!}
                                    </div>
                                    <div class="col-sm-12">
                                         {!! Form::submitBtn('Entrar', 'btn btn-primary btn-block btn-entrar') !!}
                                    </div>
                                
                            {!! Form::close() !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@stop