@extends('layouts.default')
@section('title', 'Assistências')
@section('content')

<div class="container">

    <h1>Cadastrar Assistência</h1>

    <div class="row">
        <div class="col-sm-10">
            {!! Form::open(['route' => 'assistence-solicitation.store']) !!}
                {!! Form::textField('name', 'Nome da Assistência') !!}
                {!! Form::textField('location', 'Endereço') !!}
                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::radioInline('category', 'Tipo', [
                                'AUTORIZADA' => 'Autorizada',
                                'ESPECIALIZADA' => 'Especializada'
                            ], 'AUTORIZADA')
                        !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::numberField('fone', 'Telefone') !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::textField('businessHours', 'Horario de Funcionamento') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::selectMultipleField(
                            'typeProduct',
                            'Tipos de produtos',
                            $typeProducts)
                        !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::selectMultipleField('brandsAttendedWarranty',
                            'Marcas Atendidas (Garantia)',
                            $brandsAttendeds)
                        !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::selectMultipleField('brandsAttended',
                            'Marcas Atendidas (Fora de garantia)',
                            $brandsAttendeds)
                        !!}
                    </div>
                </div>
                <p>Segure a tecla Ctrl para selecionar mais de um item.</p>
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
