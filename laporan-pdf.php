<?php
require_once __DIR__ . '/Mpdf/autoload.php';


@$mpdf = new Mpdf\Mpdf(); // Create new mPDF Document
ob_start(); 
?>
<!DOCTYPE html>
<html>
<head>
<title>Printout</title>
<style>
    *
    {
        margin:0;
        padding:0;
        font-family: calibri;
        font-size:10pt;
        color:#000;
    }
    body
    {
        width:100%;
        font-family: calibri;
        font-size:8pt;
        margin:0;
        padding:0;
    }
        
    p
    {
        margin:0;
        padding:0;
        margin-left: 200px;
    }
        
    #wrapper
    {
        width:200mm;
        margin:0 5mm;
    }
        
    .page
    {
        height:297mm;
        width:210mm;
        page-break-after:always;
    }
    table
    {
        border-left: 1px solid #fff;
        border-top: 1px solid #fff;
        font-family: calibri; 
        border-spacing:0;
        border-collapse: collapse; 
            
    }
        
    table td 
    {
        border-right: 1px solid #fff;
        border-bottom: 1px solid #fff;
        padding: 2mm;
        
    }
        
    table.heading
    {
        height:50mm;
    }
        
    h1.heading
    {
        font-size:12pt;
        color:#000;
        font-weight:normal;
        font-style: italic;

    }
        
    h2.heading
    {
        font-size:10pt;
        color:#000;
        font-weight:normal;
    }

    hr
    {
        color:#000;
        background:#ccc;
    }
        
    #invoice_body
    {
        height: auto;
        font-size:12px;
    }
        
    #invoice_body , #invoice_total
    {   
        width:100%;
        
    }
    #invoice_body table , #invoice_total table
    {
        width:100%;
        /*border-left: 1px solid #ccc;
        border-top: 1px solid #ccc;*/
    
        border-spacing:0;
        border-collapse: collapse; 

            
        margin-top:5mm;
    }
        
    #invoice_body table td , #invoice_total table td
    {
        text-align:center;
        font-size:11pt;
        /*border-right: 1px solid black;
        border-bottom: 1px solid black;*/
        padding:2mm 0;
        border:0px;
    }
        
    #invoice_body table td.mono  , #invoice_total table td.mono
    {
        text-align:center;
        padding-right:3mm;
        font-size:11pt;
        
    }
        
    #footer
    {   
        width:200mm;
        margin:0 5mm;
        padding-bottom:3mm;
    }
    #footer table
    {
        width:100%;
        border-left: 1px solid #ccc;
        border-top: 1px solid #ccc;
            
        background:#eee;
            
        border-spacing:0;
        border-collapse: collapse; 
    }
    #footer table td
    {
        width:25%;
        text-align:center;
        font-size:9pt;
        border-right: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
    }
</style>
</head>
<body>
<div id="wrapper">
    <?php
    include "model/config.php";
    ?>
    
<?php
    $query = "SELECT logo,nama_profile FROM tbl_profile ORDER BY id_profile";
    $dataprofile = mysqli_query($conn, $query);
?>

