<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="ModalLabel">Aprovar Assistência</h4>
    </div>
        {!! Form::open(['route' => 'assistence.store']) !!}
            <div class="modal-body">
                {!! Form::textField('name', 'Nome da Assistência', $assistencia->name) !!}
                {!! Form::radioInline('typeAssist', 'Tipo', [
                        'AUTORIZADA' => 'Autorizada',
                        'ESPECIALIZADA' => 'Especializada'
                    ], $assistencia->category)
                !!}
                {!! Form::textField('location', 'Endereço', $assistencia->location) !!}
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::numberField('fone', 'Telefone', $assistencia->fone) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::textField('businessHours', 'Horario de Funcionamento', $assistencia->businessHours) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::selectMultipleField(
                            'typeProduct',
                            'Tipos de produtos',
                            $typeProducts, [], json_decode($assistencia->typeProduct))
                        !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::selectMultipleField('brandsAttendedWarranty',
                            'Marcas Atendidas (Garantia)',
                            $brandsAttendeds, [], json_decode($assistencia->brandsAttendedWarranty))
                        !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::selectMultipleField('brandsAttended',
                            'Marcas Atendidas (Fora de garantia)',
                            $brandsAttendeds, [], json_decode($assistencia->brandsAttended))
                        !!}
                    </div>
                </div>
                <p>Segure a tecla Ctrl para selecionar mais de um item.</p>

                {!! Form::textareaField('info', 'Informações gerais', $assistencia->info) !!}
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success"
                    data-aprove-delete="{{ route('assistence-request.destroy', $assistencia->id) }}">
                    Salvar
                </button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        {!! Form::close() !!}
</div>
