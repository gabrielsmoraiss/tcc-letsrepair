@extends('layouts.default')
@section('title', 'Home')

@section('content')

<div class="container">
    <h1>Let's Repair!</h1>
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
				{!! Form::textField('whenSearch', 'Onde pesquisar', '', ['placeholder' => 'Digite o local de onde buscar']) !!}

				<button type="submit"
                    class="btn btn-success" id="js-filtrar"> Filtrar
                </button>
			</div>
		</div>
	</div>
</div>

@stop
