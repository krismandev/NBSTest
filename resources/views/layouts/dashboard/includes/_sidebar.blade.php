

<div id="sidebar-nav" class="sidebar" style="overflow-y: scroll;">
  <div class="sidebar-scroll">
    <nav>
      <ul class="nav">
        <li><a href="{{route('index')}}" class="{{(request()->is('/')) ? 'active' : ''}}"><i class="lnr lnr-home"></i> <span>Home</span></a></li>
        @if(auth()->user()->role == 'admin')
        <li><a href="{{route('getPositions')}}" class="{{(request()->is('positions*')) ? 'active' : ''}}"><i class="lnr lnr-tag"></i> <span>Jabatan</span></a></li>
        <li><a href="{{route('getEmployees')}}" class="{{(request()->is('employees*')) ? 'active' : ''}}"><i class="lnr lnr-users"></i> <span>Karyawan</span></a></li>
        <li><a href="{{route('dataKehadiran')}}" class="{{(request()->is('data-kehadiran*')) ? 'active' : ''}}"><i class="lnr lnr-calendar-full"></i> <span>Data Kehadiran</span></a></li>
        @endif
        @if(auth()->user()->role == "karyawan")
        <li><a href="{{route('rekapAbsensi')}}" class="{{(request()->is('rekap*')) ? 'active' : ''}}"><i class="lnr lnr-list"></i> <span>Rekap Absensi</span></a></li>

        @endif
      </ul>
    </nav>
  </div>
</div>
