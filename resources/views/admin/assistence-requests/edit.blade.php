<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="ModalLabel">Aprovar Assistência</h4>
    </div>
        {!! Form::open(['route' => 'assistence.store']) !!}
            <div class="modal-body">
                {!! Form::textFieldM('name', 'Nome da Assistência', $assistencia->name) !!}
                {!! Form::textFieldM('location', 'Endereço', $assistencia->location) !!}
                <div class="row">
                    <div class="col-sm-4">
                        {!! Form::selectMultipleFieldM(
                            'typeProduct',
                            'Tipos de produtos',
                            $typeProducts, ['data-selectize'], json_decode($assistencia->typeProduct))
                        !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::selectMultipleFieldM('brandsAttendedWarranty',
                            'Marcas Atendidas (Garantia)',
                            $brandsAttendeds, ['data-selectize'], json_decode($assistencia->brandsAttendedWarranty))
                        !!}
                    </div>
                    <div class="col-sm-4">
                        {!! Form::selectMultipleFieldM('brandsAttended',
                            'Marcas Atendidas (Fora de garantia)',
                            $brandsAttendeds, ['data-selectize'], json_decode($assistencia->brandsAttended))
                        !!}
                    </div>
                </div>
                <div class="pad-ver row">
                    <div class="col-sm-6">
                        {!! Form::radioInlineM('typeAssist', 'Tipo', [
                                'AUTORIZADA' => ' Autorizada',
                                'ESPECIALIZADA' => ' Especializada'
                            ], $assistencia->category)
                        !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::textFieldM('fone', 'Telefone', $assistencia->fone) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <label>Dias e horários de funcionamento</label>
                        {!! Form::selectField('businessHoursDate',
                            'Selecione os dias',
                            [   
                                'SEG-SEX' => 'Segunda á Sexta',
                                'SEG-SAB' => 'Segunda á Sábado',
                                'DOM-DOM' => 'Domingo á Domingo'
                            ], ['data-selectize'], $assistencia->businessHoursDate)
                        !!}
                    </div>
                    <div style="margin-top: 35px" class="col-sm-4">
                        {!! Form::textField(
                                'hoursStart',
                                'Abre as:',
                                $assistencia->hoursStart
                            )
                        !!}
                    </div>
                    <div style="margin-top: 35px" class="col-sm-4">
                        {!! Form::textField(
                                'hoursEnd',
                                'Fecha as:',
                                $assistencia->hoursEnd
                            )
                        !!}
                    </div>
                </div>
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
