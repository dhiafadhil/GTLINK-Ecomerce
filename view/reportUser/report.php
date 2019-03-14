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
$id = $_SESSION['id_user'];
$levelUser = $_SESSION['level'];

$child ="SELECT * FROM tbl_user WHERE id_child = $id";
$resultChild = mysqli_query($conn,$child);

while($rowChild = mysqli_fetch_array($resultChild)){

    $id_userChild = $rowChild['id_user'];
}

$total_keuntungan = 0;
$jumlah_member = 0;
$keuntungan = 0;

$tanggal = date('M');

if($levelUser == 3 && !empty($id_userChild)){
//report admin
    $query = "SELECT * FROM
    (SELECT  tbl_detailTransaksi.id_barang,
                tbl_detailTransaksi.pcs,
                tbl_transaksi.created_at,
                tbl_hotel.nama_hotel as nama_produk,
                tbl_user.id_user,
                tbl_user.id_child,
                tbl_user.nama_user,
                tbl_user.level,
                tbl_user.username,
                child.nama_user as agentUser,
                child.username as agentUser_username,
                tbl_transaksi.id_transaksi,
                tbl_transaksi.total_bayar,
                tbl_transaksi.status,
                tbl_komisi.principal,
                tbl_komisi.komisi1,
        CASE WHEN child.nama_user IS NULL 
        THEN NULL
        ELSE tbl_komisi.komisi2
    END AS komisi2
    FROM `tbl_detailTransaksi`
        INNER JOIN tbl_room ON tbl_room.id_room = tbl_detailTransaksi.id_barang
        INNER JOIN tbl_hotel ON tbl_hotel.id_hotel = tbl_room.id_hotel
        INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = tbl_detailTransaksi.id_transaksi
        INNER JOIN tbl_user ON tbl_user.id_user = tbl_transaksi.id_user
        INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_hotel.id_hotel
        LEFT JOIN tbl_user AS child ON tbl_user.id_user = child.id_child
        GROUP BY tbl_transaksi.id_transaksi
    UNION ALL
    SELECT  detail.id_barang,
                            detail.pcs,
                            tbl_transaksi.created_at,
                            tbl_barang.nama_barang,
                            tbl_user.id_user,
                            tbl_user.id_child,
                            tbl_user.nama_user,
                            tbl_user.level,
                            tbl_user.username,
                            child.nama_user as agentUser,
                            child.username as agentUser_username,
                            tbl_transaksi.id_transaksi,
                            tbl_transaksi.total_bayar,
                            tbl_transaksi.status,
                            tbl_komisi.principal,
                            tbl_komisi.komisi1,              
                CASE WHEN child.nama_user IS NULL 
                THEN NULL
                ELSE tbl_komisi.komisi2
            END AS komisi2
            FROM `tbl_detailTransaksi` as detail
                INNER JOIN tbl_barang on tbl_barang.id_barang = detail.id_barang
                INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = detail.id_transaksi
                INNER JOIN tbl_user ON tbl_user.id_user = tbl_transaksi.id_user
                INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_barang.id_barang
                LEFT JOIN tbl_user AS child ON tbl_user.id_user = child.id_child     
        GROUP BY tbl_transaksi.id_transaksi ) AS a WHERE a.id_user = $id OR 
        a.id_child = $id_userChild OR a.id_child = $id AND 
        a.status = 1  GROUP BY a.id_transaksi ORDER BY a.created_at  DESC";

$result = mysqli_query($conn,$query);

while($row = mysqli_fetch_array($result))
{
    
    $keuntungan += $row['komisi1'] * $row['pcs'];

}

} else if($levelUser == 3 && empty($id_userChild)){

    $query = "SELECT * FROM
    (SELECT  tbl_detailTransaksi.id_barang,
                tbl_detailTransaksi.pcs,
                tbl_transaksi.created_at,
                tbl_hotel.nama_hotel as nama_produk,
                tbl_user.id_user,
                tbl_user.id_child,
                tbl_user.nama_user,
                tbl_user.level,
                tbl_user.username,
                child.nama_user as agentUser,
                child.username as agentUser_username,
                tbl_transaksi.id_transaksi,
                tbl_transaksi.total_bayar,
                tbl_transaksi.status,
                tbl_komisi.principal,
                tbl_komisi.komisi1,
        CASE WHEN child.nama_user IS NULL 
        THEN NULL
        ELSE tbl_komisi.komisi2
    END AS komisi2
    FROM `tbl_detailTransaksi`
        INNER JOIN tbl_room ON tbl_room.id_room = tbl_detailTransaksi.id_barang
        INNER JOIN tbl_hotel ON tbl_hotel.id_hotel = tbl_room.id_hotel
        INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = tbl_detailTransaksi.id_transaksi
        INNER JOIN tbl_user ON tbl_user.id_user = tbl_transaksi.id_user
        INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_hotel.id_hotel
        LEFT JOIN tbl_user AS child ON tbl_user.id_user = child.id_child
        GROUP BY tbl_transaksi.id_transaksi
    UNION ALL
    SELECT  detail.id_barang,
                            detail.pcs,
                            tbl_transaksi.created_at,
                            tbl_barang.nama_barang,
                            tbl_user.id_user,
                            tbl_user.id_child,
                            tbl_user.nama_user,
                            tbl_user.level,
                            tbl_user.username,
                            child.nama_user as agentUser,
                            child.username as agentUser_username,
                            tbl_transaksi.id_transaksi,
                            tbl_transaksi.total_bayar,
                            tbl_transaksi.status,
                            tbl_komisi.principal,
                            tbl_komisi.komisi1,              
                CASE WHEN child.nama_user IS NULL 
                THEN NULL
                ELSE tbl_komisi.komisi2
            END AS komisi2
            FROM `tbl_detailTransaksi` as detail
                INNER JOIN tbl_barang on tbl_barang.id_barang = detail.id_barang
                INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = detail.id_transaksi
                INNER JOIN tbl_user ON tbl_user.id_user = tbl_transaksi.id_user
                INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_barang.id_barang
                LEFT JOIN tbl_user AS child ON tbl_user.id_user = child.id_child     
        GROUP BY tbl_transaksi.id_transaksi ) AS a WHERE a.id_user = $id AND 
        a.status = 1  GROUP BY a.id_transaksi ORDER BY a.created_at  DESC";

$result = mysqli_query($conn,$query);

while($row = mysqli_fetch_array($result))
{
    
    $keuntungan += $row['komisi1'] * $row['pcs'];

}

}


