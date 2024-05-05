<?php

include("KontrakView.php");
include("presenter/ProsesPasien.php");

class DeleteView implements KontrakView
{
    private $prosesPasien;

    function __construct()
    {
        // constructor
        $this->prosesPasien = new ProsesPasien();
    }

    function tampil()
    {
        if (!empty($_GET['id_hapus'])) {
            $id = $_GET['id_hapus'];
            $this->prosesPasien->delete($id);
            header("location:index.php");
        }
    }
}
