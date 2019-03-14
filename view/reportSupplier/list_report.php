<?php
include "../../page3.php";
include "../../model/config.php";
session_start();

if (empty($_SESSION['level'])){
    
    header("location:view/user/login.php");
}
?>
<head>
<?php

//member while

$id = $_SESSION['id_user'];
$user = "SELECT * FROM tbl_user WHERE id_child = $id";
$resultUser = mysqli_query($conn,$user);

//date month
$querymonth = "SELECT created_at FROM tbl_transaksi GROUP BY MONTH(created_at)";
$resultMonth = mysqli_query($conn,$querymonth);

//date year
$queryYear = "SELECT created_at FROM tbl_transaksi GROUP BY YEAR(created_at)";
$resultYear = mysqli_query($conn,$queryYear);


$month = $_POST['month'];
$year = $_POST['year'];



//search report
if (isset($month)){

        $queryReport = "SELECT * FROM
        (SELECT tbl_detailTransaksi.id_barang,
                                tbl_detailTransaksi.created_at,
                                tbl_detailTransaksi.pcs,
                                tbl_detailTransaksi.start_tanggal as mulai,
                                tbl_detailTransaksi.end_tanggal as selesai,
                                tbl_hotel.nama_hotel as nama_produk,
                                tbl_user.id_user,
                                tbl_user.nama_user,
                                pembeli.nama_user as nama_pembeli,
                                tbl_room.harga_room as harga
                                
            FROM `tbl_detailTransaksi`
                INNER JOIN tbl_room ON tbl_room.id_room = tbl_detailTransaksi.id_barang
                INNER JOIN tbl_hotel ON tbl_hotel.id_hotel = tbl_room.id_hotel
                INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = 	tbl_detailTransaksi.id_transaksi
                INNER JOIN tbl_user ON tbl_user.id_user = tbl_hotel.id_user
                INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_hotel.id_hotel
                INNER JOIN tbl_user as pembeli ON pembeli.id_user = tbl_transaksi.id_user
                WHERE MONTH(tbl_transaksi.created_at) like '%$month%'
            GROUP BY tbl_transaksi.id_transaksi
            UNION ALL
            SELECT detail.id_barang,
                                    detail.created_at,
                                    detail.pcs,
                                    detail.start_tanggal,
                                    detail.end_tanggal,
                                    tbl_barang.nama_barang,
                                    tbl_user.id_user,
                                    tbl_user.nama_user,
                                    pembeli.nama_user,
                                    tbl_barang.harga
            FROM `tbl_detailTransaksi` as detail
                INNER JOIN tbl_barang on tbl_barang.id_barang = detail.id_barang
                INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = detail.id_transaksi
                INNER JOIN tbl_user ON tbl_user.id_user = tbl_barang.id_user
                INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_barang.id_barang
                INNER JOIN tbl_user as pembeli ON pembeli.id_user = tbl_transaksi.id_user
                    WHERE MONTH(tbl_transaksi.created_at) like '%$month%'
                GROUP BY tbl_transaksi.id_transaksi ) AS a WHERE a.id_user = $id
                ORDER BY a.created_at DESC
            ";
    $resultReport = mysqli_query($conn,$queryReport);

}

