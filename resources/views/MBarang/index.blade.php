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
					<div class="panel-heading"><strong> Data Barang </strong></div>

					<div class="panel-body">
						
					<div class="panel-heading"></div>
					<table class="table table-bordered table-hover datatable-highlight data">

						<thead><tr>
						<th>No</th> 
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Stok Awal</th>
						<th>Stok Akhir</th>
						
						
						<th>Satuan</th>
						<th>Kategori</th>
					</tr></thead><tbody>

						<?php $no=1; ?>
						
						@foreach($Barang as $Barangs)
						<tr>
							<td>{{$no++}}</td>
							<td>{{ $Barangs->kode_barang }}</td>
							<td>{{ $Barangs->nama_barang }}</td>
							<td>{{ $Barangs->stok_awal}}</td>
							<td>{{ $Barangs->stok_akhir}}</td>
							
							
							<td>{{ $Barangs->satuan->nama_satuan }}</td>
							<td>{{ $Barangs->kategori->nama_kategori }}</td>

							</tr>
							@endforeach
						</tbody>
						</table>
						{{ $Barang->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection



