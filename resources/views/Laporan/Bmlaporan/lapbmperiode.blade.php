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
<li class="active">Laporan Barang Masuk Per Periode</li>
</ul></div>
				<div class="panel-body">
					
					

    			    {!! Form::open(['url' => url('lapbmperiodetampil'),
                    'method' => 'POST', 'class'=>'form-horizontal']) !!}

                   

                    <div class="form-group{{ $errors->has('dari') ? ' has-error' : '' }}">
					{!! Form::label('dari', 'Dari', ['class'=>'col-md-4 control-label']) !!}
					<div class="col-md-4">
					{!! Form::date('dari', null, ['class'=>'form-control']) !!}
					{!! $errors->first('dari', '<p class="help-block">:message</p>') !!}
					</div>
					</div>
					 

					 <div class="form-group{{ $errors->has('sampai') ? ' has-error' : '' }}">
					{!! Form::label('sampai', 'Sampai', ['class'=>'col-md-4 control-label']) !!}
					<div class="col-md-4">
					{!! Form::date('sampai', null, ['class'=>'form-control']) !!}
					{!! $errors->first('sampai', '<p class="help-block">:message</p>') !!}
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



