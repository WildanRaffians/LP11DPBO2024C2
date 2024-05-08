<?php


include("KontrakView.php");
include("presenter/ProsesPasien.php");

class TampilPasien implements KontrakView
{
	private $prosespasien; //presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosespasien = new ProsesPasien();
	}

	function tampil()
	{
		$this->prosespasien->prosesDataPasien();
		$data = null;

		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosespasien->getSize(); $i++) {
			$no = $i + 1;
			$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosespasien->getNik($i) . "</td>
			<td>" . $this->prosespasien->getNama($i) . "</td>
			<td>" . $this->prosespasien->getTempat($i) . "</td>
			<td>" . $this->prosespasien->getTl($i) . "</td>
			<td>" . $this->prosespasien->getGender($i) . "</td>
			<td>" . $this->prosespasien->getEmail($i) . "</td>
			<td>" . $this->prosespasien->getTelp($i) . "</td>
			<td>
				<a class='btn btn-success' href='index.php?id_edit=".$this->prosespasien->getId($i)."'>Edit</a>
				<a class='btn btn-danger' href='index.php?id_hapus=".$this->prosespasien->getId($i)."'>Delete</a>
			</td>
			";
		}
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function formTambah(){
		$form = null;

		$form .= '<form action="index.php?add" method="POST" class="form">
        <div class="form-group">
          <label for="nik">NIK</label>
          <input type="text" class="form-control" id="nik" name="nik" required>
        </div>
        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
          <label for="tempat">Tempat</label>
          <input type="text" class="form-control" id="tempat" name="tempat" required>
        </div>
        <div class="form-group">
          <label for="tl">Tanggal Lahir</label>
          <input type="date" class="form-control" id="tl" name="tl" required>
        </div>
        <div class="form-group">
          <label for="gender">Gender</label>
          <select class="form-control" id="gender" name="gender" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
          </select>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="telp">Telp</label>
          <input type="tel" class="form-control" id="telp" name="telp" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
      </form>';

	  	$this->tpl = new Template("templates/form.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_FORM", $form);

		// Menampilkan ke layar
		$this->tpl->write();
	}
	
	function formUbah($id){
		$this->prosespasien->prosesDataPasienById($id);
		
		$form = null;
		$lSelected = ($this->prosespasien->getGender(0) == "Laki-laki") ? 'selected' : '';
		$pSelected = ($this->prosespasien->getGender(0) == "Perempuan") ? 'selected' : '';
		

		$form .= '<form action="index.php?id_edit='.$id.'" method="POST" class="form">
        <div class="form-group">
          <label for="nik">NIK</label>
          <input type="text" class="form-control" id="nik" name="nik" value="'. $this->prosespasien->getNik(0) .'" required>
        </div>
        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama" value="'. $this->prosespasien->getNama(0) .'" required>
        </div>
        <div class="form-group">
          <label for="tempat">Tempat</label>
          <input type="text" class="form-control" id="tempat" name="tempat" value="'. $this->prosespasien->getTempat(0) .'" required>
        </div>
        <div class="form-group">
          <label for="tl">Tanggal Lahir</label>
          <input type="date" class="form-control" id="tl" name="tl" value="'. $this->prosespasien->getTl(0) .'" required>
        </div>
        <div class="form-group">
          <label for="gender">Gender</label>
          <select class="form-control" id="gender" name="gender" required>
            <option value="Laki-laki" '.$lSelected.'>Laki-laki</option>
            <option value="Perempuan" '.$pSelected.'>Perempuan</option>
          </select>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="'. $this->prosespasien->getEmail(0) .'" required>
        </div>
        <div class="form-group">
          <label for="telp">Telp</label>
          <input type="tel" class="form-control" id="telp" name="telp" value="'. $this->prosespasien->getTelp(0) .'" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
      </form>';

	  	$this->tpl = new Template("templates/form.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_FORM", $form);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function add($data){
		$this->prosespasien->addDataPasien($data);
	}
	function update($id, $data){
		$this->prosespasien->updateDataPasien($id, $data);
	}
	function delete($id){
		$this->prosespasien->deleteDataPasien($id);
	}
}
