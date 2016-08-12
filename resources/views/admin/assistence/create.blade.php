@extends('layouts.default')
@section('title', 'Assistências')
@section('content')

<div class="container">

    <h1>Assistências</h1>

    <div class="row">
        <div class="col-sm-8">
            {!! Form::open(['route' => 'assistence.store']) !!}
                {!! Form::textField('name', 'Nome da Assistência') !!}
                {!! Form::radioInline('typeAssist', 'Tipo', [
                        'AUTORIZADA' => 'Autorizada',
                        'ESPECIALIZADA' => 'Especializada'
                    ], 'AUTORIZADA')
                !!}
                {!! Form::textField('Location', 'Endereço') !!}
                {!! Form::textareaField('info', 'Informações gerais') !!}
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::selectField(
                            'typeProduct',
                            'Tipo do Produto',
                            ['CELULARES' => 'celulares',
                                    'ELETRONICOS' => 'Eletrônicos',
                                    'GPS' => 'GPS',
                                    'NOTEBOOK' => 'notebook'
                            ])
                        !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::selectField('brandsAttended',
                            'Marca do produto',
                            ['samsung' => 'Samsung',
                                'lg' => 'lg',
                                'sony' => 'sony',
                                'dell' => 'dell' 
                            ])
                        !!}
                    </div>
                </div>

                {!! Form::submitBtn('Salvar') !!}

                <a href="{{ route('assistence.index') }}" class="btn btn-danger">
                    Voltar
                </a>
                
            {!! Form::close() !!}
        </div>
    </div>

</div>

@stop
