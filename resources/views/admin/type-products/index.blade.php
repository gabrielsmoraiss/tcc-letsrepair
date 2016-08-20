@extends('layouts.default')
@section('title', 'Tipos de Produtos')
@section('content')

<div class="container">

    <h1>Tipos de Produtos</h1>

    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#create-type-product">
      Criar novo tipo de Produto
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
                @if(!empty($typeProducts))

                    @foreach($typeProducts as $typeProduct)
                        <tr>
                            <td>{{ $typeProduct->id }}</td>
                            <td>{{ $typeProduct->description }}</td>
                            <td>
                                <a data-href="{{ route('type-product.edit', $typeProduct->id) }}"
                                    class="btn btn-success btn-xs" data-target="#edit-type-product"
                                    href="" data-modal-open="" title="Editar">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                {!!  Form::open(['route' => ['type-product.destroy', $typeProduct->id], 'method' => 'DELETE',
                                    'data-id' => $typeProduct->id , 'class' => 'form-horizontal','style' => 'display: inline-block'])
                                !!}
	                                <button data-id="{{ $typeProduct->id }}"
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

<!-- Modal editar typeProducts -->
<div class="modal fade" id="edit-type-product" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        
    </div>
</div>

<!-- Modal criar typeProducts -->
@include('admin.type-products.create')

@stop