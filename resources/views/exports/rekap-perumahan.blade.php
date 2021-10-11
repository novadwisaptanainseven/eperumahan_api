{{-- {{ dd($data) }} --}}
@php
    $totalPerumahan = $data["jumlah_perumahan"]["campuran"] + $data["jumlah_perumahan"]["mbr"] + $data["jumlah_perumahan"]["komersial"];
@endphp

{{-- Rekap Perumahan dan Pengembang --}}
<table>
  <tr>
    <td></td>
  </tr>
  <tr>
      <td></td>
  </tr>
  <tr>
      <td></td>
  </tr>
  <tr>
      <th></th>
      <th>No</th>
      <th>Perumahan / Pengembang</th>
      <th>Jumlah</th>
  </tr>
  <tr>
      <td></td>
      <td align="center">1</td>
      <td>Perumahan Subsidi (MBR)</td>
      <td align="center">{{ $data["jumlah_perumahan"]["mbr"] }}</td>
  </tr>
  <tr>
    <td></td>
      <td align="center">2</td>
      <td>Perumahan Non Subsidi (Komersial)</td>
      <td align="center">{{ $data["jumlah_perumahan"]["komersial"] }}</td>
  </tr>
  <tr>
    <td></td>
      <td align="center">3</td>
      <td>Perumahan Campuran (MBR &amp; Komersial)</td>
      <td align="center">{{ $data["jumlah_perumahan"]["campuran"] }}</td>
  </tr>
  <tr>
    <td></td>
      <td align="center">4</td>
      <td>Total Perumahan</td>
      <td align="center">{{ $totalPerumahan }}</td>
  </tr>
  <tr>
    <td></td>
      <td align="center">5</td>
      <td>Pengembang</td>
      <td align="center">{{ $data["jumlah_perumahan"]["pengembang"] }}</td>
  </tr>

  {{-- Rekap Perumahan Berdasarkan Kecamatan --}}
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <th></th>
    <th rowspan="2">No</th>
    <th rowspan="2">Kecamatan</th>
    <th colspan="4">Jumlah Perumahan</th>
  </tr>
  <tr>
    <th></th>
    <th>Subsidi</th>
    <th>Non Subsidi</th>
    <th>Campuran</th>
    <th>Total</th>
  </tr>
  @foreach ($data["kecamatan"] as $i => $item)
  <tr>
    <th></th>
    <th>{{ $i + 1 }}</th>
    <th>{{ $item->nama_kecamatan }}</th>
    <th>{{ $item->rumah["mbr"] }}</th>
    <th>{{ $item->rumah["komersial"] }}</th>
    <th>{{ $item->rumah["campuran"] }}</th>
    <th>{{ $item->rumah["total"] }}</th>
  </tr>
  @endforeach
</table>