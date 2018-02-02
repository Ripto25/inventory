<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('/img/boss.png')}}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

       <!--  <!-- search form (Optional) -->
       <!--  <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form> --> 
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header"></li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>Beranda</span></a></li><br>
 @role('member')
            <li class=""><a href="{{ url('member/memberbarang') }}"><i class='fa fa-link'></i> <span>Data Barang</span></a></li>

             <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span><b>Transaksi</b></span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('member/memberbmasuk')}}">Barang Masuk</a></li>
                    <li><a href="{{ url('member/memberbkeluar')}}">Barang Keluar </a></li>
                    <li><a href="{{ url('member/memberretur')}}">Barang retur</a></li>
                    
                </ul>
            </li>
@endrole

             @role('admin')
            
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span><b>Transaksi</b></span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/bmasuk')}}">Barang Masuk</a></li>
                    <li><a href="{{ url('admin/bkeluar')}}">Barang Keluar </a></li>
                    <li><a href="{{ url('admin/retur')}}">Barang retur</a></li>
                    
                </ul>
            </li>


            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span><b>Master Data</b></span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.barang.store')}}">Barang</a></li>
                    <li><a href="{{ route('admin.kategori.index')}}">Kategori</a></li>
                    <li><a href="{{ route('admin.satuan.index')}}">Satuan</a></li>   
                    <li><a href="{{  route('admin.member.index')}}">User</a></li>
                </ul>
            </li>

          
                <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span><b>Laporan</b></span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('lapbrg')}}">Data Barang </a></li>
                    <li><a href="{{ url('lapbm')}}"> Barang Masuk</a></li>
                    <li><a href="{{ url('lapbk')}}">Barang Keluar</a></li>
                    <li><a href="{{ url('lapbre')}}"> Barang Retur</a></li>
                     
                     
                </ul>
            </li>
            @endrole
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
