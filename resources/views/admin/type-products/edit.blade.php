<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="ModalLabel">Editar</h4>
    </div>
    {!! Form::model($typeProduct, [
            'method' => 'PUT',
            'route' => ['type-product.update', $typeProduct->id
        ],
        'data-validate']) !!}
        <div class="modal-body">
            {!! Form::textFieldM('description', 'Descrição') !!}
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Salvar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    {!! Form::close() !!}
</div>
