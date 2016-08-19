<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="ModalLabel">Editar Assistência</h4>
    </div>
        {!! Form::model($assistencia, ['method' => 'PUT', 'route' => [
            'assistence.update', $assistencia['rowid']],
            'data-validate']) !!}
            <div class="modal-body">
                {!! Form::textField('name', 'Nome da Assistência') !!}
                {!! Form::radioInline('typeAssist', 'Tipo', [
                        'AUTORIZADA' => 'Autorizada',
                        'ESPECIALIZADA' => 'Especializada'
                    ], $assistencia['category'])
                !!}
                {!! Form::textField('location', 'Endereço', $assistencia['Location']) !!}
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::numberField('fone', 'Telefone', $assistencia['fone']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::textField('businessHours', 'Horario de Funcionamento', $assistencia['businessHours']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::selectMultipleField(
                            'typeProduct',
                            'Tipo do Produto',
                            [
                                'CELULARES' => 'celulares',
                                'ELETRONICOS' => 'Eletrônicos',
                                'GPS' => 'GPS',
                                'NOTEBOOK' => 'notebook'
                            ], [], json_decode($assistencia['typeProduct']))
                        !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::selectMultipleField('brandsAttended',
                            'Marca do produto',
                            ['samsung' => 'Samsung',
                                'lg' => 'lg',
                                'sony' => 'sony',
                                'dell' => 'dell' 
                            ], [], json_decode($assistencia['brandsAttended']))
                        !!}
                    </div>
                </div>
                {!! Form::textareaField('info', 'Informações gerais', $assistencia['info']) !!}
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Salvar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        {!! Form::close() !!}
</div>
