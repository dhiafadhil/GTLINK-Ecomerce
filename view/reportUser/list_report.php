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
$levelUser = $_SESSION['level'];
$user = "SELECT * FROM tbl_user WHERE id_child = $id";
$resultUser = mysqli_query($conn,$user);

//date monthid_child = $id
$querymonth = "SELECT created_at FROM tbl_transaksi GROUP BY MONTH(created_at)";
$resultMonth = mysqli_query($conn,$querymonth);

//date year
$queryYear = "SELECT created_at FROM tbl_transaksi GROUP BY YEAR(created_at)";
$resultYear = mysqli_query($conn,$queryYear);

$child ="SELECT * FROM tbl_user WHERE id_child = $id";
$resultChild = mysqli_query($conn,$child);

while($rowChild = mysqli_fetch_array($resultChild)){

    $id_userChild = $rowChild['id_user'];
}

$member = $_POST['user'];
$month = $_POST['month'];
$year = $_POST['year'];


if($levelUser == 3 && !empty($id_userChild)){
//search report
if (isset($member) && isset($month) && isset($year)){

    $queryReport = "SELECT * FROM
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
                child2.nama_user as branchUser,
                child2.username as branchUser_username,
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
        LEFT JOIN tbl_user AS child ON tbl_user.id_child = child.id_user
        LEFT JOIN tbl_user AS child2 ON child.id_child =  child2.id_user
        WHERE tbl_user.username like'%$member%' OR
        child.username like '%$member%' AND
        MONTH(tbl_transaksi.created_at) like '%$month%' AND
        YEAR(tbl_transaksi.created_at) like '%$year%'
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
                            child2.nama_user as branchUser,
                            child2.username as branchUser_username,
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
                LEFT JOIN tbl_user AS child ON tbl_user.id_child = child.id_user
                LEFT JOIN tbl_user AS child2 ON child.id_child =  child2.id_user      
        WHERE tbl_user.username like '%$member%' OR
        child.username like '%$member%' AND
        MONTH(tbl_transaksi.created_at) like'%$month%' AND
        YEAR(tbl_transaksi.created_at) like '%$year%'
        GROUP BY tbl_transaksi.id_transaksi ) AS a WHERE a.id_user = $id OR 
        a.id_child = $id_userChild OR a.id_child = $id AND 
        a.status = 1  GROUP BY a.id_transaksi ORDER BY a.created_at  DESC
        ";
    $resultReport = mysqli_query($conn,$queryReport);

    }
} else if($levelUser == 3 && empty($id_userChild)) {
    if (isset($member) && isset($month) && isset($year)){
    $queryReport = "SELECT * FROM
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
                child2.nama_user as branchUser,
                child2.username as branchUser_username,
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
        LEFT JOIN tbl_user AS child ON tbl_user.id_child = child.id_user
        LEFT JOIN tbl_user AS child2 ON child.id_child =  child2.id_user
        WHERE tbl_user.username like'%$member%' OR
        child.username like '%$member%' AND
        MONTH(tbl_transaksi.created_at) like '%$month%' AND
        YEAR(tbl_transaksi.created_at) like '%$year%'
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
                            child2.nama_user as branchUser,
                            child2.username as branchUser_username,
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
                LEFT JOIN tbl_user AS child ON tbl_user.id_child = child.id_user
                LEFT JOIN tbl_user AS child2 ON child.id_child =  child2.id_user      
        WHERE tbl_user.username like '%$member%' OR
        child.username like '%$member%' AND
        MONTH(tbl_transaksi.created_at) like'%$month%' AND
        YEAR(tbl_transaksi.created_at) like '%$year%'
        GROUP BY tbl_transaksi.id_transaksi ) AS a WHERE a.id_user = $id AND 
        a.status = 1  GROUP BY a.id_transaksi ORDER BY a.created_at  DESC
        ";
    $resultReport = mysqli_query($conn,$queryReport);

}
}

if($levelUser == 4 && !empty($id_userChild)){

    if (isset($member) && isset($month) && isset($year)){

        $queryReport = "SELECT * FROM
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
            LEFT JOIN tbl_user AS child ON tbl_user.id_child = child.id_user
            WHERE tbl_user.username like'%$member%' AND
            MONTH(tbl_transaksi.created_at) like '%$month%' AND
            YEAR(tbl_transaksi.created_at) like '%$year%'
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
                    LEFT JOIN tbl_user AS child ON tbl_user.id_child = child.id_user      
            WHERE tbl_user.username like '%$member%' AND 
            MONTH(tbl_transaksi.created_at) like'%$month%' AND
            YEAR(tbl_transaksi.created_at) like '%$year%'
            GROUP BY tbl_transaksi.id_transaksi) AS a WHERE a.id_user = $id OR $id_userChild AND
        a.status = 1  AND a.id_child != 0 GROUP BY a.id_transaksi ORDER BY a.created_at  DESC
            ";
        $resultReport = mysqli_query($conn,$queryReport);
    

}
}  

