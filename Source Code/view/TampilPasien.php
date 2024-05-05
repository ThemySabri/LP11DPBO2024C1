<?php


include("KontrakView.php");
include("presenter/ProsesPasien.php");

class TampilPasien implements KontrakView
{
	private $prosesPasien;
	private $tpl;

	function __construct()
	{
		// constructor
		$this->prosesPasien = new ProsesPasien();
	}

	function tampil()
	{
		$this->prosesPasien->prosesDataPasien();
		$data = null;

		for ($i = 0; $i < $this->prosesPasien->getSize(); $i++) {
			$no = $i + 1;
			$id = $this->prosesPasien->getId($i);
			$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosesPasien->getNik($i) . "</td>
			<td>" . $this->prosesPasien->getNama($i) . "</td>
			<td>" . $this->prosesPasien->getTempat($i) . "</td>
			<td>" . $this->prosesPasien->getTl($i) . "</td>
			<td>" . $this->prosesPasien->getGender($i) . "</td>
			<td>" . $this->prosesPasien->getEmail($i) . "</td>
			<td>" . $this->prosesPasien->getTelp($i) . "</td>
			<td>
				<a class='btn btn-warning' href='update.php?id_update=" . $id . " ' title='Update Data'>Ubah Data</a>
				<a class='btn btn-danger' href='delete.php?id_hapus=" . $id . " ' title='Delete Data'>Hapus</a>
			</td>
			</tr>";
		}
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}
}
