@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Password
@endsection


@section('main-content')
@include('Profil._flash')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading"><ul class="breadcrumb">
<li><a href="{{ url('/home') }}">Beranda</a></li>
<li><a href="{{ url('/profil') }}">Profil</a></li>
<li class="active">Edit Password</li>
</ul></div>

<div class="panel-body">
{!! Form::open(['url' => url('password/update'),'method'=>'post', 'class'=>'form-horizontal']) !!}



<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
{!! Form::label('password', 'Password lama', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-6">
{!! Form::password('password', ['class'=>'form-control']) !!}
{!! $errors->first('password', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
{!! Form::label('new_password', 'Password baru', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-6">
{!! Form::password('new_password', ['class'=>'form-control']) !!}
{!! $errors->first('new_password', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group{{ $errors->has('new_password_confirmation') ? ' has-error': '' }}">
{!! Form::label('new_password_confirmation', 'Konfirmasi password baru', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-6">
{!! Form::password('new_password_confirmation', ['class'=>'form-control']) !!}
{!! $errors->first('new_password_confirmation', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group">
<div class="col-md-6 col-md-offset-4">
{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
{!! link_to('/profil', $title = 'Batal', $attributes = ['class'=>'btn btn-danger'], $secure = null) !!}
</div>
</div>

{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection






