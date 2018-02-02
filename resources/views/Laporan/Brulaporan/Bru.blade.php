@extends('layouts.app')

@section('htmlheader_title')
	Laporan Barang Rusak
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading"><ul class="breadcrumb">
						<li><a href="{{ url('/home') }}">Beranda</a></li>
						
						<li class="active"><strong>Laporan Barang Rusak</strong></li>
						</ul></div>
					<div class="panel-body">

					<div class="container">


					<div class="row">
					
					<br>
					
					
					<div class="col-md-5 col-md-offset-4"></div>
					<div class="col-md-7 col-md-offset-4">
					<strong>Silahkan Pilih Cara Cetak</strong>
					 </div>
					 </div>
					 </div>

					 <br>

					 <div class="row">
						
					<div class="col-md-5 col-md-offset-4">
						<span class="centering">{!! link_to('lapbrudwn', $title = 'Semua Laporan', $attributes = ['class'=>'btn btn-primary'], $secure = null) !!}</span>
<span>&nbsp &nbsp</span>
						<span class="tn btn-success">{!! link_to('lapbruperiode', $title = 'Laporan Per periode', $attributes = ['class'=>'btn btn-success'], $secure = null) !!}</span>
					</div>
					<div class="col-md-5 col-md-offset-4"></div>

				</div>
				</div>
			</div>
		</div>
		</div>
		</div>
	</div>
@endsection



