@extends('layouts.app')

@section('htmlheader_title')
	Laporan Data Barang 
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading"><ul class="breadcrumb">
						<li><a href="{{ url('/home') }}">Beranda</a></li>
						
						<li class="active"><strong>Laporan Data Barang</strong></li>
						</ul></div>
					<div class="panel-body">

					<div class="container">


					<div class="row">
					
					<br>
					
					
					<div class="col-md-5 col-md-offset-5"></div>
					<div class="col-md-7 col-md-offset-4">
					
					 </div>
					 </div>
					 </div>

					 <br>

					 <div class="row">
						
					<div class="col-md-5 col-md-offset-5">
						<span class="centering">{!! link_to('lapbrgdwn', $title = 'Cetak Laporan', $attributes = ['class'=>'btn btn-primary'], $secure = null) !!}</span>

						
					</div>
					

				</div>
				</div>
			</div>
		</div>
		</div>
		</div>
	</div>
@endsection



