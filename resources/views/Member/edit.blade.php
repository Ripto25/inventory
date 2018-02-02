@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Edit User
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading"><ul class="breadcrumb">
<li><a href="{{ url('/home') }}">Beranda</a></li>
<li><a href="{{ route('admin.member.index') }}">User</a></li>
<li class="active">Edit Data User</li>
</ul></div>

					<div class="panel-body">
						{!! Form::model($Members, ['url' => route('admin.member.update', $Members->id),
'method'=>'put', 'class'=>'form-horizontal']) !!}

{{-- {!! Form::open($Members,['url' => route('admin.member.update',$Members->id),
					'method' => 'put', 'class'=>'form-horizontal']) !!} --}}


<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
{!! Form::label('name', 'Nama', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::text('name', null, ['class'=>'form-control']) !!}
{!! $errors->first('name', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
{!! Form::label('email', 'Email', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::text('email', null, ['class'=>'form-control']) !!}
{!! $errors->first('email', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group">
<div class="col-md-6 col-md-offset-5">
{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
</div>
</div>

{{-- @include('Member._form') --}}

{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection






