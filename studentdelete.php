<html>
<head> 
<title>STUDENT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
   a:link, a:visited {color: black;}
</style>
</head>
<body>
<script>
    function alert(){
        var sid = document.forms["form"]["sid"].value;
        var fname = document.forms["form"]["fname"].value;
        var lname = document.forms["form"]["lname"].value;
        var birthplace = document.forms["form"]["birthplace"].value;
        var birthdate = document.forms["form"]["birthdate"].value;
        if(sid==null || x==""){
            alert("LÜTFEN BU ALANI DOLDURUN!");
            return false;
        }   
    }
</script>
<?php 
error_reporting(E_ERROR | E_PARSE);
switch (@ $_GET['is']) {
    case 'ogrencisil': ogrencisil($_GET['sid']);
          anasayfa();
          break;
    case 'ogrencieklemeformu':ogrencieklemeformu($sid=null);
          break;   
    case 'ogrenciekle':ogrenciekle($_GET['sid'],$_GET['fname'],$_GET['lname'],$_GET['birthplace'],$_GET['birthdate']);
          anasayfa();
          break;
    case 'ogrenciguncelleformu':ogrencieklemeformu($_GET['sid']); 
          break;
    case 'ogrenciguncelle': ogrenciguncelle ($_GET['sid'],$_GET['fname'],$_GET['lname'],$_GET['birthplace'],$_GET['birthdate']);
          anasayfa();
          break;
    default:
          anasayfa();
          break;
}exit;
function anasayfa(){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje2');
    
    if (isset($_GET['page_no']) && $_GET['page_no']!=""){ //geçerli sayfa numarasını almak için
        $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
    }

    $order="asc";
    if(@$_GET['orderby']=="sid" && @$_GET['order']=="asc")
    {
     $order="desc";
    }
    if(@$_GET['orderby']=="fname" && @$_GET['order']=="asc")
    {
     $order="desc";
    }
    if(@$_GET['orderby']=="lname" && @$_GET['order']=="asc")
    {
     $order="desc";
    }
    if(@$_GET['orderby']=="birthplace" && @$_GET['order']=="asc")
    {
     $order="desc";
    }
    if(@$_GET['orderby']=="birthdate" && @$_GET['order']=="asc")
    {
     $order="desc";
    }
    if(@$_GET['orderby'])
    {
     $orderby="order by ".$_GET['orderby'];
    }
    if(@$_GET['order'])
    {
    $sort_order=$_GET['order'];
    }
         
    $total_records_per_page = 4;//her sayfada kaç tane kayıt olsun
    $offset = ($page_no-1) * $total_records_per_page;
    $previous_page = $page_no - 1; //önceki sayfayı tutar
    $next_page = $page_no + 1; //sonraki sayfayı tutar
    $adjacents = "2";

    $result_count=mysqli_query($baglanti, "SELECT count(*) as total_records FROM student"); //veri tabanındaki kayıtların sayısı bulunur..
    $total_records = mysqli_fetch_array($result_count);
    $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page); //yuvarlama(ceil) yaparak sayfa sayısını hesaplar 
    $second_last = $total_no_of_pages - 1; // total pages minus 1
    
    $kayitKumesi = mysqli_query($baglanti, "SELECT * FROM student  ".$orderby." ".$sort_order." limit $offset, $total_records_per_page ");
    echo "<div align='center' class='container'>
    <h1>ÖĞRENCİLER</h1>
    <table  class='table table-hover'>
    <thead><tr>
    <th><a href='?orderby=sid&order=".$order."' href='?page_no=$page_no' >ID</a></th>
    <th><a href='?orderby=fname&order=".$order."' href='?page_no=$page_no' >AD</a></th>
    <th><a href='?orderby=lname&order=".$order."' href='?page_no=$page_no'  >SOYAD</a></th>
    <th><a href='?orderby=birthplace&order=".$order."' href='?page_no=$page_no' >DOĞUM YERİ</a></th>
    <th><a href='?orderby=birthdate&order=".$order."' href='?page_no=$page_no'>DOĞUM TARIHI</a></th>
    <th>SIL</th>
    <th>GUNCELLE</th>  
    </tr></thead>
    ";
    
    while($satir = mysqli_fetch_assoc($kayitKumesi)){
    print  "<tr> 
			<td>".$satir['sid']."</td> 
			<td>{$satir['fname']}</td> 
			<td>{$satir['lname']}</td> 
			<td>{$satir['birthplace']}</td>
			<td>{$satir['birthdate']}</td>
			<td><button type='button' class='btn btn-danger'><a  href='?is=ogrencisil&sid={$satir['sid']}'>OGRENCI SIL</a></button></td>
            <td><button type='button'  class='btn btn-info'><a href='?is=ogrenciguncelleformu&sid={$satir['sid']}&fname={$satir['fname']}&lname={$satir['lname']}&birthplace={$satir['birthplace']}&birthdate={$satir['birthdate']}'>GUNCELLE</a></button></td>
			</tr>";
    } print "</tbody></table><a href='?is=ogrencieklemeformu' style='color=white'><button type='button'  class='btn btn-success'</button>>OGRENCI EKLE </a></div>";
   
    mysqli_close($baglanti);

    echo "<div align='center' class='container'> <ul class='pagination'>";
    if($page_no>1){ echo "<li><a href='?page_no=1'>ILK SAYFA</a></li>";}
    if($page_no <= 1){ echo "<li class='disabled'> <a href='?page_no=$previous_page'> ONCEKİ SAYFA</a></li>";}
    if($page_no > 1){echo "<li > <a href='?page_no=$previous_page'> ONCEKI SAYFA</a></li>";}
 
    if($page_no <= 2) {			
        for ($counter = 1; $counter < $total_no_of_pages-2; $counter++){		 
        if ($counter == $page_no) {
            echo "<li class='active'><a>$counter</a></li>";	
        }else{
            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
    }
    }
            echo "<li><a>...</a></li>";
            echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
            echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
    }else if($page_no > 2 && $page_no < $total_no_of_pages - 4) {		 
            echo "<li><a href='?page_no=1'>1</a></li>";
            echo "<li><a href='?page_no=2'>2</a></li>";
            echo "<li><a>...</a></li>";
        for ($counter = $page_no - $adjacents;$counter <= $page_no + $adjacents;$counter++){		
        if ($counter == $page_no) {
            echo "<li class='active'><a>$counter</a></li>";	
    }else{
            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
    }                  
    }
            echo "<li><a>...</a></li>";
            echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
            echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
    }else {
            echo "<li><a href='?page_no=1'>1</a></li>";
            echo "<li><a href='?page_no=2'>2</a></li>";
            echo "<li><a>...</a></li>";
    for ($counter = $total_no_of_pages - 3; $counter <= $total_no_of_pages; $counter++) {
    if ($counter == $page_no) {
            echo "<li class='active'><a>$counter</a></li>";	
    }else{
            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
    }                   
    }
    }
    if($page_no >= $total_no_of_pages){echo "<li class='disabled'><a href='?page_no=$next_page'> SONRAKI SAYFA</a></li>";}
    if($page_no < $total_no_of_pages) {echo "<li ><a href='?page_no=$next_page'> SONRAKI SAYFA</a></li>";} 
    if($page_no < $total_no_of_pages){ echo "<li><a href='?page_no=$total_no_of_pages'>SON SAYFA &rsaquo;&rsaquo;</a></li>";}
    print "</div></ul>";


}
function ogrencisil($sid){
    $sql = "DELETE FROM student WHERE sid=$sid;";
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje2');
    if(!$baglanti)exit(mysqli_error($baglanti));
	$sonuc = mysqli_query($baglanti, $sql);
	if(!$sonuc) exit(mysqli_error($baglanti));
}
function ogrencieklemeformu($sid=null){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje2');
    if($sid){
    $sql = "SELECT * FROM student WHERE sid=$sid LIMIT 1;";
    $kayitKumesi = mysqli_query($baglanti, $sql);
    $student = mysqli_fetch_array($kayitKumesi);
    }
    echo@"
    <div align='center' class='container'>
    <form action='?' method=get name='form'>
    <h3>YENI OGRENCI</h3>
    <table class='table table-hover'>
    <tr><td>ID</td><td><input name=sid type=text  value='{$student[0]}' required></td></tr>
    <tr><td>AD</td><td><input name=fname type=text value='{$student[1]}' required></td></tr>
    <tr><td>SOYAD</td><td><input name=lname type=text value='{$student[2]}' required></td></tr>
    <tr><td>DOĞUM YERİ</td><td><input name=birthplace type=text value='{$student[3]}' required></td></tr>
    <tr><td>DOĞUM TARİHİ</td><td><input name=birthdate type=date value='{$student[4]}' required></td></tr>
    <tr><td></td><td><button type='reset' class='btn btn-danger  btn-block'>TEMİZLE</button></td></tr>
    <tr><td></td><td><input name=ekle type=submit onsubmit='return alert()' class='btn btn-danger  btn-block' value=EKLE></td></tr>
    </table>
    <input name=is type='hidden' value='".($sid ? 'ogrenciguncelle': 'ogrenciekle')."'>
    </form>
    </div>
    ";
}
function ogrenciekle($sid, $fname, $lname, $birthplace, $birthdate){
    if($sid!=null) {
    $sql="INSERT INTO STUDENT VALUE($sid, '$fname', '$lname', '$birthplace', '$birthdate');";
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje2');
	if(! $baglanti)exit(mysqli_error($baglanti));
	$sonuc = mysqli_query($baglanti, $sql);
	if(!$sonuc)exit(mysqli_error($baglanti));
    }else {
        echo "ID ALANI BOS OLAMAZ";
        ogrenciekle();
    }
}
function ogrenciguncelle($sid, $fname, $lname, $birthplace, $birthdate){
    $sql="UPDATE STUDENT SET fname='$fname',lname='$lname',birthplace='$birthplace',birthdate='$birthdate' WHERE sid=$sid LIMIT 1;";
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje2');
    if(! $baglanti)
	    exit(mysqli_error($baglanti));
	$sonuc = mysqli_query($baglanti, $sql);
	if(! $sonuc)
		exit(mysqli_error($baglanti));
}
?>
</body>