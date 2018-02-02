@extends('layouts.app')

@section('htmlheader_title')
	User
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

						
					<div class="panel-heading">Data User</div>

					<div class="panel-body">
						{{-- {!! Form::open(['url' => route('admin.member.store'),
					'method' => 'post', 'class'=>'form-inline']) !!}
					@include('Member._form')
					{!! Form::close() !!} --}}
					
					<a href="{{ route('admin.member.create') }}">
<button type="button" class="btn btn-success">Tambah Data</button></a>
					<div class="panel-heading"></div>
					<table class="table table-striped data">
						<thead><tr>
						<th>No</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Action</th>
						</tr></thead><tbody>
							<?php $no=1; ?>
						@foreach($Member as $Members)
						<tr><td>{{$no++}}</td>
							<td>{{ $Members->name }}</td>
							<td>{{ $Members->email }}</td>
							
							
<td><div class="row">
	<div class="col-md-3 col-sm-5 col-xs-10">
		<a href="{{ route('admin.member.index') }}/{{ $Members->id }}/edit"><button type="button" class="btn btn-primary">Edit</button></a>
	</div>
	<div class="col-md-3 col-sm-5 col-xs-10">
		<form action="{{ route('admin.member.index') }}/{{$Members->id}}" method="POST">
			<input type="hidden" name="_method" value="delete"></input>
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input class="btn btn-danger" type="submit" name="name" value="delete" >
		</form></div></div>
	</td>
							</tr>
							@endforeach
						</tbody>
						</table>
						{{-- {{ $Member->links() }} --}}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection



