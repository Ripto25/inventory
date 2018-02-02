{{-- <div class="form-group{{ $errors->has('kode_bm') ? ' has-error' : '' }}">
{!! Form::label('kode_bm', 'kode_bm', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::text('kode_bm', null, ['class'=>'form-control']) !!}
{!! $errors->first('kode_bm', '<p class="help-block">:message</p>') !!}
</div>
</div>
 --}}
 
 <div class="form-group{{ $errors->has('barang_id') ? ' has-error' : '' }}">
{!! Form::label('barang_id', 'Barang id', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::text('barang_id',$Retur->id, ['class'=>'form-control','readonly']) !!}
{!! $errors->first('barang_id', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group{{ $errors->has('kode_barang') ? ' has-error' : '' }}">
{!! Form::label('kode_barang', 'Kode Barang', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::text('kode_barang',$Retur->barang->kode_barang, ['class'=>'form-control','readonly']) !!}
{!! $errors->first('kode_barang', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group{{ $errors->has('nama_barang') ? ' has-error' : '' }}">
{!! Form::label('nama_barang', 'Nama Barang', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::text('nama_barang',$Retur->barang->nama_barang, ['class'=>'form-control','readonly']) !!}
{!! $errors->first('nama_barang', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group{{ $errors->has('tipe_barang') ? ' has-error' : '' }}">
{!! Form::label('tipe_barang', 'Tipe Barang', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::text('tipe_barang',$Retur->barang->kategori->nama_kategori, ['class'=>'form-control','readonly']) !!}
{!! $errors->first('tipe_barang', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
{!! Form::label('keterangan', 'Keterangan', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::textarea('keterangan', $Retur->keterangan, ['class'=>'form-control']) !!}
{!! $errors->first('keterangan', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group{{ $errors->has('jumlah') ? ' has-error' : '' }}">
{!! Form::label('jumlah', 'Jumlah', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::text('jumlah', $Retur->jumlah, ['class'=>'form-control',
'placeholder' => 'Jumlah']) !!}
{!! $errors->first('jumlah', '<p class="help-block">:message</p>') !!}
</div>
</div>







<div class="form-group">
<div class="col-md-6 col-md-offset-5">
{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
</div>
</div>