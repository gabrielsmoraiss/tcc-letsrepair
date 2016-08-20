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
                {!! Form::textField('location', 'Endereço') !!}
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::numberField('fone', 'Telefone') !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::textField('businessHours', 'Horario de Funcionamento') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::selectMultipleField(
                            'typeProduct',
                            'Tipos de produtos',
                            ['CELULARES' => 'celulares',
                                    'ELETRONICOS' => 'Eletrônicos',
                                    'GPS' => 'GPS',
                                    'NOTEBOOK' => 'notebook'
                            ])
                        !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::selectMultipleField('brandsAttended',
                            'Produtos atendidos',
                            ['samsung' => 'Samsung',
                                'lg' => 'lg',
                                'sony' => 'sony',
                                'dell' => 'dell' 
                            ])
                        !!}
                    </div>
                </div>
                {!! Form::textareaField('info', 'Informações gerais') !!}

                <input type="submit" class="btn btn-success" value="Salvar"/>
                <a href="{{ route('auth-google') }}" class="btn btn-danger">
                    Voltar
                </a>
                
            {!! Form::close() !!}
        </div>
    </div>

</div>

@stop
