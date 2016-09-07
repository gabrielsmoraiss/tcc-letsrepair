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
		<div class="col-sm-4">
			<div class="panel panel-info panel-filter">
				<div class="panel-heading">
					Buscar Assistências		
				</div>
				<div class="panel-body">
					
					<div class="filtro">
		                <form id="form-busca">
							{!! Form::textFieldIcon('address', 'Onde pesquisar', 'location-arrow') !!}
							{!! Form::numberFieldIcon('radius',
									'Área coberta pela busca (até 50km)',
									'arrows-h',
									'',
									['max' => 50],
									20
								)
							!!}
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


							<button type="submit"
			                    class="btn btn-success btn-raised btn-block"><i class="fa fa-filter"></i> Filtrar
			                </button>              
		                </form>
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
