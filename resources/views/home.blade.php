@extends('layouts.app')

@section('htmlheader_title')
	Home
@endsection


@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Beranda</div>

					<div class="panel-body">
						<center><!-- <img src="{{asset('/img/Lo.png')}}" class="img-circle"  width= "700px" alt="User Image" /> --> <h1>Inventory App</h1><br>
						<img src="{{asset('/img/store.png')}}" class="img-circle"  width= "200px" alt="User Image" /></center>
					</div>
					<center><h3>Selamat Datang ... {{ Auth::user()->name }}</h3></center>
				</div>
			</div>
		</div>
	</div>
@endsection