if (isset($year)){

    $queryReport = "SELECT * FROM
    (SELECT tbl_detailTransaksi.id_barang,
                            tbl_detailTransaksi.created_at,
                            tbl_detailTransaksi.pcs,
                            tbl_detailTransaksi.start_tanggal as mulai,
                            tbl_detailTransaksi.end_tanggal as selesai,
                            tbl_hotel.nama_hotel as nama_produk,
                            tbl_user.id_user,
                            tbl_user.nama_user,
                            pembeli.nama_user as nama_pembeli,
                            tbl_room.harga_room as harga
                            
        FROM `tbl_detailTransaksi`
            INNER JOIN tbl_room ON tbl_room.id_room = tbl_detailTransaksi.id_barang
            INNER JOIN tbl_hotel ON tbl_hotel.id_hotel = tbl_room.id_hotel
            INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = 	tbl_detailTransaksi.id_transaksi
            INNER JOIN tbl_user ON tbl_user.id_user = tbl_hotel.id_user
            INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_hotel.id_hotel
            INNER JOIN tbl_user as pembeli ON pembeli.id_user = tbl_transaksi.id_user
            WHERE YEAR(tbl_transaksi.created_at) like '%$year%'
        GROUP BY tbl_transaksi.id_transaksi
        UNION ALL
        SELECT detail.id_barang,
                                detail.created_at,
                                detail.pcs,
                                detail.start_tanggal,
                                detail.end_tanggal,
                                tbl_barang.nama_barang,
                                tbl_user.id_user,
                                tbl_user.nama_user,
                                pembeli.nama_user,
                                tbl_barang.harga
        FROM `tbl_detailTransaksi` as detail
            INNER JOIN tbl_barang on tbl_barang.id_barang = detail.id_barang
            INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = detail.id_transaksi
            INNER JOIN tbl_user ON tbl_user.id_user = tbl_barang.id_user
            INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_barang.id_barang
            INNER JOIN tbl_user as pembeli ON pembeli.id_user = tbl_transaksi.id_user
                WHERE YEAR(tbl_transaksi.created_at) like '%$year%'
            GROUP BY tbl_transaksi.id_transaksi ) AS a WHERE a.id_user = $id
            ORDER BY a.created_at DESC
        ";
    $resultReport = mysqli_query($conn,$queryReport);
}


if (isset($month) && isset($year)){

    $queryReport = "SELECT * FROM
    (SELECT tbl_detailTransaksi.id_barang,
                            tbl_detailTransaksi.created_at,
                            tbl_detailTransaksi.pcs,
                            tbl_detailTransaksi.start_tanggal as mulai,
                            tbl_detailTransaksi.end_tanggal as selesai,
                            tbl_hotel.nama_hotel as nama_produk,
                            tbl_user.id_user,
                            tbl_user.nama_user,
                            pembeli.nama_user as nama_pembeli,
                            tbl_room.harga_room as harga,
                            tbl_transaksi.status
        FROM `tbl_detailTransaksi`
            INNER JOIN tbl_room ON tbl_room.id_room = tbl_detailTransaksi.id_barang
            INNER JOIN tbl_hotel ON tbl_hotel.id_hotel = tbl_room.id_hotel
            INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = 	tbl_detailTransaksi.id_transaksi
            INNER JOIN tbl_user ON tbl_user.id_user = tbl_hotel.id_user
            INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_hotel.id_hotel
            INNER JOIN tbl_user as pembeli ON pembeli.id_user = tbl_transaksi.id_user
            WHERE MONTH(tbl_transaksi.created_at) like '%$month%'
            AND YEAR(tbl_transaksi.created_at) like '%$year%'
        GROUP BY tbl_transaksi.id_transaksi
        UNION ALL
        SELECT detail.id_barang,
                                detail.created_at,
                                detail.pcs,
                                detail.start_tanggal,
                                detail.end_tanggal,
                                tbl_barang.nama_barang,
                                tbl_user.id_user,
                                tbl_user.nama_user,
                                pembeli.nama_user,
                                tbl_barang.harga,
                                tbl_transaksi.status
        FROM `tbl_detailTransaksi` as detail
            INNER JOIN tbl_barang on tbl_barang.id_barang = detail.id_barang
            INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = detail.id_transaksi
            INNER JOIN tbl_user ON tbl_user.id_user = tbl_barang.id_user
            INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_barang.id_barang
            INNER JOIN tbl_user as pembeli ON pembeli.id_user = tbl_transaksi.id_user
            WHERE MONTH(tbl_transaksi.created_at) like '%$month%'
            AND YEAR(tbl_transaksi.created_at) like '%$year%'
            GROUP BY tbl_transaksi.id_transaksi ) AS a WHERE a.id_user = $id
            AND a.status = 1
            ORDER BY a.created_at DESC
        ";
    $resultReport = mysqli_query($conn,$queryReport);



}

