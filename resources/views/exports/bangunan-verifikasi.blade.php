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
    <th rowspan="2">No</th>
    <th rowspan="2">Nama Bangunan</th>
    <th rowspan="2">Kategori</th>
    <th rowspan="2">Nama Perumahan</th>
    <th rowspan="2">Tipe</th>
    <th rowspan="2">Jumlah Unit</th>
    <th rowspan="2">Harga</th>
    <th rowspan="2">Lokasi</th>
    <th colspan="7">Variabel</th>
    <th rowspan="2">Status Verifikasi</th>
  </tr>
  <tr>
    <th>Luas Bangunan</th>
    <th>Luas Tanah</th>
    <th>Jml. <br>Lantai</th>
    <th>Jml. <br>Kamar Tidur</th>
    <th>Jml. <br>Kamar Mandi</th>
    <th>Jml. <br>Garasi</th>
    <th>Pasokan Listrik (Watt)</th>
  </tr>
  @foreach ($data as $i => $item) 
  <tr>
    <td>{{ $i + 1 }}</td>
    <td>{{ $item->nama_bangunan }}</td>
    <td>{{ $item->nama_kategori }}</td>
    <td>{{ $item->nama_perumahan }}</td>
    <td>{{ $item->tipe_bangunan }}</td>
    <td>{{ $item->jumlah_tersedia }}</td>
    <td>Rp. {{ number_format($item->harga_bangunan, 2, ',','.') }}</td>
    <td>{{ $item->lokasi_bangunan }}</td>
    <td>{{ $item->luas_bangunan }} m2</td>
    <td>{{ $item->luas_tanah }} m2</td>
    <td>{{ $item->jumlah_lantai }}</td>
    <td>{{ $item->jumlah_kamar }}</td>
    <td>{{ $item->jumlah_kamar_mandi }}</td>
    <td>{{ $item->jumlah_garasi }}</td>
    <td>{{ $item->listrik }}</td>
    @if ($item->status_publish == 1 || $item->status_publish == 2)
      <td style="background-color: #00ff1a">
        Sudah
      </td>
      @else
      <td style="background-color: #ff2929">
        Belum
      </td>
      @endif
  </tr>
  @endforeach
</table>