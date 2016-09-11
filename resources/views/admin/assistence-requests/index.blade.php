@extends('layouts.default')
@section('title', 'Assistências')
@section('content')

<div class="container">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h1>Aprovar assistências</h1>
            <p>Assistencias para aprovar</p>
        </div>
        <div class="panel-body">
            

            <br/>
            <br/>
            <div class="table-responsive col-sm-12">
                <table id ="table-pessoas" class="display table data-table table-condensed">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Localização</th>
                            <th>Atende</th>
                            <th>Gerenciar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($assistences->count())

                            @foreach($assistences as $assistencia)
                                <tr>
                                    <td>{{ $assistencia->name }}</td>
                                    <td>{{ $assistencia->category }}</td>
                                    <td>{{ $assistencia->location }}</td>
                                    <td>{{ $assistencia->present()->businessHours }}</td>
                                    <td>
                                        <a data-href="{{ route('assistence-request.edit', $assistencia->id) }}"
                                            class="btn btn-success btn-xs" data-target="#aprove-assistence-request"
                                            href="" data-modal-open="" title="Editar">
                                            <i class="fa fa-check"></i>
                                        </a>
                                        {!!  Form::open([
                                                'route' => [
                                                    'assistence-request.destroy',
                                                    $assistencia->id
                                                ],
                                                    'method' => 'DELETE',
                                                    'data-id' => $assistencia->id ,
                                                    'class' => 'form-horizontal',
                                                    'style' => 'display: inline-block'
                                                ]
                                            )
                                        !!}
        	                                <button data-id="{{ $assistencia->id }}"
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
<div class="modal fade" id="aprove-assistence-request" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        
    </div>
</div>

@stop