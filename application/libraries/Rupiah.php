<?php
/**
 * Kelas untuk memanipulasi data yang berkaitan dengan rupiah.
 *
 * Catatan: Saya lupa darimana contoh fungsi terbilang awalnya!
 *
 * @version		0.0.1
 * @author 		Anggiajuang Patria <anggiaj@segellabs.com>
 * @copyright	(c) 2009-2010 http://www.segellabs.com/
 * @license		http://www.gnu.org/licenses/gpl-3.0.txt
 */
class Rupiah
{
	/**
	 * Memformat suatu angka menjadi format yang umum digunakan dalam penulisan nominal rupiah
	 *
	 * @param 	float 	nilai rupiah
	 * @return 	string
	 */
	public static function format($nominal, $sign = 'Rp. ', $end = ',-', $presisi = 0)
	{
		return $sign.number_format($nominal, $presisi, ',', '.').$end;
	}

	/**
	 * Mendapatkan nilai mata uang asing
	 *
	 * @param	string	konstanta singkatan mata uang asing, ex: USD, GBP, dst.
	 * @return	float
	 */
	public static function nilai_tukar($mata_uang_asing)
	{
		$url = 'http://quote.yahoo.com/d/quotes.csv?s='
				.strtoupper($mata_uang_asing).'IDR=X&f=a';

		if (!$data = file($url)) {
			throw new Exception('Tidak dapat mengambil data dari:'.$url);
		} else {
			return $data[0];
		}
	}

	/**
	 * Mengkonversi rupiah ke mata uang asing
	 *
	 * @param	float	jumlah rupiah
	 * @param	float	nilai tukar mata mata uang asing
	 * @param	float	jumlah pecahan yang ditampilkan
	 * @return	float
	 */
	public static function konversi($nominal_rupiah, $harga_uang_asing, $presisi = 2)
	{
		return round($nominal_rupiah/$harga_uang_asing, $presisi);
	}

	/**
 	* Menyebut nominal rupiah
	*
	* Saya bener-bener lupa!!!! & males googling lg :) Jika milik Anda silahkan klaim!!!
	*
	* @param	float	nominal rupiah
 	* @return	string
	*/
	private function kekata($x) {
		$x = abs($x);
		$angka = array("", "satu", "dua", "tiga", "empat", "lima",
			"enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";

		if ($x <12) {
			$temp = " ". $angka[$x];
		} else if ($x <20) {
			$temp = $this->kekata($x - 10). " belas";
		} else if ($x <100) {
			$temp = $this->kekata($x/10)." puluh". $this->kekata($x % 10);
		} else if ($x <200) {
			$temp = " seratus" . $this->kekata($x - 100);
		} else if ($x <1000) {
			$temp = $this->kekata($x/100) . " ratus" . $this->kekata($x % 100);
		} else if ($x <2000) {
			$temp = " seribu" . $this->kekata($x - 1000);
		} else if ($x <1000000) {
			$temp = $this->kekata($x/1000) . " ribu" . $this->kekata($x % 1000);
		} else if ($x <1000000000) {
			$temp = $this->kekata($x/1000000) . " juta" . $this->kekata($x % 1000000);
		} else if ($x <1000000000000) {
			$temp = $this->kekata($x/1000000000) . " milyar" . $this->kekata(fmod($x,1000000000));
		} else if ($x <1000000000000000) {
			$temp = $this->kekata($x/1000000000000) . " trilyun" . $this->kekata(fmod($x,1000000000000));
		}
		return $temp;
	}

	public function terbilang($nominal, $style=4) {
		if($nominal<0) {
			$hasil = "minus ". trim($this->kekata($nominal));
		} else {
			$hasil = trim($this->kekata($nominal));
		}
		switch ($style) {
			case 1:
				$hasil = strtoupper($hasil);
				break;
			case 2:
				$hasil = strtolower($hasil);
				break;
			case 3:
				$hasil = ucwords($hasil);
				break;
			default:
				$hasil = ucfirst($hasil);
				break;
		}
		return $hasil;
	}
}
