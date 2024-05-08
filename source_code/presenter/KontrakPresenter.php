<?php


interface KontrakPresenter
{
	public function prosesDataPasien();
	public function prosesDataPasienById($id);
	public function addDataPasien($data);
	public function updateDataPasien($id, $data);
	public function deleteDataPasien($id);
	public function getId($i);
	public function getNik($i);
	public function getNama($i);
	public function getTempat($i);
	public function getTl($i);
	public function getGender($i);
	public function getSize();
}
