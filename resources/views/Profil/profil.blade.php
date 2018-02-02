@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Profil
@endsection


@section('main-content')
@include('Profil._flash')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading"><ul class="breadcrumb">
<li><a href="{{ url('/home') }}">Beranda</a></li>
<li class="active">Edit Profil</li>

<span class="pull-right">{!! link_to('password', $title = 'Ubah Password', $attributes = ['class'=>'btn btn-primary'], $secure = null) !!}</span>
</ul> 

</div>



					<div class="panel-body">
						{!! Form::model(auth()->user(), ['url' => url('profil/update'),
'method'=>'post', 'class'=>'form-horizontal']) !!}

<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
{!! Form::label('name', 'Nama', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-6">
{!! Form::text('name', null, ['class'=>'form-control']) !!}
{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
</div>
 
<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
{!! Form::label('email', 'Email', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-6">
{!! Form::email('email', null, ['class'=>'form-control','readonly']) !!}
{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
</div>

	



<div class="form-group">
<div class="col-md-6 col-md-offset-4">
{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
{!! link_to('/home', $title = 'Batal', $attributes = ['class'=>'btn btn-danger'], $secure = null) !!}
</div>
</div>

{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection






