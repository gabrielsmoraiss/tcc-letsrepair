@extends('layouts.default')
@section('title', 'Assistências')
@section('content')

<div class="container">

    <h1>Assistências</h1>

    <a href="{{ route('assistence.create') }}" class="btn btn-primary">
        Criar nova Assistência
    </a>

    <div class="table-responsive">

        <table id ="table-pessoas" class="display table table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Localização</th>
                    <th>Tipo de Produto</th>
                    <th>Marcas Atendidas</th>
                    <th>Gerenciar</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($assistences))

                    @foreach($assistences as $assistencia)
                        <tr>
                            <td>{{ $assistencia['name'] }}</td>
                            <td>{{ $assistencia['category'] }}</td>
                            <td>{{ $assistencia['Location'] }}</td>
                            <td>{{ $assistencia['typeProduct'] }}</td>
                            <td>{{ $assistencia['brandsAttended'] }}</td>
                            <td>
                                <a href="{{-- route('admin.pessoas.show', $pessoa->id) --}}" title="Ver Assistência"
                                	class="btn btn-xs btn-info">
                                    <i class="fa fa-search"></i>
                                </a>
                                <a data-href="{{ route('assistence.edit', $assistencia['name']) }}"
                                    class="btn btn-success btn-xs" data-target="#edit-assistence-modal"
                                    href="" data-modal-open="" title="Editar">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                {{--{!!  Form::open(['route' => ['admin.pessoas.destroy', $pessoa->id], 'method' => 'DELETE',
                                    'data-id' => $pessoa->id , 'class' => 'form-horizontal','style' => 'display: inline-block'])
                                !!}
	                                <button data-id="{{ $pessoa->id }}" type="submit" class="btn btn-sm btn-danger">
	                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Deletar
	                                </button>
                                {!! Form::close() !!}
                               --}}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<br/>

<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                	<span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Excluir</h4>
            </div>
            <div class="modal-body">
                <p>Deseja realmente excluir ?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger btn-delete">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Deletar
                </button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
</div>

<!-- Modal editar Assistencias -->
<div class="modal fade" id="edit-assistence-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">

    </div>
</div>

@stop