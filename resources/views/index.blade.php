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
			<div class="filtro">
				{!! Form::textField('myLocation', 'Meu Local', '', ['placeholder' => 'Digite o local de onde buscar']) !!}

				<button type="submit"
                    class="btn btn-success" id="js-filtrar"> Filtrar
                </button>
			</div>
		</div>
	</div>
</div>

@stop