if($levelUser == 4 && empty($id_userChild)) {

    if (isset($member) && isset($month) && isset($year)){

        $queryReport = "SELECT * FROM
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
            LEFT JOIN tbl_user AS child ON tbl_user.id_child = child.id_user
            WHERE tbl_user.username like'%$member%' AND
            MONTH(tbl_transaksi.created_at) like '%$month%' AND
            YEAR(tbl_transaksi.created_at) like '%$year%'
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
                    LEFT JOIN tbl_user AS child ON tbl_user.id_child = child.id_user      
            WHERE tbl_user.username like '%$member%' AND 
            MONTH(tbl_transaksi.created_at) like'%$month%' AND
            YEAR(tbl_transaksi.created_at) like '%$year%'
            GROUP BY tbl_transaksi.id_transaksi) AS a WHERE a.id_user = $id AND
        a.status = 1  AND a.id_child != 0 GROUP BY a.id_transaksi ORDER BY a.created_at  DESC
            ";
        $resultReport = mysqli_query($conn,$queryReport);


 }
}


$total_keuntungan = "0";
$total_transaksi = "0";
$keuntunganBranch = "0";
$keuntunganBranch = "0";
$keuntunganAgent = 0;
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
                                <i class="fas fa-chart-line"></i></i>REPORT - <?php echo $member; ?></h3>
                                <form action="list_report.php" method="post">
                                    <div class="table-data__tool-left p-l-20">
                                        <div class="rs-select2--light rs-select2--md">
                                            <select class="js-example-basic-single" name="user" required>
                                                    <option selected="selected" value=''>Member</option>
                                                    <?php while ($rowUser = mysqli_fetch_array($resultUser)){?>
                                                    <option  value="<?php echo $rowUser['username'];?>">
                                                    <?php echo $rowUser['nama_user'];?></option>
                                            <?php } ?>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                            </div>
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
                                                        <?php if($levelUser == 3){?>
                                                        <th class="text-center">GT Branch</th>
                                                        <?php } ?>
                                                        <th class="text-center">GT Agent </th>
                                                        <th class="text-center">GT User </th>
                                                        <th class="text-center">Transaksi</th>
                                                        <?php if($levelUser == 3){?>
                                                        <th class="text-center">Komisi Branch</th>
                                                        <?php } ?>
                                                        <th class="text-center">Komisi Agent</th>
                                                    </tr>
                                                    </thead>
                                                    <?php while ($rowReport = mysqli_fetch_array($resultReport)){?>
                                                    <tbody>
                                                                <?php
                                                                    $keuntungan = 0;
                                                                    
                                                                    $level = $rowReport['level'];
                                                                    $total_transaksi += $rowReport['total_bayar'];
                                                                    $komisiBranch = $rowReport['komisi1'] * $rowReport['pcs']; 
                                                                    $komisiAgent = $rowReport['komisi2'] * $rowReport['pcs'];
                                                                    $keuntunganBranch += $rowReport['komisi1'] * $rowReport['pcs'];
                                                                    $keuntunganAgent += $rowReport['komisi2'] * $rowReport['pcs'];
                                                                ?>
                                                            <tr> 
                                                                    <td class="text-center"><?php echo $rowReport['created_at'];?></td>
                                                                    <td class="text-center"><?php echo $rowReport['nama_produk'];?></td>
                                                                    <?php if($levelUser == 3){ ?>
                                                                    <td class="text-center"><?php 
                                                                    if($level == 3){echo $rowReport['nama_user'];
                                                                    } else if($level == 4){ echo $rowReport['agentUser']; }
                                                                    else { echo $rowReport['branchUser'];}?></td>
                                                                    <?php } ?>
                                                                    <td class="text-center"><?php 
                                                                    if($level == 4){echo $rowReport['nama_user'];
                                                                    } else if($level == 5) { echo $rowReport['agentUser']; }
                                                                    else { echo "-";}?></td>
                                                                    <td class="text-center">
                                                                    <?php if($level == 5){
                                                                    echo $rowReport['nama_user'];}
                                                                    else { echo "-";}?></td>
                                                                    <td class="text-center">
                                                                    <?php echo number_format($rowReport['total_bayar']);?></td>
                                                                    <?php if($levelUser == 3){?>
                                                                    <td class="text-center">
                                                                    <?php if($rowReport['level'] == 4){
                                                                        echo number_format($komisiBranch);
                                                                    } else { echo number_format($komisiBranch);} ?>
                                                                    </td>
                                                                    <?php } ?>
                                                                    <td class="text-center">
                                                                    <?php if($rowReport['level'] == 4){
                                                                        echo number_format($komisiAgent);
                                                                    } else if($level == 5) { echo number_format($komisiAgent);}
                                                                    else { echo "Tidak Ada Komisi";} ?>
                                                                    </td>
                                                        </tr>
                                                        <?php
                                                            }
                                                        ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="row">
                                                    <div class="col-4">
                                                        <div class="form-group  p-l-20">
                                                            <label for="keterangan" class="keterangan">Total Transaksi</label>
                                                            <h3 class="text-left title-2">Rp. <?php echo number_format($total_transaksi); ?></h3>
                                                    </div>
                                                </div>
                                                    <div class="col-4">
                                                    <?php if ($levelUser == 3){?>
                                                        <div class="form-group">
                                                            <label for="total_invoice" class="total_invoice">Total Komisi Branch
                                                                </label>
                                                                <h3 class="text-left title-2">RP. <?php echo number_format($keuntunganBranch); ?></h3>
                                                        </div>
                                                    <?php } ?>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label for="total_invoice" class="total_invoice">Total Komisi Agent
                                                                </label>
                                                                <h3 class="text-left title-2">RP. <?php echo number_format($keuntunganAgent); ?></h3>
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