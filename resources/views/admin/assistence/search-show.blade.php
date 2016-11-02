<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title" id="ModalLabel">{{ $assistencia['name'] }}</h3>
    </div>
        <div class="modal-body">
            <p><strong>Assistencia {{ strtolower($assistencia['category']) }}</strong></p>
            <p><strong>{{ $assistencia['Location'] }}</strong></p>
            <p><strong>Fone: </strong>{{ $assistencia['fone'] }}</p>
            <p><strong>Atende: </strong>
                {{ $assistencia['typeProduct'] }}
            </p>
            <p><strong>Marcas Atendidas em Garantia: </strong>
                {{ $assistencia['brandsAttendedWarranty'] }}
            </p>
            <p><strong>Fora de garantia: </strong>
                {{ $assistencia['brandsAttended'] }}
            </p>
            <p><strong>Horario de Funcionamento: </strong>
                {{ !empty($assistencia['hoursStart']) ?
                    $assistencia['businessHoursDate'] . ' - ' . $assistencia['hoursStart'] . ' ás ' .
                    $assistencia['hoursEnd'] : $assistencia['businessHoursDate']
                }}
            </p>
            <p>{{ $assistencia['info'] }}</p>

            <a class="btn btn-info btn-xs btn-raised"
                href="{{ route('index', ['assistence' => $assistencia['rowid']]) }}">
                <i class="fa fa-search"></i> Ver no Mapa
            </a>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
</div>
