<?php

interface KontrakView{
	public function tampil();
	public function formTambah();
	public function formUbah($id);
	public function add($data);
	public function update($id, $data);
	public function delete($id);
}

?>