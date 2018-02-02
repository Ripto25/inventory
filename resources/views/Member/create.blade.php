@extends('layouts.app')

@section('htmlheader_title')
	Tambah User
@endsection


@section('main-content')
	<div class="container spark-screen">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading"><ul class="breadcrumb">
<li><a href="{{ url('/home') }}">Beranda</a></li>
<li><a href="{{ route('admin.member.index') }}">User</a></li>
<li class="active">Tambah Data User</li>
</ul></div>

					<div class="panel-body">
						{!! Form::open(['url' => route('admin.member.store'),
					'method' => 'post', 'class'=>'form-horizontal']) !!}
					@include('Member._form')
					{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection


