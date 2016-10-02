<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="ModalLabel">Assistência: {{ $assistencia['name'] }}</h4>
    </div>
        <div class="modal-body">
            <p><strong>Categoria: </strong>{{ $assistencia['category'] }}</p>
            <p><strong>Endereço: </strong>{{ $assistencia['Location'] }}</p>
            <p><strong>Telefone: </strong>{{ $assistencia['fone'] }}</p>
            <p><strong>Tipos de produtos: </strong>
                {{ $assistencia['typeProduct'] }}
            </p>
            <p><strong>Marcas Atendidas (Garantia): </strong>
                {{ $assistencia['brandsAttendedWarranty'] }}
            </p>
            <p><strong>Marcas Atendidas (Fora de garantia): </strong>
                {{ $assistencia['brandsAttended'] }}
            </p>
            <p><strong>Horario de Funcionamento: </strong>
                {{ $assistencia['businessHoursDate'] . ' ' .
                    $assistencia['hoursStart'] . ' ás ' .
                    $assistencia['hoursEnd']
                }}
            </p>
            <p><strong>Informações gerais: </strong>{{ $assistencia['info'] }}</p>

            <a class="btn btn-info btn-xs btn-raised"
                href="{{ route('index', ['assistence' => $assistencia['rowid']]) }}">
                <i class="fa fa-search"></i> Ver no Mapa
            </a>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
</div>
