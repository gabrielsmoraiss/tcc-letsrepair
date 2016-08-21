@extends('layouts.default')
@section('title', 'Home')

@section('content')

<div class="container">
	<div class="row" >
		<div class="col-sm-8">
			<div style="height: 500px" id="map"></div>
		</div>
		<div class="col-sm-4">
			<div class="all">
				<div class="row" >
					<div class="col-sm-12">
						<button type="submit"
		                    class="btn btn-info" id="js-everythingAroundMe">
		                    Buscar tudo ao meu Redor
		                </button>
					</div>
				</div>
			</div>
			<br>
			<div class="filtro">
                <form id="form-busca">
					{!! Form::textField('address', 'Onde pesquisar', '',
						['placeholder' => 'Digite o local de onde buscar'])
					!!}

					{!! Form::selectField('category',
						'Selecione o tipo da Assistência',
						['AUTORIZADA' => 'Autorizada',
							'ESPECIALIZADA' => 'Especializada
						'],
						['placeholder' => 'Buscar todos'])
					!!}

					{!! Form::selectField('typeProduct',
						'Selecione o tipo do produto',
						$typeProducts,
						['placeholder' => 'Buscar todos'])
					!!}

					{!! Form::selectField('brandsAttended',
						'Selecione a marca do produto',
						$brandsAttendeds,
						['placeholder' => 'Buscar todas as marcas'])
					!!}

					{!! Form::numberField('radius',
						'Área coberta pela busca (até 50km)',
						40000,
						['placeholder' => '25 km', 'max' => 50000])
					!!}

					<button type="submit"
	                    class="btn btn-success"> Filtrar
	                </button>              
                </form>
			</div>
			<br>
			<p>*Icones Amarelos: Assistência Autorizada;</p>
			<p>*Icones brancos: Assistência Especializada;</p>
		</div>
	</div>
</div>

@stop
