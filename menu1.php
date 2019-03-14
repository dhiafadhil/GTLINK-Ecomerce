<?php $user = $_SESSION['username']; ?>
<?php $email = $_SESSION['email']; ?>
<?php $lvl = $_SESSION['level']?>
<div class="page-wrapper">
<?php 
include "model/config.php";
$querygambar = "SELECT * FROM tbl_profile ORDER BY id_profile";
$datagambar = mysqli_query($conn, $querygambar);
?>
    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="logo">
        <?php while ($rowgambar = mysqli_fetch_array($datagambar)){?>
            <?php if (!empty($rowgambar['logo']) && file_exists('images/'.$rowgambar['logo'])) { ?>
                <img src="images/<?php echo $rowgambar['logo']; ?>" style="height:70px; width:150px;" border="0"> <?php } else { ?>
                <img src="images/no_image.png" width="50px" height="50px" border="0"> <?php } ?></a>
            <?php } ?>
                </div>
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    <li class="">
                        <a href="home.php">
                            <i class="fas fa-home"></i>Dashboard</a>
                    </li>
                    <?php if ($lvl == 1){ ?>
                    <li class="has-sub">
                        <a class="js-arrow" href="#"><i class="fas fa-user"></i>User</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="view/user/tambah_user.php">Add User</a>
                                </li>
                                <li>
                                    <a href="view/user/list_user.php">List User</a>
                                </li>
                                <li>
                                    <a href="view/user/list_approvalUser.php">List Approval User</a>
                                </li>
                            </ul>
                    </li>
                    <?php } ?>
                    <?php if ($lvl == 3){ ?>
                    <li class="has-sub">
                        <a class="js-arrow" href="view/member/list_member.php"><i class="fas fa-user"></i>Member</a>
                    </li>
                    <?php } ?>
                    <?php if ($lvl == 4){ ?>
                    <li class="has-sub">
                        <a class="js-arrow" href="view/member/list_member.php"><i class="fas fa-user"></i>Member</a>
                    </li>
                    <?php } ?>
                    <?php if($lvl < 3) { ?>
                    <li class="has-sub">
                        <a class="js-arrow" href="#"><i class="fa fa-archive"></i>Productivity</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="view/barang/tambah_barang.php">Add Product</a>
                                </li>
                                <li>
                                    <a href="view/barang/list_barang.php">List Product</a>
                                </li>
                                <li>
                                    <a href="view/barang/list_hotel.php">List Hotel</a>
                                </li>
                                <?php if($lvl == 1){ ?>
                                <li>
                                    <a href="view/barang/list_approval.php">List Approval</a>
                                </li>
                                <li>
                                    <a href="view/supplier/list_kategori.php">List Kategori</a>
                                </li>
                                <?php } ?>
                            </ul>
                    </li>
                    <?php } ?>
                    <?php if ($lvl  == 1){ ?>
                    <li class="has-sub">
                            <a class="js-arrow" href="view/profile/list_profile.php"><i class="fa fa-images"></i>Profile</a>
                    </li>
                    <?php } ?>
                    <?php if($lvl == 1){?>
                    <li class="has-sub">
                        <a class="js-arrow" href="view/report/report.php"><i class="fa fa-chart-line"></i>REPORT</a>
                    </li>
                    <?php } ?>
                    <?php if($lvl == 2 ){?>
                    <li class="has-sub">
                        <a class="js-arrow" href="view/reportSupplier/report.php"><i class="fa fa-chart-line"></i>REPORT</a>
                    </li>
                    <?php } ?>
                    <?php if($lvl > 2 AND $lvl != 5){?>
                    <li class="has-sub">
                        <a class="js-arrow" href="view/reportUser/report.php"><i class="fa fa-chart-line"></i>REPORT</a>
                    </li>
                    <?php } ?>
                    <?php if($lvl == 1) { ?>
                    <li class="has-sub">
                        <a class="js-arrow" href="view/barang/list_chart.php"><i class="zmdi zmdi-money-box"></i>Billing</a></a>
                    </li>
                    <?php } ?>
                    <?php if ($lvl > 2){ ?>
                    <li class="has-sub">
                        <a class="js-arrow" href="view/barang/listChart_user.php"><i class="zmdi zmdi-money-box"></i>Billing</a>
                    </li>
                    <?php } ?>
                    <?php if($lvl != 1) { ?>
                    <li class="has-sub">
                        <a class="js-arrow" href="view/informasi/informasi.php"><i class="zmdi zmdi-info"></i>Information</a></a>
                    </li>
                    <?php } ?>
                    <?php if($lvl == 1) { ?>
                        <li class="has-sub">
                        <a class="js-arrow" href="#"><i class="fa fa-bank"></i>Bank </a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a class="js-arrow" href="view/bank/tambah_bank.php">Add Bank</a>
                                </li>
                                <li>
                                    <a class="js-arrow" href="view/bank/list_bank.php">List Bank</a>
                                </li>
                            </ul>
                        </li>
                <?php } ?>
            </nav>
        </div>
    </aside>
    <!-- END MENU SIDEBAR-->
    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="header-wrap">
                        <form class="form-header" action="" method="POST">
                        </form>
                        <div class="header-button ">
                            <div class="account-wrap">
                                <div class="account-item clearfix js-item-menu">
                                    <div class="content">
                                        <a class="js-acc-btn" href="#"><?php echo $user ?></a>
                                    </div>
                                    <div class="account-dropdown js-dropdown">
                                        <div class="info clearfix">
                                            <div class="image">
                                            </div>
                                            <div class="content">
                                                <h5 class="name">
                                                    <a href="#"><?php echo $user ?></a>
                                                </h5>
                                                <span class="email"><?php echo $email;?></span>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__footer">
                                            <a href="model/user/logout.php">
                                                <i class="zmdi zmdi-power"></i>Logout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        