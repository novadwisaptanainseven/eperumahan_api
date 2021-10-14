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
    <td><b>Diekspor oleh: {{ $user }}</b></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <th>No</th>
    <th>Nama Perumahan</th>
    <th>Kategori</th>
    <th>Perusahaan</th>
    <th>Tahun</th>
    <th>Jumlah Unit</th>
    <th>Lokasi</th>
  </tr>
  @foreach ($data as $i => $item) 
  <tr>
    <th>{{ $i + 1 }}</th>
    <th>{{ $item->nama_perumahan }}</th>
    <th>{{ $item->nama_perusahaan}}</th>
    <th>{{ $item->tahun }}</th>
    <th>{{ $item->jumlah_unit }}</th>
    <th>{{ $item->lokasi }}</th>
  </tr>
  @endforeach
</table>