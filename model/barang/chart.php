<?php
include "../config.php";
session_start();
$id = $_POST['id_barang'];
$id_user  =  $_SESSION['id_user'];
$id_kategori = $_POST['id_kategori'];
$start = $_POST['start'];
$end = $_POST['end'];
$totall = str_replace(",","",$_POST['total']);
$pcs = $_POST['pcs'];
$jumlah = 0;
$nama_pemesan = $_POST['nama_pemesan'];
$no_telp = $_POST['no_telp'];
$time = strtotime($end) - strtotime($start);
$jumlah = $time/(60*60*24);

if($jumlah == 0){
$jumlah = 1;
}



if($id_kategori != 4){
$jumlah = $jumlah + 1;
$mysqli  = "INSERT INTO tbl_chart 
                        (id_barang,
                        id_user,
                        jumlah,
                        pcs,
                        start_tanggal,
                        end_tanggal,
                        total,
                        nama_pemesan,
                        no_hp) 
            VALUES ('$id',
                    '$id_user',
                    '$jumlah',
                    '$pcs',
                    '$start',
                    '$end',
                    '$totall',
                    '$nama_pemesan',
                    '$no_telp')";
                    
$result  = mysqli_query($conn, $mysqli);
}

if($id_kategori == 4){
    $mysqli  = "INSERT INTO tbl_chart 
                            (id_barang,
                            id_user,
                            jumlah,
                            pcs,
                            start_tanggal,
                            end_tanggal,
                            total,
                            nama_pemesan,
                            no_hp) 
                VALUES ('$id',
                        '$id_user',
                        '$jumlah',
                        '$pcs',
                        '$start',
                        '$end',
                        '$totall',
                        '$nama_pemesan',
                        '$no_telp')";
    $result  = mysqli_query($conn, $mysqli);
}

if ($result) {
    echo "Input berhasil";
    header('location:../../home.php');
} else {
    echo "Input gagal";
}
mysqli_close($conn);