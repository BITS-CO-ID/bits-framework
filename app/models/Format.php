<?php

namespace BITS;

/**
* Generate ID or Code Format
*
* Allow to generate format such a TRX id, Invoice ID, etc.
*/
class Format extends Query
{
    /**
     * Truncate a string provided by the maximum limit without breaking a word.
     *
     * @param string $str
     * @param string $max
     *
     * @return string
     */
    public function excerpt($str, $max)
    {
        if (strlen($str) > $max) {
            return substr($str, 0, $max).'...';
        } else {
            return $str;
        }
    }

    public function date($date, $type = "stripe")
    {
        if ($type == "stripe") {
            $data = date('d - F - Y', strtotime($date));
        } elseif ($type == "slash") {
            $data = date('d/m/Y', strtotime($date));
        } elseif ($type == "time") {
            $data = date('d M Y, h:i', strtotime($date));
        } else {
            $data = date('Y-m-d');
        }
        return $data;
    }

    public function addComma($data)
    {
        $join = '';
        foreach ($data as $isi) {
            $join .= $isi.',';
        }
        return rtrim($join, ',');
    }

    public function terbilang($angka)
    {
        $angka = (float)$angka;
        $bilangan = array(
                '',
                'Satu',
                'Dua',
                'Tiga',
                'Empat',
                'Lima',
                'Enam',
                'Tujuh',
                'Delapan',
                'Sembilan',
                'Sepuluh',
                'Sebelas'
        );

        // pencocokan dimulai dari satuan angka terkecil
        if ($angka < 12) {
            // mapping angka ke index array $bilangan
            return $bilangan[$angka];
        } elseif ($angka < 20) {
            // bilangan 'belasan'
            // misal 18 maka 18 - 10 = 8
            return $bilangan[$angka - 10] . ' Belas';
        } elseif ($angka < 100) {
            // bilangan 'puluhan'
            // misal 27 maka 27 / 10 = 2.7 (integer => 2) 'dua'
            // untuk mendapatkan sisa bagi gunakan modulus
            // 27 mod 10 = 7 'tujuh'
            $hasil_bagi = (int)($angka / 10);
            $hasil_mod = $angka % 10;
            return trim(sprintf('%s Puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
        } elseif ($angka < 200) {
            // bilangan 'seratusan' (itulah indonesia knp tidak satu ratus saja? :))
            // misal 151 maka 151 = 100 = 51 (hasil berupa 'puluhan')
            // daripada menulis ulang rutin kode puluhan maka gunakan
            // saja fungsi rekursif dengan memanggil fungsi terbilang(51)
            return sprintf('Seratus %s', self::terbilang($angka - 100));
        } elseif ($angka < 1000) {
            // bilangan 'ratusan'
            // misal 467 maka 467 / 100 = 4,67 (integer => 4) 'empat'
            // sisanya 467 mod 100 = 67 (berupa puluhan jadi gunakan rekursif self::terbilang(67))
            $hasil_bagi = (int)($angka / 100);
            $hasil_mod = $angka % 100;
            return trim(sprintf('%s Ratus %s', $bilangan[$hasil_bagi], self::terbilang($hasil_mod)));
        } elseif ($angka < 2000) {
            // bilangan 'seribuan'
            // misal 1250 maka 1250 - 1000 = 250 (ratusan)
            // gunakan rekursif self::terbilang(250)
            return trim(sprintf('Seribu %s', self::terbilang($angka - 1000)));
        } elseif ($angka < 1000000) {
            // bilangan 'ribuan' (sampai ratusan ribu
            $hasil_bagi = (int)($angka / 1000); // karena hasilnya bisa ratusan jadi langsung digunakan rekursif
            $hasil_mod = $angka % 1000;
            return sprintf('%s Ribu %s', self::terbilang($hasil_bagi), self::terbilang($hasil_mod));
        } elseif ($angka < 1000000000) {
            // bilangan 'jutaan' (sampai ratusan juta)
            // 'satu puluh' => SALAH
            // 'satu ratus' => SALAH
            // 'satu juta' => BENAR
            // @#$%^ WT*

            // hasil bagi bisa satuan, belasan, ratusan jadi langsung kita gunakan rekursif
            $hasil_bagi = (int)($angka / 1000000);
            $hasil_mod = $angka % 1000000;
            return trim(sprintf('%s Juta %s', self::terbilang($hasil_bagi), self::terbilang($hasil_mod)));
        } elseif ($angka < 1000000000000) {
            // bilangan 'milyaran'
            $hasil_bagi = (int)($angka / 1000000000);
            // karena batas maksimum integer untuk 32bit sistem adalah 2147483647
            // maka kita gunakan fmod agar dapat menghandle angka yang lebih besar
            $hasil_mod = fmod($angka, 1000000000);
            return trim(sprintf('%s Milyar %s', self::terbilang($hasil_bagi), self::terbilang($hasil_mod)));
        } elseif ($angka < 1000000000000000) {
            // bilangan 'triliun'
            $hasil_bagi = $angka / 1000000000000;
            $hasil_mod = fmod($angka, 1000000000000);
            return trim(sprintf('%s Triliun %s', self::terbilang($hasil_bagi), self::terbilang($hasil_mod)));
        } else {
            return 'Wow...';
        }
    }

    public function romawi($nomor)
    {
        $table = array(
            'M'=>1000,
            'CM'=>900,
            'D'=>500,
            'CD'=>400,
            'C'=>100,
            'XC'=>90,
            'L'=>50,
            'XL'=>40,
            'X'=>10,
            'IX'=>9,
            'V'=>5,
            'IV'=>4,
            'I'=>1
        );
        $romawi = '';
        while ($nomor > 0) {
            foreach ($table as $rom => $arb) {
                if ($nomor >= $arb) {
                    $nomor -= $arb;
                    $romawi .= $rom;
                    break;
                }
            }
        }
        return $romawi;
    }

    public function invoice($type, $bulan, $tahun, $company = "BITS")
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
