<?php

/******************************************
Asisten Pemrogaman 13
 ******************************************/

class TabelPasien extends DB
{
	function getPasien()
	{
		// Query mysql select data pasien
		$query = "SELECT * FROM pasien";
		// Mengeksekusi query
		return $this->execute($query);
	}
	
	function getPasienById($id)
	{
		// Query mysql select data pasien
        $query = "SELECT * FROM pasien where id=$id";

		// Mengeksekusi query
		return $this->execute($query);
	}
	
	function addPasien($data)
	{
		$nik = $data['nik'];
		$nama = $data['nama'];
		$tempat = $data['tempat'];
		$tl = $data['tl'];
		$gender = $data['gender'];
		$email = $data['email'];
		$telp = $data['telp'];
		// Query mysql insert data pasien
        $query = " INSERT INTO `pasien`(`nik`, `nama`, `tempat`, `tl`, `gender`, `email`, `telp`) VALUES ( '$nik', '$nama', '$tempat', '$tl', '$gender', '$email', '$telp' )";
        
		// Mengeksekusi query
		return $this->execute($query);
	}

	function updatePasien($id, $data){
        $nik = $data['nik'];
		$nama = $data['nama'];
		$tempat = $data['tempat'];
		$tl = $data['tl'];
		$gender = $data['gender'];
		$email = $data['email'];
		$telp = $data['telp'];
    
        $query = "UPDATE pasien set nik='$nik', nama='$nama', tempat='$tempat', tl='$tl', gender='$gender', email='$email', telp='$telp' where id='$id'";
        return $this->execute($query);
    }

	function deletePasien($id){
        $query = "DELETE from `pasien` where id=$id";
        return $this->execute($query);
    }
}