if($levelUser == 4 && !empty($id_userChild)){
    //report admin
        $query = "SELECT * FROM
        (SELECT  tbl_detailTransaksi.id_barang,
                    tbl_detailTransaksi.pcs,
                    tbl_transaksi.created_at,
                    tbl_hotel.nama_hotel as nama_produk,
                    tbl_user.id_user,
                    tbl_user.id_child,
                    tbl_user.nama_user,
                    tbl_user.level,
                    tbl_user.username,
                    child.nama_user as agentUser,
                    child.username as agentUser_username,
                    tbl_transaksi.id_transaksi,
                    tbl_transaksi.total_bayar,
                    tbl_transaksi.status,
                    tbl_komisi.principal,
                    tbl_komisi.komisi1,
                    tbl_komisi.komisi2
        FROM `tbl_detailTransaksi`
            INNER JOIN tbl_room ON tbl_room.id_room = tbl_detailTransaksi.id_barang
            INNER JOIN tbl_hotel ON tbl_hotel.id_hotel = tbl_room.id_hotel
            INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = tbl_detailTransaksi.id_transaksi
            INNER JOIN tbl_user ON tbl_user.id_user = tbl_transaksi.id_user
            INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_hotel.id_hotel
            LEFT JOIN tbl_user AS child ON tbl_user.id_user = child.id_child
            GROUP BY tbl_transaksi.id_transaksi
        UNION ALL
        SELECT  detail.id_barang,
                                detail.pcs,
                                tbl_transaksi.created_at,
                                tbl_barang.nama_barang,
                                tbl_user.id_user,
                                tbl_user.id_child,
                                tbl_user.nama_user,
                                tbl_user.level,
                                tbl_user.username,
                                child.nama_user as agentUser,
                                child.username as agentUser_username,
                                tbl_transaksi.id_transaksi,
                                tbl_transaksi.total_bayar,
                                tbl_transaksi.status,
                                tbl_komisi.principal,
                                tbl_komisi.komisi1,              
                                tbl_komisi.komisi2
                FROM `tbl_detailTransaksi` as detail
                    INNER JOIN tbl_barang on tbl_barang.id_barang = detail.id_barang
                    INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = detail.id_transaksi
                    INNER JOIN tbl_user ON tbl_user.id_user = tbl_transaksi.id_user
                    INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_barang.id_barang
                    LEFT JOIN tbl_user AS child ON tbl_user.id_user = child.id_child     
            GROUP BY tbl_transaksi.id_transaksi )  AS a WHERE  a.id_user = $id OR $id_userChild AND
        a.status = 1 AND a.id_child != 0 GROUP BY a.id_transaksi  ORDER BY a.created_at DESC";
    
    $result = mysqli_query($conn,$query);
    
    while($row = mysqli_fetch_array($result))
    {
        
        $keuntungan += $row['komisi2'] * $row['pcs'];

    }
    
}

