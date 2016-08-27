@extends('layouts.default')
@section('title', 'Home')

@section('content')

<div class="container-fluid">
	<div class="row" >
		<div class="col-sm-8">
			<div class="panel">
				<div class="panel-body">
					<div id="map"></div>
				</div>
			</div>
		</div>
		<div class="col-sm-4" style="padding-left: 0">
			<div class="panel panel-info panel-filter">
				<div class="panel-heading">
					Buscar Assistências		
				</div>
				<div class="panel-body">
					
					<div class="filtro">
		                <form id="form-busca">
							{!! Form::textField('address', 'Onde pesquisar') !!}

							{!! Form::selectField('category',
								'Selecione o tipo da Assistência',
								['AUTORIZADA' => 'Autorizada',
									'ESPECIALIZADA' => 'Especializada
								'],
								['placeholder' => 'Buscar todos', 'data-selectize'])
							!!}
							{!! Form::selectField('typeProduct',
								'Selecione o tipo do produto',
								$typeProducts,
								['placeholder' => 'Buscar todos', 'data-selectize'])
							!!}

							{!! Form::selectField('brandsAttended',
								'Selecione a marca do produto',
								$brandsAttendeds,
								['placeholder' => 'Buscar todas as marcas', 'data-selectize'])
							!!}

							{!! Form::numberField('radius',
								'Área coberta pela busca (até 50km)',
								40000,
								['placeholder' => '25 km', 'max' => 50000])
							!!}

							<button type="submit"
			                    class="btn btn-success btn-raised btn-block"> Filtrar
			                </button>              
		                </form>
					</div>

					<div class="all">
						<button type="submit"
		                    class="btn btn-info btn-raised btn-block" id="js-everythingAroundMe">
		                    Buscar ao meu Redor
		                </button>
					</div>
					<br>
					<p>*Icones Amarelos: Assistência Autorizada;</p>
					<p>*Icones brancos: Assistência Especializada;</p>
				</div>
			</div>
		</div>
	</div>
</div>

@stop
