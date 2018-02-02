@extends('layouts.app')

@section('htmlheader_title')
	Barang Masuk
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
					<div class="panel-heading"><b>Barang Masuk</b> </div>
					<br>

			
					

					<div class="panel-body">
						{!! Form::open(['url' => route('admin.kategori.store'),
					'method' => 'post', 'class'=>'form-inline']) !!}
					@include('Kategori._form')
					{!! Form::close() !!}

					<br>
					<br>
						
					<table class="table table-bordered table-hover datatable-highlight data">
							<thead>
								<tr><th>No</th>	
									<th>Kode Kategori</th>
						<th>Nama Kategori</th>
						<th>Actions</th>							
								</tr>
							</thead>
							<tbody>		
							<?php $no=+1; ?>							
								@foreach($Kategori as $Kategoris)
													
								<tr>
							<td>{{$no++}}</td>
							<td>{{ $Kategoris->kode_kategori }}</td>
							<td>{{ $Kategoris->nama_kategori }}</td>
							<td><div class="row">
            <div class="col-md-2 col-sm-5 col-xs-10">
								<a href="{{ route('admin.kategori.index') }}/{{ $Kategoris->id }}/edit"><button type="button" class="btn btn-primary">Edit</button></a>
								</div>
								<div class="col-md-2 col-sm-5 col-xs-10">
								
									
									<form action="{{ route('admin.kategori.index') }}/{{$Kategoris->id}}" method="POST">
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
					<!-- /highlighting rows and columns -->
			

		
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



