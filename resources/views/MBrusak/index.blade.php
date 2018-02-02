@extends('layouts.app')

@section('htmlheader_title')
	Barang Rusak
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
					<div class="panel-heading">Barang Rusak</div>

					<div class="panel-body">
						{{-- {!! Form::open(['url' => route('barang.store'),
					'method' => 'post', 'class'=>'form-inline']) !!}
					@include('Barang._form')
					{!! Form::close() !!} --}}
					<!-- Content area -->
	@if (!empty($MBrusak))

					
						
					<table class="table table-bordered table-hover datatable-highlight">
							<thead>
								<tr>	
									<th>Kode brusak</th>							
									<th>Kode Barang</th>									
									<th>Nama Barang</th>						
									<th>Tipe Barang</th>
									<th>Satuan</th>	
									<th>Jumlah Barang</th>										
									<th>Tanggal Masuk</th>	
									<th>Oleh</th>			
																
								</tr>
							</thead>
							<tbody>									
								@foreach($MBrusak as $Barang)					
								<tr>
									<td> {{ $Barang->kode_br }}</td>									
									<td> {{ $Barang->barang->kode_barang }}</td>									
									<td> {{ $Barang->barang->nama_barang }}</td>
									<td> {{ $Barang->barang->kategori->nama_kategori }}</td>
									<td> {{ $Barang->barang->satuan->nama_satuan }}</td>
									<td> {{ $Barang->jumlah }}</td>									
									<td> {{ $Barang->created_at }}</td>	
									<td> {{ $Barang->user }}</td>	
																
								</tr>
									@endforeach 
							</tbody>
						</table>
					</div>
					<!-- /highlighting rows and columns -->
	@else
		<p>Tidak ada data Barang Rrusak.</p>
	@endif 			

		<div class="btn-group">
			<a href="{{ asset('memberbrusak/create')}}"><button type="button" class="btn btn-success bg-teal-400 btn-labeled"><b><i class="icon-file-plus"></i></b> Tambah Barang</button></a>	

			<!-- <a href="{{ asset('cetak_bm')}}" target="_blank" class="btnPrint"><button type="button" class="btn bg-teal-400 btn-labeled"><b><i class="icon-printer"></i></b> Cetak</button></a>	

			<a href="{{ asset('pdf_bm')}}" target="_blank" class="btnPrint"><button type="button" class="btn bg-teal-400 btn-labeled"><b><i class="icon-file-pdf"></i></b>Download PDF</button></a>	 -->
						
		</div>
	</div>


<script type="text/javascript">
	$(document).ready(function() {
		$(".btnPrint").printPage();
	});
</script>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection



