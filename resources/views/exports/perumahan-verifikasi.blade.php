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
    <th>Nama Perumahan</th>
    <th>Perusahaan</th>
    <th>Pengembang</th>
    <th>Kategori</th>
    <th>Luasan (m<sup>2</sup>)</th>
    <th>Jumlah Unit</th>
    <th>Lokasi</th>
    <th>Tahun</th>
    <th>Status Verifikasi</th>
  </tr>
  @foreach ($data as $i => $item) 
  <tr>
    <th>{{ $i + 1 }}</th>
    <th>{{ $item->nama_perumahan }}</th>
    <th>{{ $item->nama_perusahaan}}</th>
    <th>{{ $item->nama_pengembang }}</th>
    <th>{{ $item->nama_kategori }}</th>
    <th>
      @if ($item->id_kategori == 3)
        MBR: {{ $item->luas_mbr }} m2<br />    
        Komersial: {{ $item->luas_komersial }} m2<br />    
        Total: {{ $item->luas }} m2   
      @else
        {{ $item->luas }} m2
      @endif
    </th>
    <th>
      @if ($item->id_kategori == 1)
        MBR: {{ $item->jumlah_unit_mbr }}
      @elseif($item->id_kategori == 2)
        Komersial: {{ $item->jumlah_unit_non_mbr }}
      @elseif($item->id_kategori == 3)
        MBR: {{ $item->jumlah_unit_mbr }} <br>
        Komersial: {{ $item->jumlah_unit_non_mbr }} <br>
        Total: {{ $item->jumlah_unit }}
      @endif
    </th> 
    <th>{{ $item->lokasi }}</th>
    <th>{{ $item->tahun }}</th>
      @if ($item->status_perumahan == 1 || $item->status_perumahan == 2)
      <th style="background-color: #00ff1a">
        Sudah
      </th>
      @else
      <th style="background-color: #ff2929">
        Belum
      </th>
      @endif
  </tr>
  @endforeach
</table>