<?php while ($rowprofile = mysqli_fetch_array($dataprofile)){?>
<table class="heading" style="width:100%;">
    <tr>
        <td width="10" algn="left">
            <h1><?php echo $rowprofile['nama_profile']; ?></h1>
        </td>
        <br>
        <?php if (!empty($rowprofile['logo']) && file_exists('../../images/'.$rowprofile['logo'])) { ?>
                <img src="../../images/<?php echo $rowprofile['logo']; ?>" width="300px" height="100px" border="0"> <?php } else { ?>
            <img src="../../images/no_image.png" width="50px" height="50px" border="0"/> <?php } ?> </td>
    </tr>
</table>
<?php } ?> 
<hr>
    <div id="invoice_body">
    <!--    untuk mengambil no invoice dari tabel transaksi -->
        <?php
            $id_transaksi = $_POST['id_transaksi'];
            $queryno_invoice = "SELECT no_invoice FROM tbl_transaksi WHERE id_transaksi = $id_transaksi";
            $datainvoice = mysqli_query($conn, $queryno_invoice);
        ?>
            <?php while ($rowinvoice = mysqli_fetch_array($datainvoice)) {
            $invoice = $rowinvoice['no_invoice'];
            ?>
        <table width="10">
            <tr>
                    <td align="left"><h2>No Booking <br>
                    <?php echo $rowinvoice['no_invoice']; ?></h2></td>
            
            </tr>
            </table>
        <?php
            }
        ?>
            <!-- untuk memunculkan nama user, email, alamat, dari tbl_user di iner joinkan dengan tbl_transaksi -->
            <h2>Berikut adalah data lengkap Anda : </h2>
        <table border="0">
            <tr>
                <td align="left" width="150"><span style="font-size: 15px;"><label>Nama Lengkap </label></span></td>
                <td align="left" width="10"> : </td>
                <td align="left"><?php echo $nama_pemesan;?></td>
            </tr>
            <tr>
                <td align="left" width="150"><span style="font-size: 15px;"><label>No telp </label></span></td>
                <td align="left" width="10"> : </td>
                <td align="left"><?php echo $no_telp;?></td>
            </tr>
            
        </table>
        <h2>Produk Yang Anda Booking : </h2>
        
            <?php
                $id_transaksi = $_POST['id_transaksi'];
                // echo $id_transaksi;
                $querytabeldata = "SELECT nama_barang,b.kategori,b.harga,b.pcs,total_bayar,b.start_tanggal,b.end_tanggal FROM tbl_detailTransaksi As b 
                INNER JOIN tbl_transaksi ON b.id_transaksi = tbl_transaksi.id_transaksi 
                INNER JOIN tbl_barang ON tbl_barang.id_barang = b.id_barang 
                WHERE tbl_transaksi.id_transaksi= $id_transaksi";
                $tabeldata = mysqli_query($conn, $querytabeldata);
                    // var_dump($querytabeldata);exit();
            ?>
                    <?php if($tabeldata == TRUE){ ?>
                    <?php while ($row3 = mysqli_fetch_array($tabeldata)) {  
                        $kategori = $row3[1];
                        if($kategori != "Hotel") {  
                        ?>
                        <table border="0">
                            <thead>
                                <tr>
                                    <th width="20%"><span style="font-size: 18px;">Product</span></th>
                                    <th width="20%"><span style="font-size: 18px;">Jumlah</span></th>
                                    <th width="30%"><span style="font-size: 18px;">Tanggal Booking</span></th>
                                    <th width="20%"><span style="font-size: 18px;">Harga</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr border="0">
                                    <td>
                                        <span style="font-size: 17px;"><?php echo $row3['nama_barang'];?></span>
                                    </td>
                                    <td>
                                        <span style="font-size: 17px;"><?php echo $row3['pcs'];?></span></td>
                                    <td>
                                        <span style="font-size: 17px;"><?php echo $row3['start_tanggal'] ." - ". $row3['end_tanggal'];?></span>
                                    </td>
                                    <td>
                                        <span style="font-size: 17px;"><?php echo number_format($row3['harga'])?></span>
                                    </td>
                                </tr>
                                
                                <tr classs="spacer">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                
                                <tr class="total">
                                    <td></td><td></td>
                                        <td style="font-size: 20px;" align="right"> 
                                            Total :
                                            
                                        <td width="30%">
                                            <span style="font-size: 20px;">
                                                <b>
                                                    <?php echo "Rp ". number_format($row3['total_bayar'])?>
                                                </b>
                                            </span>
                                        </td>
                                    </td>    
                                </tr>
                            </tbody>
                        </table>   
                        <?php } ?> 
                <?php } ?>   
            <?php } ?>
            <?php
                $id_transaksi = $_POST['id_transaksi'];
                $querytabelhotel = "SELECT
                                tbl_hotel.nama_hotel,
                                tbl_room.tipe_room,
                                tbl_room.tipe_bed,
                                d.kategori,
                                d.harga,
                                d.pcs,
                                tbl_transaksi.total_bayar,
                                d.start_tanggal,
                                d.end_tanggal 
                            FROM tbl_detailTransaksi As d 
                            INNER JOIN tbl_transaksi ON tbl_transaksi.id_transaksi = d.id_transaksi 
                            INNER JOIN tbl_room ON tbl_room.id_room = d.id_barang 
                            INNER JOIN tbl_hotel ON tbl_hotel.id_hotel = tbl_room.id_hotel
                            WHERE d.id_transaksi = $id_transaksi";
                $datahotel = mysqli_query($conn, $querytabelhotel);
            ?>
            <?php while ($rowhotel = mysqli_fetch_array($datahotel)) { 
                    
                    $kategori1 = $rowhotel[3];
                    
                    if($kategori1 == "Hotel") {  
            ?>
                        <table border="0">
                            <thead>
                            <tr class="">
                                <th width="25%"><span style="font-size: 18px;">Nama Hotel</span></th>
                                <th width="15%"><span style="font-size: 18px;">Tipe Room</span></th>
                                <th width="15%"><span style="font-size: 18px;">Tipe Bed</span></th>
                                <th width="10%"><span style="font-size: 18px;">Jumlah</span></th>
                                <th width="30%"><span style="font-size: 18px;">Tanggal Booking</span></th>
                                <th width="20%"><span style="font-size: 18px;">Harga</span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr border="0">
                                <td>
                                    <span style="font-size: 17px;"><?php echo $rowhotel['nama_hotel'];?></span>
                                </td>
                                <td>
                                    <span style="font-size: 17px;"><?php echo $rowhotel['tipe_room'];?></span>
                                </td>
                                <td>
                                    <span style="font-size: 17px;"><?php echo $rowhotel['tipe_bed'];?></span>
                                </td>
                                <td>
                                    <span style="font-size: 17px;"><?php echo $rowhotel['pcs'];?></span>
                                </td>
                                <td>
                                    <span style="font-size: 17px;"><?php echo $rowhotel['start_tanggal'] ." - ". $rowhotel['end_tanggal'];?></span>
                                </td>
                                <td>
                                        <span style="font-size: 17px;"><?php echo  number_format($rowhotel['harga'])?>
                                        </span>
                                    </td>
                            </tr>
                            <tr classs="spacer">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            
                            <tr class="total">
                                <td></td><td></td><td></td><td></td>
                                    <td style="font-size: 20px;" align="right"> 
                                        Total :
                                        
                                    <td width="30%">
                                        <span style="font-size: 20px;">
                                            <b>
                                                <?php echo "Rp ". number_format($rowhotel['total_bayar'])?>
                                            </b>
                                        </span>
                                    </td>
                                </td>    
                            </tr>
                            </tbody>
                        </table>   
                <?php } ?>
            <?php } ?>
        <hr>
        
        <table>
            <tr>
                <td align="right">Jakarta.<?php date_default_timezone_set('Asia/Jakarta');
                    echo date(' l, d-M-Y'); ?><br>
                <br>
            <h3><p>TERIMA KASIH</p></h3></td>
            </tr>
        </table>
    </div>
    <div id="invoice_total">
        
</div>
    
    <?php
$title = $invoice;
$html = ob_get_contents(); //Proses untuk mengambil data
ob_end_clean();

$mpdf->SetTitle("Invoice GT-LINK");

$mpdf->WriteHTML($html);
$mpdf->Output("../../pdf/".$title.".pdf",\Mpdf\Output\Destination::FILE);

include "email2.php";

unlink("../../pdf/".$title.".pdf");

?>

</body>
</html>
