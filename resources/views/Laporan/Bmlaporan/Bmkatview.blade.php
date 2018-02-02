@extends('layouts.app')

@section('htmlheader_title')
	Laporan Barang Masuk
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading"><ul class="breadcrumb">
<li><a href="{{ url('/home') }}">Beranda</a></li>
<li><a href="{{ url('/lapbm') }}">Laporan Barang Masuk</a></li>
<li class="active">Laporan Barang Masuk Per kategori</li>
</ul></div>


				<div class="panel-body">
					
					

    			    {!! Form::open(['url' => url('lapbmkattampil'),
                    'method' => 'POST', 'class'=>'form-horizontal']) !!}


					<div class="form-group{{ $errors->has('kode_barang') ? ' has-error' : '' }}">
					{!! Form::label('kategori', 'Masukan Kategori Barang', ['class'=>'col-md-4 control-label']) !!}
					<div class="col-md-4">

				{!! Form::select('kategori_id', [''=>'']+App\Barang::pluck('nama_barang','id')->all(), null, ['class'=>'form-control', 'placeholder' => 'Pilih kategori']) !!}

						
					
					{!! $errors->first('kode_barang', '<p class="help-block">:message</p>') !!}
					</div>
					</div>

                  
         
					<div class="form-group">
					<div class="col-md-6 col-md-offset-5">
					{!! Form::submit('Cetak', ['class'=>'btn btn-primary']) !!}
					</div>
					</div>
				



                    {!! Form::close() !!}

                   
   
   				</div>

						


			</div>
		</div>
		</div>
		</div>
	
@endsection



