@extends('layouts.app')

@section('htmlheader_title')
	Retur
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
					<div class="panel-heading">Barang Retur</div>
					<br>
					<span> &nbsp &nbsp &nbsp<a href="{{ asset('admin/retur/create')}}" class="btn btn-success btn-sm">Tambah Barang</a></span>



					<div class="panel-body">
						{{-- {!! Form::open(['url' => route('barang.store'),
					'method' => 'post', 'class'=>'form-inline']) !!}
					@include('Barang._form')
					{!! Form::close() !!} --}}
					<!-- Content area -->
	@if (!empty($Retur))

					
						
					<table class="table table-bordered table-hover datatable-highlight data">
							<thead>
								<tr><th>No</th>	
									<th>Kode Retur</th>							
									<th>Kode Barang</th>									
									<th>Nama Barang</th>						
									<th>Tipe Barang</th>
									<th>Satuan</th>	
									<th>Jumlah Barang</th>										
									<th>Tanggal Retur</th>
									
									<th>Oleh</th>			
									<th>Action</th>								
								</tr>
							</thead>
							<tbody>		
							<?php $nom = 1; ?>							
								@foreach($Retur as $Barang)
												
								<tr>
									<td>{{$nom++}}</td>
									<td> {{ $Barang->kode_r }}</td>									
									<td> {{ $Barang->barang->kode_barang }}</td>									
									<td> {{ $Barang->barang->nama_barang }}</td>
									<td> {{ $Barang->barang->kategori->nama_kategori }}</td>
									<td> {{ $Barang->barang->satuan->nama_satuan }}</td>
									<td> {{ $Barang->jumlah }}</td>									
									<td> {{ $Barang->created_at }}</td>	
									
									<td> {{ $Barang->user }}</td>	
									<td>
										<div class="btn-group">
			                    			<button type="button" class="btn bg-teal-400 btn-labeled dropdown-toggle" data-toggle="dropdown"><b><i class="icon-reading"></i></b> Pilih <span class="caret"></span></button>
			                    			<ul class="dropdown-menu dropdown-menu-right">

												<!-- tombol  -->									                    			
					                    		<!-- <li><a href="retur/{{ $Barang->id }}" ><i class="icon-magazine"></i>Detail</a></li> -->
					                    		<li><a href="retur/{{ $Barang->id }}/edit"><i class="icon-pencil"></i>Edit</a></li>
								                {!! Form::open(['method' => "DELETE", 'action' =>['ReturController@destroy',$Barang->id], 'onsubmit' => 'return ConfirmDelete()']) !!}
												<button class="btn btn-danger btn-block" type="submit"><i class="icon-eraser"> </i> Hapus</button>
											{!! Form::close() !!}
										 																				
											</ul>								
										</div>
										<!-- /labeled button -->	

									</td>													
								</tr>
									@endforeach 
							</tbody>
						</table>
					</div>
					<!-- /highlighting rows and columns -->
	@else
		<p>Tidak ada data Barang Retur.</p>
	@endif 			

		
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