if($levelUser == 4 && empty($id_userChild)) {

    $query = "SELECT * FROM
    (SELECT  tbl_detailTransaksi.id_barang,
                tbl_detailTransaksi.pcs,
                tbl_transaksi.created_at,
                tbl_hotel.nama_hotel as nama_produk,
                tbl_user.id_user,
                tbl_user.id_child,
                tbl_user.nama_user,
                tbl_user.level,
                tbl_user.username,
                child.nama_user as agentUser,
                child.username as agentUser_username,
                tbl_transaksi.id_transaksi,
                tbl_transaksi.total_bayar,
                tbl_transaksi.status,
                tbl_komisi.principal,
                tbl_komisi.komisi1,
                tbl_komisi.komisi2
    FROM `tbl_detailTransaksi`
        INNER JOIN tbl_room ON tbl_room.id_room = tbl_detailTransaksi.id_barang
        INNER JOIN tbl_hotel ON tbl_hotel.id_hotel = tbl_room.id_hotel
        INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = tbl_detailTransaksi.id_transaksi
        INNER JOIN tbl_user ON tbl_user.id_user = tbl_transaksi.id_user
        INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_hotel.id_hotel
        LEFT JOIN tbl_user AS child ON tbl_user.id_user = child.id_child
        GROUP BY tbl_transaksi.id_transaksi
    UNION ALL
    SELECT  detail.id_barang,
                            detail.pcs,
                            tbl_transaksi.created_at,
                            tbl_barang.nama_barang,
                            tbl_user.id_user,
                            tbl_user.id_child,
                            tbl_user.nama_user,
                            tbl_user.level,
                            tbl_user.username,
                            child.nama_user as agentUser,
                            child.username as agentUser_username,
                            tbl_transaksi.id_transaksi,
                            tbl_transaksi.total_bayar,
                            tbl_transaksi.status,
                            tbl_komisi.principal,
                            tbl_komisi.komisi1,              
                            tbl_komisi.komisi2
            FROM `tbl_detailTransaksi` as detail
                INNER JOIN tbl_barang on tbl_barang.id_barang = detail.id_barang
                INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = detail.id_transaksi
                INNER JOIN tbl_user ON tbl_user.id_user = tbl_transaksi.id_user
                INNER JOIN tbl_komisi ON tbl_komisi.id_barang = tbl_barang.id_barang
                LEFT JOIN tbl_user AS child ON tbl_user.id_user = child.id_child     
        GROUP BY tbl_transaksi.id_transaksi )  AS a WHERE  a.id_user = $id  AND
        a.status = 1 GROUP BY a.id_transaksi  ORDER BY a.created_at DESC";

$result = mysqli_query($conn,$query);

while($row = mysqli_fetch_array($result))
{
    
    $keuntungan += $row['komisi2'] * $row['pcs'];

}

}

//member while
$user = "SELECT * FROM tbl_user  WHERE id_child = $id";
$resultUser = mysqli_query($conn,$user);

//date month
$month = "SELECT created_at FROM tbl_transaksi GROUP BY MONTH(created_at)";
$resultMonth = mysqli_query($conn,$month);

//date year
$year = "SELECT created_at FROM tbl_transaksi GROUP BY YEAR(created_at)";
$resultyear = mysqli_query($conn,$year);

//date year
$queryYear = "SELECT created_at FROM tbl_transaksi GROUP BY YEAR(created_at)";
$resultYear = mysqli_query($conn,$queryYear);


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
                                        <div class="rs-select2--light rs-select2--md">
                                            <select class="js-example-basic-single" name="user" required>
                                                    <option selected="selected" value="">Member</option>
                                                    <?php while ($rowUser = mysqli_fetch_array($resultUser)){
                                                        $data_member[] = $rowUser['id_user'];
                                                        $jumlah_member = count($data_member);?>
                                                    <option  value="<?php echo $rowUser['username'];?>">
                                                    <?php echo $rowUser['nama_user'];?></option>
                                            <?php } ?>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                            </div>
                                            <div class="rs-select2--light rs-select2--sm">
                                                <select class="js-select2" name="month">
                                                    <option selected="selected" value="">Month</option>
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
                                        </div>
                                        <section class="statistic2 ">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="statistic__item statistic__item--blue">
                                                            <span class="desc">Member</span>
                                                                <h2 class="number"><?php echo $jumlah_member; ?></h2>
                                                            <div class="icon">
                                                                <i class="zmdi zmdi-account-o"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="statistic__item statistic__item--green">
                                                            <span class="desc">total commision</span>
                                                                <h2 class="number text-white">Rp.<?php  echo number_format($keuntungan);?></h2>
                                                            <div class="icon">
                                                                <i class="zmdi zmdi-money"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <div class="user-data__footer">
                                            <button id="search" class="au-btn au-btn-load" type="submit">Search</button>
                                        </div>
                                        </form>
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
                                        </section>
                                        <!-- END COPYRIGHT-->
                                        </div>
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
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

</body>
</html>
<!-- end document-->
<?php 
mysqli_close($conn);
?>