@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Edit Barang
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading"><ul class="breadcrumb">
<li><a href="{{ url('/home') }}">Beranda</a></li>
<li><a href="{{ route('admin.barang.index') }}">Barang</a></li>
<li class="active">Edit Data Barang</li>
</ul></div>

					<div class="panel-body">
						{!! Form::model($Barang, ['url' => route('admin.barang.update', $Barang->id),
'method'=>'put', 'class'=>'form-horizontal']) !!}
@include('Barang._form')
{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection






