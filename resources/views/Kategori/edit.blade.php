@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Edit Kategori
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading"><ul class="breadcrumb">
<li><a href="{{ url('/home') }}">Beranda</a></li>
<li><a href="{{ route('admin.kategori.index') }}">Kategori</a></li>
<li class="active">Edit Data Kategori</li>
</ul></div>

					<div class="panel-body">
						{!! Form::model($Kategori, ['url' => route('admin.kategori.update', $Kategori->id),
'method'=>'put', 'class'=>'form-horizontal']) !!}
@include('Kategori._form')
{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection






