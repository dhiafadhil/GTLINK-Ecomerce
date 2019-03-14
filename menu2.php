<?php $user = $_SESSION['username']; ?>
<?php $email = $_SESSION['email']; ?>
<?php $lvl = $_SESSION['level'];?>
<div class="page-wrapper">
<?php 
include "../model/config.php";
$querygambar = "SELECT * FROM tbl_profile ORDER BY id_profile";
$datagambar = mysqli_query($conn, $querygambar);
?>
    <!-- MENU SIDEBAR-->
    <aside class="menu-sidebar d-none d-lg-block">
        <div class="logo">
        <?php while ($rowgambar = mysqli_fetch_array($datagambar)){?>
            <?php if (!empty($rowgambar['logo']) && file_exists('../images/'.$rowgambar['logo'])) { ?>
                <img src="../images/<?php echo $rowgambar['logo']; ?>" style="height:70px; width:150px;" border="0"> <?php } else { ?>
                <img src="../images/no_image.png" width="50px" height="50px" border="0"> <?php } ?></a>
            <?php } ?>
                </div>
        <div class="menu-sidebar__content js-scrollbar1">
            <nav class="navbar-sidebar">
                <ul class="list-unstyled navbar__list">
                    <li>
                        <a href="../home.php"><i class="fas fa-homer"></i>Dashboard</a>
                    </li>
                    <?php if ($lvl == 1){ ?>
                    <li class="has-sub">
                        <a class="js-arrow" href="#"><i class="fas fa-user"></i>User</a>
                        <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                            <li>
                                <a href="../view/user/tambah_user.php">Add User</a>
                            </li>
                            <li>
                                <a href="../view/user/list_user.php">List User</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    <?php if($lvl < 3) { ?>
                    <li class="has-sub">
                        <a class="js-arrow" href="#"><i class="fa fa-archive"></i>Barang</a>
                            <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                <li>
                                    <a href="../view/barang/tambah_barang.php">Add Barang</a>
                                </li>
                                <li>
                                    <a href="../view/barang/list_barang.php">List Barang</a>
                                </li>
                                <li>
                                    <a href="../view/barang/list_hotel.php">List Hotel</a>
                                </li>
                                <?php if ($lvl == 1){ ?>
                                <li>
                                    <a href="../view/barang/list_approval.php">List Approval</a>
                                </li>
                                <li>
                                    <a href="../view/supplier/list_kategori.php">List Kategori</a>
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <?php } ?>
                        </ul>
                        <?php if ($lvl  == 1){ ?>
                        <li class="has-sub">
                            <a class="js-arrow" href="#"><i class="fa fa-images"></i>Profile</a>
                                <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                    <li>
                                        <a href="../view/profile/list_profile.php">List Profile</a>
                                    </li>
                                </ul>
                            <li class="has-sub">
                                <a class="js-arrow" href="#"><i class="fa fa-images"></i>Profile</a>
                                    <ul class="navbar-mobile-sub__list list-unstyled js-sub-list">
                                        <li>
                                            <a href="../view/profile/list_profile.php">List Profile</a>
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
                        <div class="header-button">
                            <div class="noti-wrap">
                                <div class="noti__item js-item-menu">
                                </div>
                                <div class="noti__item js-item-menu">
                                </div>
                                <div class="noti__item js-item-menu">
                                    <i class="zmdi zmdi-notifications"></i>
                                    <span class="quantity">3</span>
                                    <div class="notifi-dropdown js-dropdown">
                                        <div class="notifi__title">
                                            <p>You have 3 Notifications</p>
                                        </div>
                                        <div class="notifi__item">
                                            <div class="bg-c1 img-cir img-40">
                                                <i class="zmdi zmdi-email-open"></i>
                                            </div>
                                            <div class="content">
                                                <p>You got a email notification</p>
                                                <span class="date">April 12, 2018 06:50</span>
                                            </div>
                                        </div>
                                        <div class="notifi__item">
                                            <div class="bg-c2 img-cir img-40">
                                                <i class="zmdi zmdi-account-box"></i>
                                            </div>
                                            <div class="content">
                                                <p>Your account has been blocked</p>
                                                <span class="date">April 12, 2018 06:50</span>
                                            </div>
                                        </div>
                                        <div class="notifi__item">
                                            <div class="bg-c3 img-cir img-40">
                                                <i class="zmdi zmdi-file-text"></i>
                                            </div>
                                            <div class="content">
                                                <p>You got a new file</p>
                                                <span class="date">April 12, 2018 06:50</span>
                                            </div>
                                        </div>
                                        <div class="notifi__footer">
                                            <a href="#">All notifications</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="account-wrap">
                                <div class="account-item clearfix js-item-menu">
                                    <div class="image">
                                        <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                    </div>
                                    <div class="content">
                                        <a class="js-acc-btn" href="#"><?php echo $user; ?></a>
                                    </div>
                                    <div class="account-dropdown js-dropdown">
                                        <div class="info clearfix">
                                            <div class="image">
                                                <a href="#">
                                                    <img src="images/icon/avatar-01.jpg" alt="John Doe" />
                                                </a>
                                            </div>
                                            <div class="content">
                                                <h5 class="name">
                                                    <a href="#"><?php echo $user; ?></a>
                                                </h5>
                                                <span class="email">j<?php echo $email; ?></span>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__body">
                                            <div class="account-dropdown__item">
                                                <a href="#">
                                                    <i class="zmdi zmdi-account"></i>Account</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                                <a href="#">
                                                    <i class="zmdi zmdi-settings"></i>Setting</a>
                                            </div>
                                            <div class="account-dropdown__item">
                                            <?php if ($lvl == 1){ ?>
                                            <a href="../view/barang/list_chart.php">
                                            
                                            <i class="zmdi zmdi-money-box"></i>Billing</a>
                                            <?php } ?>
                                        </div>
                                            <div class="account-dropdown__item">
                                            <?php if ($lvl  > "2"){ ?>
                                                <a href="../view/barang/listChart_user.php">
                                            
                                                    <i class="zmdi zmdi-money-box"></i>Billing</a>
                                                    <?php } ?>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__footer">
                                            <a href="../model/user/logout.php">
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