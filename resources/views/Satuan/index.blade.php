@extends('layouts.app')

@section('htmlheader_title')
	Satuan
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
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">Satuan</div>

					<div class="panel-body">
						{!! Form::open(['url' => route('admin.satuan.store'),
					'method' => 'post', 'class'=>'form-inline']) !!}
					@include('Satuan._form')
					{!! Form::close() !!}
					<div class="panel-heading"></div>
					<div class="panel-heading"></div>
					<table class="table table-striped data">
						<thead><tr>
						<th>No</th>
						<th>Kode Satuan</th>
						<th>Nama Satuan</th>
						<th>Actions</th>
						</tr></thead><tbody>
							<?php $no=1; ?>
						@foreach($Satuan as $Satuans)
						<tr>
							<td>{{ $no++ }}</td>
							<td>{{ $Satuans->kode_satuan }}</td>
							<td>{{ $Satuans->nama_satuan }}</td>
							<td><div class="row">
            <div class="col-md-2 col-sm-5 col-xs-10">
								<a href="{{ route('admin.satuan.index') }}/{{ $Satuans->id }}/edit"><button type="button" class="btn btn-primary">Edit</button></a>
								</div>
								<div class="col-md-2 col-sm-5 col-xs-10">
								
									
									<form action="{{route('admin.satuan.index') }}/{{$Satuans->id}}" method="POST">
										<input type="hidden" name="_method" value="delete"></input>
										<input type="hidden" name="_token" value="{{csrf_token()}}">
										<input class="btn btn-danger" type="submit" name="name" value="delete" >
									</form></div></div>
								</td>
							</tr>
							@endforeach
						</tbody>
						</table>
						{{ $Satuan->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection



