<?php

// Fungsi untuk memformat tanggal ke dalam format tgl Indonesia
if (!function_exists("formatTanggalIndonesia")) {
  function formatTanggalIndonesia($tgl)
  {
    $day = date("d", strtotime($tgl));
    $month = date("M", strtotime($tgl));
    $year = date("Y", strtotime($tgl));

    $bulan = "";

    switch ($month) {
      case "Jan":
        $bulan = "Januari";
        break;
      case "Feb":
        $bulan = "Februari";
        break;
      case "Mar":
        $bulan = "Maret";
        break;
      case "Apr":
        $bulan = "April";
        break;
      case "May":
        $bulan = "Mei";
        break;
      case "Jun":
        $bulan = "Juni";
        break;
      case "Jul":
        $bulan = "Juli";
        break;
      case "Aug":
        $bulan = "Agustus";
        break;
      case "Sep":
        $bulan = "September";
        break;
      case "Oct":
        $bulan = "Oktober";
        break;
      case "Nov":
        $bulan = "November";
        break;
      case "Des":
        $bulan = "Desember";
        break;
      default:
        break;
    }

    return ["tgl" => $day, "bulan" => $bulan, "tahun" => $year];
  }
}
