@extends('layouts.default')
@section('title', 'Assistências')
@section('content')

<div class="container">

    <div class="panel panel-info">
        <div class="panel-heading"><h1>Assistências</h1></div>
        <div class="panel-body">
            <a href="{{ route('assistence.create') }}" class="btn btn-success btn-raised">
                Criar nova Assistência
            </a>
            <div class="table-responsive col-sm-12">
                <table id ="table-pessoas" class="display table data-table table-condensed">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Gerenciar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($assistences))

                            @foreach($assistences as $assistencia)
                                <tr>
                                    <td>{{ $assistencia['name'] }}</td>
                                    <td>{{ $assistencia['category'] }}</td>
                                    <td>
                                        <a href="{{-- route('admin.pessoas.show', $assistencia['rowid']) --}}" title="Ver Assistência"
                                        	class="btn btn-xs btn-info">
                                            <i class="fa fa-search"></i>
                                        </a>
                                        <a data-href="{{ route('assistence.edit', $assistencia['rowid']) }}"
                                            class="btn btn-success btn-xs" data-target="#edit-assistence-modal"
                                            href="" data-modal-open="" title="Editar">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        {!!  Form::open(['route' => ['assistence.destroy', $assistencia['rowid']], 'method' => 'DELETE',
                                            'data-id' => $assistencia['rowid'] , 'class' => 'form-horizontal','style' => 'display: inline-block'])
                                        !!}
        	                                <button data-id="{{ $assistencia['rowid'] }}"
                                                type="submit" class="btn btn-xs btn-danger" title="Excluir"
                                            >
        	                                    <i class="fa fa-remove"></i>
        	                                </button>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
<br/>

<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog">
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
</div>

<!-- Modal editar Assistencias -->
<div class="modal fade" id="edit-assistence-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        
    </div>
</div>

@stop