@extends('layouts.default')
@section('title', 'Assistências')
@section('content')

<div class="container">
    
    <div class="panel panel-info">
        <div class="panel-heading">
            <h1>Assistências</h1>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-sm-10">
                    {!! Form::open(['route' => 'assistence.store']) !!}
                        {!! Form::textFieldM('name', 'Nome da Assistência') !!}
                        {!! Form::radioInline('typeAssist', 'Tipo', [
                                'AUTORIZADA' => 'Autorizada',
                                'ESPECIALIZADA' => 'Especializada'
                            ], 'AUTORIZADA')
                        !!}
                        {!! Form::textFieldM('location', 'Endereço') !!}
                        <div class="row">
                            <div class="col-sm-6">
                                {!! Form::textFieldM('fone', 'Telefone') !!}
                            </div>
                            <div class="col-sm-6">
                                {!! Form::textFieldM('businessHours', 'Horario de Funcionamento') !!}
                            </div>
                        </div>
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
                        
                        {!! Form::textareaFieldM('info', 'Informações gerais') !!}

                        <input type="submit" class="btn btn-raised btn-success" value="Salvar"/>
                        <a href="{{ route('auth-google') }}" class="btn btn-raised btn-danger">
                            Voltar
                        </a>
                        
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

</div>

@stop
