{{-- <div class="form-group{{ $errors->has('kode_bm') ? ' has-error' : '' }}">
{!! Form::label('kode_bk', 'kode_bk', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::text('kode_bk', null, ['class'=>'form-control']) !!}
{!! $errors->first('kode_bk', '<p class="help-block">:message</p>') !!}
</div>
</div>
 --}}
 
 <div class="form-group{{ $errors->has('barang_id') ? ' has-error' : '' }}">
{!! Form::label('barang_id', 'Barang id', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::text('barang_id',$MBkeluar->id, ['class'=>'form-control','readonly']) !!}
{!! $errors->first('barang_id', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group{{ $errors->has('kode_barang') ? ' has-error' : '' }}">
{!! Form::label('kode_barang', 'Kode Barang', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::text('kode_barang',$MBkeluar->barang->kode_barang, ['class'=>'form-control','readonly']) !!}
{!! $errors->first('kode_barang', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group{{ $errors->has('nama_barang') ? ' has-error' : '' }}">
{!! Form::label('nama_barang', 'Nama Barang', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::text('nama_barang',$MBkeluar->barang->nama_barang, ['class'=>'form-control','readonly']) !!}
{!! $errors->first('nama_barang', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group{{ $errors->has('tipe_barang') ? ' has-error' : '' }}">
{!! Form::label('tipe_barang', 'Tipe Barang', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::text('tipe_barang',$MBkeluar->barang->kategori->nama_kategori, ['class'=>'form-control','readonly']) !!}
{!! $errors->first('tipe_barang', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group{{ $errors->has('keterangan') ? ' has-error' : '' }}">
{!! Form::label('keterangan', 'Keterangan', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::textarea('keterangan', $MBkeluar->keterangan, ['class'=>'form-control']) !!}
{!! $errors->first('keterangan', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group{{ $errors->has('jumlah') ? ' has-error' : '' }}">
{!! Form::label('jumlah', 'Jumlah', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::text('jumlah', $MBkeluar->jumlah, ['class'=>'form-control',
'placeholder' => 'Jumlah']) !!}
{!! $errors->first('jumlah', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group{{ $errors->has('jumlah') ? ' has-error' : '' }}">
{!! Form::label('peminta', 'Peminta', ['class'=>'col-md-4 control-label']) !!}
<div class="col-md-4">
{!! Form::text('peminta',  $MBkeluar->peminta, ['class'=>'form-control',
'placeholder' => 'peminta']) !!}
{!! $errors->first('peminta', '<p class="help-block">:message</p>') !!}
</div>
</div>

<div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
    {!! Form::label('divisi', 'Divisi', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-4">
        {!! Form::select('divisi', [''=>'','Counter' => 'Counter', 'Produksi' => 'Produksi', 'Security' => 'Scurity'], $MBkeluar->divisi, ('' == 'required') ? ['class' => 'form-control', 'required' => 'required'] : ['class' => 'form-control']) !!}
        {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
    </div>
</div>





<div class="form-group">
<div class="col-md-6 col-md-offset-5">
{!! Form::submit('Simpan', ['class'=>'btn btn-primary']) !!}
</div>
</div>