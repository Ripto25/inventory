

{{-- 
<div class="form-group{{ $errors->has('kode_barang') ? ' has-error' : '' }}">
{!! Form::label('kode_barang', 'Kode Barang', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::text('kode_barang', null, ['class'=>'form-control']) !!}
{!! $errors->first('kode_barang', '<p class="help-block">:message</p>') !!}
</div>
</div> --}}

<div class="form-group{{ $errors->has('nama_barang') ? ' has-error' : '' }}">
{!! Form::label('nama_barang', 'Nama Barang', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::text('nama_barang', null, ['class'=>'form-control']) !!}
{!! $errors->first('nama_barang', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group{{ $errors->has('stok_awal') ? ' has-error' : '' }}">
{!! Form::label('stok_awal', 'Stok Awal', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::text('stok_awal', null, ['class'=>'form-control']) !!}
{!! $errors->first('stok_awal', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group{{ $errors->has('satuan_id') ? ' has-error' : '' }}">
{!! Form::label('satuan_id', 'Satuan', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::select('satuan_id', [''=>'']+App\Satuan::pluck('nama_satuan','id')->all(), null, ['class'=>'form-control',
'placeholder' => 'Pilih Satuan']) !!}
{!! $errors->first('satuan_id', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group{{ $errors->has('kategori_id') ? ' has-error' : '' }}">
{!! Form::label('kategori_id', 'Kategori', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::select('kategori_id', [''=>'']+App\Kategori::pluck('nama_kategori','id')->all(), null, ['class'=>'form-control',
'placeholder' => 'Pilih Kategori']) !!}
{!! $errors->first('kategori_id', '<p class="help-block">:message</p>') !!}
</div>
</div>



<div class="form-group">
<div class="col-md-6 col-md-offset-5">
{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
</div>
</div>