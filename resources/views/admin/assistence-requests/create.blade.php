@extends('layouts.default')
@section('title', 'Assistências')
@section('content')

<div class="container">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h1>Cadastrar Assistência</h1>
        </div>
        {!! Form::open(['route' => 'assistence-solicitation.store']) !!}
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-10">
                            {!! Form::textFieldM('name', 'Nome da Assistência') !!}
                            {!! Form::textFieldM('location', 'Endereço') !!}
                            <div class="row">
                                <div class="col-sm-4">
                                    {!! Form::selectMultipleFieldM(
                                        'typeProduct',
                                        'Tipos de produtos',
                                        $typeProducts, ['data-selectize'])
                                    !!}
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::selectMultipleFieldM('brandsAttendedWarranty',
                                        'Marcas Atendidas (Garantia)',
                                        $brandsAttendeds, ['data-selectize'])
                                    !!}
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::selectMultipleFieldM('brandsAttended',
                                        'Marcas Atendidas (Fora de garantia)',
                                        $brandsAttendeds, ['data-selectize'])
                                    !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    {!! Form::radioInline('category', 'Tipo', [
                                            'AUTORIZADA' => 'Autorizada',
                                            'ESPECIALIZADA' => 'Especializada'
                                        ], 'AUTORIZADA')
                                    !!}
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::textFieldM('fone', 'Telefone') !!}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p>Escolha os dias e horários de funcionamento</p>
                                    {!! Form::selectField('businessHoursDate',
                                        'Selecione os dias',
                                        [   
                                            'SEG-SEX' => 'Segunda á Sexta',
                                            'SEG-SAB' => 'Segunda á Sábado',
                                            'DOM-DOM' => 'Domingo á Domingo'
                                        ], ['data-selectize'])
                                    !!}
                                </div>
                                <p>Selecione os horários</p>
                                <div class="col-sm-4">
                                    {!! Form::textField(
                                            'HoursStart',
                                            'Abre as:'
                                        )
                                    !!}
                                </div>
                                <div class="col-sm-4">
                                    {!! Form::textField(
                                            'HoursEnd',
                                            'Fecha as:'
                                        )
                                    !!}
                                </div>
                            </div>

                            {!! Form::textareaFieldM('info', 'Informações gerais') !!}

                            
                            
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <input type="submit" class="btn btn-raised btn-success" value="Salvar"/>
                <a href="{{ route('auth-google') }}" class="btn btn-raised btn-danger">
                    Voltar
                </a>
            </div>
        {!! Form::close() !!}
    </div>

</div>

@stop
