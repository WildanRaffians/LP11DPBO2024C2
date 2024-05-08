<?php

/******************************************
Asisten Pemrogaman 13
 ******************************************/

include("model/Template.class.php");
include("model/DB.class.php");
include("model/Pasien.class.php");
include("model/TabelPasien.class.php");
include("view/TampilPasien.php");


$tp = new TampilPasien();

if(isset($_GET['add'])){
    if (isset($_POST['submit'])) {
        $data = $tp->add($_POST);
    } else{
        $data = $tp->formTambah();
    }
} else if (!empty($_GET['id_edit'])) {
    $id = $_GET['id_edit'];

    if(isset($_POST['submit'])) {
        $data = $tp->update($id, $_POST);
    } else{
        $data = $tp->formUbah($id);
    }
} else if(isset($_GET['id_hapus'])){
    $id = $_GET['id_hapus'];

    $data = $tp->delete($id);
} else{
    $data = $tp->tampil();
}
