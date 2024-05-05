<?php

include("KontrakPresenter.php");


class ProsesPasien implements KontrakPresenter
{
	private $tabelpasien;
	private $data = [];

	function __construct()
	{
		// constructor
		try {
			$db_host = "localhost"; // host 
			$db_user = "root"; // user
			$db_password = ""; // password
			$db_name = "mvp_php"; // nama basis data
			$this->tabelpasien = new TabelPasien($db_host, $db_user, $db_password, $db_name); // instansiasi Tabel Pasien
			$this->data = array(); // instansiasi list untuk data Pasien
		} catch (Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	function prosesDataPasien()
	{
		try {
			// Get data from database (table: pasien)
			$this->tabelpasien->open();
			$this->tabelpasien->getPasien();
			while ($row = $this->tabelpasien->getResult()) {
				//ambil hasil query
				$pasien = new Pasien(); //instansiasi objek pasien untuk setiap data pasien
				$pasien->setId($row['id']); //mengisi id
				$pasien->setNik($row['nik']); //mengisi nik
				$pasien->setNama($row['nama']); //mengisi nama
				$pasien->setTempat($row['tempat']); //mengisi tempat
				$pasien->setTl($row['tl']); //mengisi tl
				$pasien->setGender($row['gender']); //mengisi gender
				$pasien->setEmail($row['email']); //mengisi email
				$pasien->setTelp($row['telp']); //mengisi telepon


				$this->data[] = $row; // nambahin data pasien ke dalam list
			}
			// close connection to database
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//	error handling
			echo "Error: " . $e->getMessage();
		}
	}

	function getDataPasienById($id)
	{
		try {
			$this->tabelpasien->open();
			$data = $this->tabelpasien->getPasienById($id);
			$this->tabelpasien->close();
			return $data;
		} catch (Exception $e) {
			// error handling
			echo "Error: " . $e->getMessage();
		}
	}


	function getId($i)
	{
		//mengembalikan id Pasien dengan indeks ke i
		return $this->data[$i]['id'];
	}
	function getNik($i)
	{
		//mengembalikan nik Pasien dengan indeks ke i
		return $this->data[$i]['nik'];
	}
	function getNama($i)
	{
		//mengembalikan nama Pasien dengan indeks ke i
		return $this->data[$i]['nama'];
	}
	function getTempat($i)
	{
		//mengembalikan tempat Pasien dengan indeks ke i
		return $this->data[$i]['tempat'];
	}
	function getTl($i)
	{
		//mengembalikan tanggal lahir(TL) Pasien dengan indeks ke i
		return $this->data[$i]['tl'];
	}
	function getGender($i)
	{
		//mengembalikan gender Pasien dengan indeks ke i
		return $this->data[$i]['gender'];
	}
	function getEmail($i)
	{
		//mengembalikan email Pasien dengan indeks ke i
		return $this->data[$i]['email'];
	}
	function getTelp($i)
	{
		//mengembalikan telp Pasien dengan indeks ke i
		return $this->data[$i]['telp'];
	}
	function getSize()
	{
		return sizeof($this->data);
	}

	function add($data)
	{
		try {
			$this->tabelpasien->open();
			$this->tabelpasien->addPasien($data);
			$this->tabelpasien->close();
		} catch (Exception $e) {
			// error handling
			echo "Error: " . $e->getMessage();
		}
	}

	function update($id, $data)
	{
		try {
			$this->tabelpasien->open();
			$this->tabelpasien->updatePasien($id, $data);
			$this->tabelpasien->close();
		} catch (Exception $e) {
			// error handling
			echo "Error: " . $e->getMessage();
		}
	}

	function delete($id)
	{
		try {
			$this->tabelpasien->open();
			$this->tabelpasien->deletePasien($id);
			$this->tabelpasien->close();
		} catch (Exception $e) {
			// error handling
			echo "Error: " . $e->getMessage();
		}
	}
}
