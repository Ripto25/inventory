@extends('layouts.app')

@section('htmlheader_title')
	Barang
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
					<div class="panel-heading">Barang</div>

					<div class="panel-body">
						{{-- {!! Form::open(['url' => route('admin.barang.store'),
					'method' => 'post', 'class'=>'form-inline']) !!}
					@include('Barang._form')
					{!! Form::close() !!} --}}
					
					<a href="{{ route('admin.barang.create') }}">
<button type="button" class="btn btn-success">Tambah Data</button></a>
					<div class="panel-heading"></div>
					<div class="table-responsive">
					<table class="table table-bordered table-hover datatable-highlight data">
						<thead><tr>
						 <th>No</th>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Stok Awal</th>
						<th>Stok Akhir</th>
						
						<th>Satuan</th>
						<th>Kategori</th>
						<th>Actions</th>
						</tr></thead><tbody>
						<?php $nom = 1; ?>
						@foreach($Barang as $Barangs)
						
						<tr>
							<td>{{$nom++}}</td>
							<td>{{ $Barangs->kode_barang }}</td>
							<td>{{ $Barangs->nama_barang }}</td>
							<td>{{ $Barangs->stok_awal}}</td>
							<td>{{ $Barangs->stok_akhir}}</td>
							
							
							<td>{{ $Barangs->satuan->nama_satuan }}</td>
							<td>{{ $Barangs->kategori->nama_kategori }}</td>
<td><div class="row">
	<div class="col-md-3 col-sm-5 col-xs-10">
		<a href="{{ route('admin.barang.index') }}/{{ $Barangs->id }}/edit"><button type="button" class="btn btn-primary">Edit</button></a>
	</div>
	<div class="col-md-3 col-sm-5 col-xs-10">
		<form action="{{ route('admin.barang.index') }}/{{$Barangs->id}}" method="POST">
			<input type="hidden" name="_method" value="delete"></input>
			<input type="hidden" name="_token" value="{{csrf_token()}}">
			<input class="btn btn-danger" type="submit" name="name" value="delete" >
		</form></div></div>
	</td>
							</tr>
							@endforeach
						</tbody>
						</table>
					</div>
						<!-- {{ $Barang->links() }} -->
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection



