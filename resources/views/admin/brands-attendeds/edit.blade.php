<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="ModalLabel">Editar</h4>
    </div>
    {!! Form::model($brandsAttended, [
            'method' => 'PUT',
            'route' => ['brands-attended.update', $brandsAttended->id
        ],
        'data-validate']) !!}
        <div class="modal-body">
            {!! Form::textField('description', 'Descrição') !!}
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-success">Salvar</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
    {!! Form::close() !!}
</div>
