<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id='title'>Tambah Data Pasien</title>
    <style>
        input[type=submit] {
            background-color: #202157;
            border: none;
            border-radius: 8px;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
        }

        button[type=reset] {
            background-color: #eb2d3a;
            border: none;
            border-radius: 8px;
            color: white;
            padding: 16px 32px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
        }

        #form,
        #title {
            display: table-cell;
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>

<body>

    <?php

    include("KontrakView.php");
    include("presenter/ProsesPasien.php");

    class UpdateView implements KontrakView
    {
        private $prosespasien;
        private $tpl;

        function __construct()
        {
            // constructor
            $this->prosespasien = new ProsesPasien();
        }

        function tampil()
        {
            $data = "";

            if (isset($_POST['submit'])) {
                $id = $_POST['id_update'];
                $this->prosespasien->update($id, $_POST);
                header("Location: index.php");
                exit();
            } elseif (isset($_GET['id_update'])) {
                $id = $_GET['id_update'];
                $result = $this->prosespasien->getDataPasienById($id);
                if ($result) {
                    $pasien = $result->fetch_assoc();
                    $data = "
                <form action='update.php' method='post'>
                <input type='hidden' name='id_update' value='{$id}'>
                    <div class='form-group '>
                        <label for='nama'>Nama Lengkap</label>
                        <input class='form-control', type='text' id='nama' name='nama' value='{$pasien['nama']}'>
                    </div>
                    <div class='form-group '>
                        <label for='nik'>NIK</label>
                        <input class='form-control', type='text' id='nik' name='nik' value='{$pasien['nik']}'>
                    </div>
                    <div class='form-group '>
                        <label for='email'>Email</label>
                        <input class='form-control', type='email' id='email' name='email' value='{$pasien['email']}'>
                    </div>
                    <div class='form-group '>
                        <label for='tempat'>Tempat Lahir</label>
                        <input class='form-control', type='text' id='tempat' name='tempat' value='{$pasien['tempat']}'>
                    </div>
                    <div class='form-group '>
                        <label for='tl'>Tanggal Lahir</label>
                        <input class='form-control', type='date' id='tl' name='tl' value='{$pasien['tl']}'>
                    </div>
                    <div class='form-group '>
                        <label for='gender'>Gender</label>
                        <select class='form-control' id='gender' name='gender'>
                            <option value='Laki-laki'>Laki-Laki</option>
                            <option value='Perempuan'>Perempuan</option>
                        </select>
                    </div>
                    <div class='form-group '>
                        <label for='telp'>Nomor Telepon</label>
                        <input class='form-control', type='text' id='telp' name='telp' value='{$pasien['telp']}'>
                    </div>
                    <div class='form-group '>
                        <input type='submit' value='Submit' name='submit'>
                        <button type='reset' class='btn btn-default pull-right'>Cancel</button>
                    </div>
                </form>";
                }
            }

            if (isset($_POST['submit'])) {
                $id = $_POST['id_update'];
                $this->prosespasien->update($id, $_POST);
                header("Location: index.php");
                exit();
            }

            $judul = 'Update Data Pasien';

            // Membaca template skin.html
            $this->tpl = new Template("templates/skinForm.html");

            // Mengganti kode Data_Tabel dengan data yang sudah diproses
            $this->tpl->replace("DATA_CRUD", $data);
            $this->tpl->replace("TITLE_CRUD", $judul);

            // Menampilkan ke layar
            $this->tpl->write();
        }
    }
