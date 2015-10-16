<?php

namespace BITS;

/**
* Generate ID or Code Format
*
* Allow to generate format such a TRX id, Invoice ID, etc.
*/
class Invoice extends Query
{
    public function get($type, $bulan, $tahun, $company = "BITS")
    {
        $maks = parent::custom("SELECT SUBSTR(MAX(no_invoice),1,5) AS id FROM invoices");
        if ($maks['id'] == '') {
            $invoice = "00001/".$type."/".$company."/".$bulan."/".$tahun;
        } else {
            $maksID = $maks['id'];
            $maksID++;
            if ($maksID < 10) {
                $invoice = "0000".$maksID."/".$type."/".$company."/".$bulan."/".$tahun;
            } elseif ($maksID < 100) {
                $invoice = "000".$maksID."/".$type."/".$company."/".$bulan."/".$tahun;
            } elseif ($maksID < 1000) {
                $invoice = "00".$maksID."/".$type."/".$company."/".$bulan."/".$tahun;
            } elseif ($maksID < 10000) {
                $invoice = "0".$maksID."/".$type."/".$company."/".$bulan."/".$tahun;
            } else {
                $invoice = $maksID."/".$type."/".$company."/".$bulan."/".$tahun;
            }
        }
        return $invoice;
    }

    public function autoNumber($table, $code, $prefix, $tahun = "", $bulan = "", $tanggal = "", $batas = "", $length = 3)
    {
        $maks = parent::custom("SELECT RIGHT($code,3) AS maks FROM $table WHERE LEFT($code,$length) = '$prefix' ORDER BY maks DESC");
        if ($maks['maks'] == '') {
            $val = $prefix.$tahun.$batas.$bulan.$batas.$tanggal.$batas."001";
        } else {
            $maksID = $maks['maks'];
            $maksID++;
            if ($maksID < 10) {
                $val = $prefix.$tahun.$batas.$bulan.$batas.$tanggal.$batas."00".$maksID;
            } elseif ($maksID < 100) {
                // Jika id terakhir + 1 kurang dari 100
                // 98 + 1 kurang dari 100 maka BR-099
                $val = $prefix.$tahun.$batas.$bulan.$batas.$tanggal.$batas."0".$maksID;
            } else {
                // Jika id terakhir + 1 lebih dari 100
                // 99 + 1 lebih dari 100 maka BR-100
                $val = $prefix.$tahun.$batas.$bulan.$batas.$tanggal.$batas.$maksID;
            }
        }
        return $val;
    }
}
