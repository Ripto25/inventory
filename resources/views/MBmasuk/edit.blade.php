@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Edit Barang Masuk
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading"><ul class="breadcrumb">
<li><a href="{{ url('/home') }}">Beranda</a></li>
<li><a href="{{ url('member/memberbmasuk') }}">Barang Masuk</a></li>
<li class="active">Edit Data Barang Masuk</li>
</ul></div>

					<div class="panel-body">
						{!! Form::open(['url' => route('member.memberbmasuk.update', $MBmasuk->id),
'method'=>'put', 'class'=>'form-horizontal']) !!}
@include('MBmasuk.editform')
{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection






