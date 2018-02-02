@extends('layouts.app')

@section('htmlheader_title')
	Tambah Retur
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
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading"> <ul class="breadcrumb">
<li><a href="{{ url('/home') }}">Dashboard</a></li>
<li><a href="{{ url('admin/retur') }}">Barang Retur</a></li>
<li class="active">Tambah Data Barang Retur</li>
</ul></div>

					<div class="panel-body">

                    

					<form action="{{ url('admin/retur/create') }}" method="GET">
                        <div class="row">
                            <div class="input-field col-md-7 col-md-offset-2">
                                
                                <input type="text" class="validate form-control" name="q" placeholder="Cari dengan Kode Barang ...">
                            </div>
                            <button type="submit" class="btn btn-primary">Cari</button>
                        </div>
                    </form>

                     <br>
                    <div align="center">
                        <p>Jika Barang Belum terdaftar silakan daftar</p>
                        <a href="{{ url('admin/barang') }}" class="btn btn-primary">Disini</a>
                    </div>

						
					</div>
				</div>
			</div>
		</div>

		<div class="row">
        <div class="col-md-8 col-md-offset-2">
                @if($q != null)
               
                <div class="panel panel-default">
                    <div class="panel-heading">Tambah Data Barang Retur</div>
                    <div class="panel-body">

                        @foreach($kode as $Barang)

                       {!! Form::open(['url' => route('admin.retur.store'),
                    'method' => 'POST', 'class'=>'form-horizontal']) !!}
                    @include('Retur._form')
                    {!! Form::close() !!}
                        
                        @endforeach
                    </div>
                    
                    </div>
                    @endif
            </div>
	</div>
@endsection


