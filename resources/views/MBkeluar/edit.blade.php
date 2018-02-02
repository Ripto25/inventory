@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Edit
@endsection


@section('main-content')

@if (session()->has('flash_notification.message'))
        <div class="container-fluid spark-screen">
        <div class="alert alert-{{ session()->get('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {!! session()->get('flash_notification.message') !!}
        </div>
        </div>
        @endif
        
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading"><ul class="breadcrumb">
<li><a href="{{ url('/home') }}">Beranda</a></li>
<li><a href="{{ url('member/memberbkeluar') }}">Barang Keluar</a></li>
<li class="active">Edit Data Barang Keluar</li>
</ul></div>

					<div class="panel-body">
						{!! Form::open(['url' => route('member.memberbkeluar.update', $MBkeluar->id),
'method'=>'put', 'class'=>'form-horizontal']) !!}
@include('MBkeluar.editform')
{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection






