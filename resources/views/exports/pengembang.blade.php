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
    <th>Nama Perusahaan</th>
    <th>Nama Pengembang</th>
    <th>Email</th>
    <th>No. HP/Telepon</th>
    <th>Alamat</th>
    <th>Status Pengembang</th>
  </tr>
  @foreach ($data as $i => $item) 
  <tr>
    <th>{{ $i + 1 }}</th>
    <th>{{ $item->nama_perusahaan }}</th>
    <th>{{ $item->nama_pengembang }}</th>
    <th>{{ $item->email_pengembang }}</th>
    <th>{{ $item->telepon_pengembang }}</th>
    <th>{{ $item->alamat_pengembang }}</th>
    <th>{{ $item->status_aktif == 1 ? "Aktif" : "Tidak Aktif"  }}</th>
  </tr>
  @endforeach
</table>