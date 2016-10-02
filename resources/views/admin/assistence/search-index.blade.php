@extends('layouts.default')
@section('title', 'Assistências')
@section('content')

<div class="container">

    <div class="panel panel-info">
        <div class="panel-heading">
            <h1><i class="fa fa-industry"></i> Buscar Assistências</h1>
        </div>
        <div class="panel-body">
            <div class="table-responsive col-sm-12">
                <table id ="table-pessoas" class="display table data-table table-condensed">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Endereço</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($assistences))

                            @foreach($assistences as $assistencia)
                                <tr>
                                    <td>{{ $assistencia['name'] }}</td>
                                    <td>{{ $assistencia['category'] }}</td>
                                    <td>{{ strlen($assistencia['Location']) >= 55 ?
                                        substr($assistencia['Location'], 0, 55) . ' ...' :
                                        $assistencia['Location']
                                    }}
                                    </td>
                                    <td>
                                        <a data-href="{{ route('search-assistence.show', $assistencia['rowid']) }}"
                                            class="btn btn-info btn-xs" data-target="#show-assistence-modal"
                                            href="" data-modal-open="" title="Ver Assistência">
                                            <i class="fa fa-search"></i>
                                        </a>
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
<div class="modal fade" id="show-assistence-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        
    </div>
</div>

@stop