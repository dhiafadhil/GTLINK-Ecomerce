<?php
include "../../page3.php";
include "../../model/config.php";
session_start();

if (empty($_SESSION['level'])){

    header("location:../../view/user/login.php");

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
$level = $_SESSION['level'];
$id = $_GET['id_room'];

$queryHotel = "SELECT tbl_hotel.*,
                        tbl_room.id_room,
                        tbl_room.tipe_room,
                        tbl_room.tipe_bed,
                        tbl_room.stock_room,
                        tbl_room.harga_room,
                        tbl_user.nama_user,
                        tbl_user.lokasi,
                        tbl_user.alamat,
                        tbl_kategori.nama_kategori,
                        tbl_kategori.id_kategori,
                        tbl_user.lokasi,
                        tbl_komisi.principal,
                        tbl_komisi.komisi1,
                        tbl_komisi.komisi2
FROM tbl_hotel
INNER JOIN tbl_room ON tbl_room.id_hotel = tbl_hotel.id_hotel
INNER JOIN tbl_user ON tbl_user.id_user = tbl_hotel.id_user
INNER JOIN tbl_kategori ON tbl_kategori.id_kategori = tbl_hotel.id_kategori
INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_hotel.id_hotel
WHERE tbl_room.id_room = $id";
$dataHotel = mysqli_query($conn,$queryHotel);

while($data_hotel = mysqli_fetch_array($dataHotel)) {

    $id_kategori = $data_hotel['id_kategori'];
    $nama_kategori = $data_hotel['nama_kategori'];
    $nama_barang = $data_hotel['nama_hotel'];
    $id_room = $data_hotel['id_room'];
    $room = $data_hotel['tipe_room'];
    $bed = $data_hotel['tipe_bed'];
    $stock_room = $data_hotel['stock_room'];
    $keterangan = $data_hotel['keterangan'];
    $harga_room = $data_hotel['harga_room'];
    $alamat = $data_hotel['alamat'];
    $lokasi = $data_hotel['lokasi'];
    $principal_room = $data_hotel['principal'];
    $komisi_room = $data_hotel['komisi1'];
    $komisi2_room = $data_hotel['komisi2'];

    if($level == 3){
        $harga_room = $harga_room + $principal_room;
    } else if($level == 4){
        $harga_room = $harga_room + $principal_room + $komisi_room;
    }else if($level == 5){
        $harga_room = $harga_room + $principal_room + $komisi_room + $komisi2_room;
    }
}
$no=1;
?>
</head>
<body class="animsition">
<?php include "../../menu3.php";?>
    <div class="main-content">
        <div class="section__content section__content--">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-data m-b-40">
                            <h3 class="title-3 m-b-30">
                                <i class="fas fa-home"></i></i>GT LINK</h3>
                                    <form id="update" action="../../model/barang/chart.php"  method="POST">
                                        <div class=p-b-10>
                                            <div class="row">
                                            <div class="col-md-2 p-b-20"></div>
                                            <div class=" col-md-8  p-b-20">
                                            <?php   $gambar = "SELECT gambar FROM tbl_gambar WHERE id_barang = $id_room";
                                                    $result = mysqli_query($conn,$gambar);
                                            ?>
                                            <div id="carouselExampleControls" class="carousel slide center" data-ride="carousel">
                                                <div class="carousel-inner ">
                                            <?php
                                            $count = 0;
                                            while($data_gambar = mysqli_fetch_array($result)){
                                                if ($count == 0) {
                                                ?>
                                                    <div class="carousel-item active">
                                                        <img src="../../images/<? echo $data_gambar['gambar'];?>" style="height:400px;" class="d-block w-100 " alt="..." >
                                                    </div>
                                                <?
                                                } else {
                                                ?>
                                                    <div class="carousel-item">
                                                    <img src="../../images/<? echo $data_gambar['gambar'];?>" style="height:400px;" class="d-block w-100 " alt="..." >
                                                    </div>
                                                <?php
                                                }
                                                $count++; } ?>
                                                </div>
                                                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                        </div>
                                            <div class=" col-md-2  p-b-20"></div>
                                        <br>
                                        <div class=" col-md-2"></div>
                                        <div class=" col-md-5">
                                                <i class="fas fa-building" id="kategori" name="kategori">
                                                    <?php echo $nama_kategori;?>
                                                </i>
                                                    <?php echo $nama_barang;?>
                                                        <div>
                                                            <p class="form-control-static mt-2">Room
                                                                <?php echo $room; ?>, Bed <?php echo $bed; ?>
                                                            </p>
                                                        </div>
                                                        <address class="mt-3">
                                                            <?php echo $keterangan; ?>
                                                        </address>
                                                        <div>
                                                            <i>
                                                                <?php echo "$alamat, $lokasi" ?>
                                                            </i>
                                                        </div>
                                                        <div>
                                                            <span class="fas fa-money-check mt-3">IDR. 
                                                                <input type="hidden" id="harga" value ="<?php echo $harga_room;?>" required>
                                                                    <?php echo number_format($harga_room); ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class=" col-md-3">
                                                        <label for="x_card_code" class="control-label mb-1"><i>Date From</i> </label>
                                                        <br>
                                                        <input type="date" id="start"  name="start"
                                                            class="form-control" placeholder="" onchange="DateFrom()" required>
                                                        <label for="cc-exp" class="control-label mb-1 mt-3"><i>Chek Out</i> </label>
                                                        <br>
                                                        <input type="date" id="end" name="end" class="form-control"
                                                            placeholder="" onchange="CheckOut()">
                                                            <label for="x_card_code" class="control-label mb-1 mt-3"><i>Quantitiy</i></label>
                                                        <input type="number" id="pcs"  name="pcs" min="0" max="<?php echo $stock_room; ?>" class="form-control" placeholder="" required>
                                                    </div>
                                                    </div>
                                                    <br><br>
                                                    <div class="row">
                                                        <div class="col-sm-4"></div>
                                                            <div class="col-sm-4">
                                                                <div class=" text-center">
                                                                    <label for="inputSuccess2i" class=" form-control-label">Nama Pemesan</label>
                                                                    <input type="text" name="nama_pemesan" class="form-control-success form-control" required>
                                                                </div>
                                                                <br>
                                                                <div class="text-center">
                                                                    <label for="inputSuccess2i" class=" form-control-label">No Telephone</label>
                                                                        <input type="number" name="no_telp" class="form-control-success form-control" required>
                                                                </div>
                                                    </div>
                                                    <div class="col-sm-4"></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-4"></div>
                                                                <div class="text-center col-sm-6">
                                                                            <address class="mt-3">Total Harga : IDR. <? $nbsp; ?>
                                                                                <input type="text" class ="" id="total" name="total"readonly>
                                                                            </address>
                                                                    </div>
                                                            <div class="col-sm-2"></div>
                                                        </div>
                                                        <br>
                                                        <div class="footer text-center p-b-10">
                                                            <button type="submit" class="btn btn-primary btn-sm">
                                                                <i class="fas fa-cart-plus "></i>
                                                            </button>
                                                            <button class="btn btn-danger btn-sm" onclick="javascript:window.history.back();">
                                                                <i class="fas fa-undo"></i>
                                                            </button>
                                                        <input type="hidden" name="id_barang" value=<?php echo $id;?>>
                                                        <input type="hidden" name="id_kategori" value=<?php echo $id_kategori;?>>
                                                </form>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
<?php
include "../../js/page3.php";
?>

<script type="text/javascript">
        
        function DateFrom() {
            var tglPertama = document.getElementById("start").value;
            var tglKedua = document.getElementById("end").value;

            if (Date.parse(tglKedua) < Date.parse(tglPertama)){
                document.getElementById("end").value = tglPertama;
            }
            if( $( "#pcs" ).val()!=""){
                Hitung();
            }
        }
        function CheckOut(){
            var tglPertama = document.getElementById("start").value;
            var tglKedua = document.getElementById("end").value;

            if (Date.parse(tglKedua) < Date.parse(tglPertama)){
                document.getElementById("start").value = tglKedua;
            }
            if( $( "#pcs" ).val()!=""){
                Hitung();
            }
        }
        function Hitung(){
            var hasil = ""
            var tglPertama = document.getElementById("start").value;
            var tglKedua = document.getElementById("end").value;
            var harga = document.getElementById("harga").value;
            var jumlah = document.getElementById("pcs").value;
            var tgl = Date.parse(tglKedua) - Date.parse(tglPertama);
            var selisih =  tgl/(60*60*60*400);
            if(selisih == 0){
                selisih = 1;
                hasil = (selisih * harga);
            }
            else if(selisih > 0){
                hasil = selisih * harga;
            }
            var jumlah_hasil = hasil * jumlah;
            document.getElementById("total").value = numberFormat(jumlah_hasil);
        }

        $( "#pcs" ).keyup(function() {
            Hitung();
            $("#harga").val("<?php echo $harga_room;?>")
        });
        $( "#pcs" ).change(function() {
            Hitung();
            $("#harga").val("<?php echo $harga_room;?>");
        });
        $( "#pcs" ).click(function() {
            $("#harga").val("<?php echo $harga_room;?>");
        });

        $("#harga").change(function() {
            $("#harga").val("<?php echo $harga_room;?>");
        });

        function numberFormat(nStr)
        {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
    </script>
</body>

</html>
<!-- end document-->
<?php
mysqli_close($conn);
?>