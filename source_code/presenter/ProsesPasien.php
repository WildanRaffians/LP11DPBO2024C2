<?php

include("KontrakPresenter.php");


class ProsesPasien implements KontrakPresenter
{
	private $tabelpasien;
	private $data = [];

	function __construct()
	{
		//konstruktor
		try {
			$db_host = "localhost"; // host 
			$db_user = "root"; // user
			$db_password = ""; // password
			$db_name = "mvp_php"; // nama basis data
			$this->tabelpasien = new TabelPasien($db_host, $db_user, $db_password, $db_name); //instansi TabelPasien
			$this->data = array(); //instansi list untuk data Pasien
			//data = new ArrayList<Pasien>;//instansi list untuk data Pasien
		} catch (Exception $e) {
			echo "wiw error" . $e->getMessage();
		}
	}

	function prosesDataPasien()
	{
		try {
			//mengambil data di tabel pasien
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
				$pasien->setTelp($row['telp']); //mengisi email


				$this->data[] = $row; //tambahkan data pasien ke dalam list
			}
			//tutup koneksi
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "wiw error part 2" . $e->getMessage();
		}
	}

	function prosesDataPasienById($id)
	{
		try {
			//mengambil data di tabel pasien
			$this->tabelpasien->open();
			$this->tabelpasien->getPasienById($id);
			$row = $this->tabelpasien->getResult();
			$pasien = new Pasien($row['id'], $row['nik'], $row['nama'], $row['tempat'], $row['tl'], $row['gender'], $row['email'], $row['telp']);

			$this->data[] = $row; //tambahkan data pasien ke dalam list
			
			//tutup koneksi
			$this->tabelpasien->close();
		} catch (Exception $e) {
			//memproses error
			echo "wiw error part 2" . $e->getMessage();
		}
	}

	function addDataPasien($data)
	{
		try {
			//open koneksi
			$this->tabelpasien->open();
			//menambah data di tabel pasien
			$this->tabelpasien->addPasien($data);
			//tutup koneksi
			$this->tabelpasien->close();

			header("location:index.php");
		} catch (Exception $e) {
			//memproses error
			echo "wiw error part 3a" . $e->getMessage();
		}
	}
	function updateDataPasien($id, $data)
	{
		try {
			//open koneksi
			$this->tabelpasien->open();
			//mengubah data di tabel pasien
			$this->tabelpasien->updatePasien($id, $data);
			//tutup koneksi
			$this->tabelpasien->close();

			header("location:index.php");
		} catch (Exception $e) {
			//memproses error
			echo "wiw error part 3b" . $e->getMessage();
		}
	}
	function deleteDataPasien($id)
	{
		try {
			//open koneksi
			$this->tabelpasien->open();
			//mengubah data di tabel pasien
			$this->tabelpasien->deletePasien($id);
			//tutup koneksi
			$this->tabelpasien->close();

			header("location:index.php");
		} catch (Exception $e) {
			//memproses error
			echo "wiw error part 3c" . $e->getMessage();
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
}
