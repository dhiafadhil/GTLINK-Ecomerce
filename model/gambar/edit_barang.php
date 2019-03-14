
<?php
    include "../config.php";

$id_barang = $_GET['id_barang'];

function reArrayFiles(&$file_post) {

    $file_ary = array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for ($i=0; $i<$file_count; $i++) {

        foreach ($file_keys as $key) {

            $file_ary[$i][$key] = $file_post[$key][$i];

        }

    }
    return $file_ary;

}

$file_ary = reArrayFiles($_FILES['gambar']);

    foreach($file_ary as $file){

        $lokasi_file = $file['tmp_name'];
        $name = round(microtime(true)) . '-' . $file['name'];//fungsi untuk membuat nama acak
        $direktori   = "../../images/$name";
        
        if (!empty($lokasi_file)) {

            if (move_uploaded_file($lokasi_file,$direktori)){
            // code C
                $mysqli = "INSERT INTO tbl_gambar (id_barang,gambar) VALUES ('$id_barang', '$name')";
                $aksi = mysqli_query($conn,$mysqli);

            } else {

            var_dump("tidak berhasil"); exit;

            }

            if (!$aksi) {

            $error++;

            }
        }
    }

        if($error == 0){

            header('location:../../view/gambar/list_gambarBarang.php?id_barang='.$id_barang);
        
        }

        mysqli_close($conn);
?>