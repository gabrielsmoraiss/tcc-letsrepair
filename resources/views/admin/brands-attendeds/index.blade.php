@extends('layouts.default')
@section('title', 'Marcas Atendidas')
@section('content')

<div class="container">

    <h1>Marcas Atendidas</h1>

    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create-brands-attended">
      Criar novo Produto
    </button>
    <br/>
    <br/>
    <div class="table-responsive col-sm-12">
        <table class="display table data-table table-condensed">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descrição</th>
                    <th>Gerenciar</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($brandsAttendeds))

                    @foreach($brandsAttendeds as $brandsAttended)
                        <tr>
                            <td>{{ $brandsAttended->id }}</td>
                            <td>{{ $brandsAttended->description }}</td>
                            <td>
                                <a data-href="{{ route('brands-attended.edit', $brandsAttended->id) }}"
                                    class="btn btn-success btn-xs" data-target="#edit-brands-attended"
                                    href="" data-modal-open="" title="Editar">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                {!!  Form::open(['route' => ['brands-attended.destroy', $brandsAttended->id], 'method' => 'DELETE',
                                    'data-id' => $brandsAttended->id , 'class' => 'form-horizontal','style' => 'display: inline-block'])
                                !!}
	                                <button data-id="{{ $brandsAttended->id }}"
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

<!-- Modal editar produtos atendidos -->
<div class="modal fade" id="edit-brands-attended" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        
    </div>
</div>

<!-- Modal criar Protos atendidos -->
@include('admin.brands-attendeds.create')

@stop