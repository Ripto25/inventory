@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading"><ul class="breadcrumb">
<li><a href="{{ url('/home') }}">Dashboard</a></li>
<li><a href="{{ route('admin.satuan.index') }}">Satuan</a></li>
<li class="active">Edit Data Satuan</li>
</ul></div>

					<div class="panel-body">
						{!! Form::model($Satuan, ['url' => route('admin.satuan.update', $Satuan->id),
'method'=>'put', 'class'=>'form-horizontal']) !!}
@include('Satuan._form')
{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection






