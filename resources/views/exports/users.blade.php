<table>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td><b>Tanggal: {{ $tanggal }}</b></td>
  </tr>
  <tr>
    <td><b>Diekspor oleh: {{ ucfirst($user) }}</b></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <th>No</th>
    <th>Username</th>
    <th>Pengembang</th>
    <th>Level</th>
  </tr>
  @foreach ($data as $i => $item) 
  <tr>
    <th>{{ $i + 1 }}</th>
    <th>{{ $item->username }}</th>
    <th>
      @if ($item->level == 3)
        {{ $item->nama_perusahaan }} <br> ({{ $item->nama_pengembang }})    
      @else
        -
      @endif
    </th>
    <th>
      @if ($item->level == 1)
          Super Administrator
      @elseif($item->level ==2)
          Administrator
      @else 
          Pengembang
      @endif
    </th>
  </tr>
  @endforeach
</table>