$terjual = "0";
$total_transaksi = "0";
?>
</head>
<body class="animsition">
<?php include "../../menu3.php";?>
    <!-- MAIN CONTENT-->
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="user-data m-b-40">
                            <h3 class="title-3 m-b-30">
                                <i class="fas fa-chart-line"></i></i>REPORT</h3>
                                <form action="list_report.php" method="post">
                                    <div class="table-data__tool-left p-l-20">
                                            <div class="rs-select2--light rs-select2--sm">
                                            <select class="js-select2" name="month">
                                                    <option selected="selected" value=''>Month</option>
                                                    <?php while ($rowMonth = mysqli_fetch_array($resultMonth)){
                                                        $date = date('m',strtotime($rowMonth['created_at']));
                                                        $name_date = " ";
                                                        
                                                            if($date == "01"){ $name_date = "January";}
                                                            else if($date == "02"){ $name_date = "February";}
                                                            else if($date == "03"){ $name_date = "March";}
                                                            else if($date == "04"){ $name_date = "April";}
                                                            else if($date == "05"){ $name_date = "May";}
                                                            else if($date == "06"){ $name_date = "June";}
                                                            else if($date == "07"){ $name_date = "July";}
                                                            else if($date == "08"){ $name_date = "August";}
                                                            else if($date == "09"){ $name_date = "September";}
                                                            else if($date == "10"){ $name_date = "October";}
                                                            else if($date == "11"){ $name_date = "November";}
                                                            else { $name_date = "December";}
                                                        
                                                        ?>
                                                    <option value="<?php if($date != 10) {echo str_replace('0','',$date);}?>">
                                                    <?php echo $name_date ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                            </div>
                                            <div class="rs-select2--light rs-select2--sm">
                                                <select class="js-select2" name="year">
                                                    <option selected="selected" value="">Year</option>
                                                    <?php while ($rowYear = mysqli_fetch_array($resultYear)){

                                                        $dateYear = date('Y',strtotime($rowYear['created_at']));
                                                        
                                                        ?>
                                                    <option value="<?php echo $dateYear;?>"><?php echo $dateYear ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="dropDownSelect2"></div>
                                            </div>
                                            <button  class="au-btn au-btn-load" type="submit">Search</button>
                                        </form>
                                        </div>
                                        <br>
                                        <div class="container-fluid">
                                            <table class="table table-responsive-data2">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">Tanggal</th>
                                                        <th class="text-center">Nama Produk</th>
                                                        <th class="text-center">Nama </th>
                                                        <th class="text-center">Harga</th>
                                                        <th class="text-center">Estimasi</th>
                                                        <th class="text-center">Quantity</th>
                                                        <th class="text-center">Total</th>

                                                    </tr>
                                                    </thead>
                                                    <?php while ($rowReport = mysqli_fetch_array($resultReport)){?>
                                                    <tbody>
                                                                <?php
                                                                $terjual = $rowReport['pcs'];
                                                                $data_pembeli[] = $rowReport['id_user'];
                                                                $jumlah_pembeli = count($data_pembeli);
                                                                $harga = $rowReport['harga'];
                                                                $mulai = date('d',strtotime($rowReport['mulai'])); 
                                                                $selesai = date('d',strtotime($rowReport['selesai']));
                                                                $estimasi = $selesai - $mulai;
                                                                
                                                                if($estimasi == 0){
                                                            
                                                                    $estimasi = 1;
                                                                
                                                                }
                                                                
                                                                $total = $harga * $estimasi * $terjual ;
                                                                $total_transaksi += $total;
                                                                
                                                                ?>
                                                            <tr> 
                                                                    <td class="text-center"><?php echo $rowReport['created_at'];?></td>
                                                                    <td class="text-center"><?php echo $rowReport['nama_produk'];?></td>
                                                                    <td class="text-center"><?php echo $rowReport['nama_pembeli'];?></td>
                                                                    <td class="text-center"><?php echo number_format($harga);?></td>
                                                                    <td class="text-center"><?php echo $estimasi;?> Hari</td>
                                                                    <td class="text-center"><?php echo $terjual; ?></td>
                                                                    <td class="text-center"><?php echo number_format($total);?></td>
                                                        </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        
                                                </div>
                                                    <div class="col-6">
                                                    <div class="form-group  p-l-20">
                                                            <label for="keterangan" class="keterangan">Total Transaksi</label>
                                                            <h3 class="text-left title-2">Rp. <?php echo number_format($total_transaksi); ?></h3>
                                                    </div>
                                                    </div>
                                                </div>
                                        
                                        <div class="user-data__footer">
                                        <section class="p-t-60 p-b-20">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="copyright">
                                                            <p>Copyright © 2019 Az Solusi Indo. All rights reserved.</p>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <!-- END COPYRIGHT-->
                                        
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
</body>
</html>
<!-- end document-->
<?php 
mysqli_close($conn);
?>