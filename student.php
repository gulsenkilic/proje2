<html>
<head> <title>STUDENT</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
a:link, a:visited {color: white;}
</style>
</head>
<body >

<?php 
switch (@ $_GET['is']) {
    case 'ogrencisil': ogrencisil($_GET['sid']);
        // anasayfa();
         break;
         
    case 'ogrencieklemeformu':ogrencieklemeformu($sid=null);
         break;   
    case 'ogrenciekle':ogrenciekle($_GET['sid'],$_GET['fname'],$_GET['lname'],$_GET['birthplace'],$_GET['birthdate']);
          anasayfa();
          break;
    default:
       anasayfa();
       break;
}
function anasayfa(){
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje2');
    $kayitKumesi = mysqli_query($baglanti, "SELECT * FROM student");
    $gosterim=10;
    $sayfa=@$_GET['sayfa'];

    echo "<div align='center' class='container'>
    <h1>ÖĞRENCİLER</h1>
    <table  class='table table-hover'>
    <thead><tr >
    <th class='table-dark'>ID</th>
    <th>AD</th>
    <th>SOYAD</th>
    <th>DOĞUM YERİ</th>
    <th>DOĞUM TARIHI</th>
    <th>SIL</th>
    <th>GUNCELLE</th>  
    </tr></thead>
    ";
    
    while($satir = mysqli_fetch_assoc($kayitKumesi)){
    print  "<tr> 
			<td>{$satir['sid']}</td> 
			<td>{$satir['fname']}</td> 
			<td>{$satir['lname']}</td> 
			<td>{$satir['birthplace']}</td>
			<td>{$satir['birthdate']}</td>
			<td><button type='button' class='btn btn-danger'><a  href='?is=ogrencisil&sid={$satir['sid']}'>OGRENCI SIL</a></button></td>
            <td><button type='button'  class='btn btn-info'><a href='?is=ogrencieklemeformu'>GUNCELLE</a></button></td>
			</tr>";
    } print "</tbody></table><a href='?is=ogrencieklemeformu' style='color=white'><button type='button'  class='btn btn-success'</button>>OGRENCI EKLE </a></div>";
    

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
         $artist = mysqli_fetch_array($kayitKumesi);
    }
    echo@"
    <div align='center' class='container'>
    <form action='?' method=get>
    <h3>YENI OGRENCI</h3>
    <table class='table table-hover'>
    <tr><td>ID</td><td><input name=sid type=text value='{$student[0]}'></td></tr>
    <tr><td>AD</td><td><input name=fname type=text value='{$student[1]}'></td></tr>
    <tr><td>SOYAD</td><td><input name=lname type=text value='{$student[2]}'></td></tr>
    <tr><td>DOĞUM YERİ</td><td><input name=birthplace type=text value='{$student[3]}'></td></tr>
    <tr><td>DOĞUM TARİHİ</td><td><input name=birthdate type=date value='{$student[4]}'></td></tr>
    <tr><td></td><td><button type='reset' class='btn btn-danger  btn-block'>TEMİZLE</button></td></tr>
    <tr><td></td><td><input name=ekle type=submit class='btn btn-danger  btn-block' value=EKLE></td></tr>
    </table>
    <input name=is  value='".($sid ? 'ogrenciguncelle': 'ogrenciekle')."'>
    </form>
    </div>
    ";
}
function ogrenciekle($sid, $fname, $lname, $birthplace, $birthdate){
    $sql="INSERT INTO STUDENT VALUE($sid, '$fname', '$lname', '$birthplace', '$birthdate');";
    $baglanti = mysqli_connect('localhost', 'root', '1234', 'proje2');
    echo $sql;
	if(! $baglanti)exit(mysqli_error($baglanti));
	 $sonuc = mysqli_query($baglanti, $sql);
	if(!$sonuc)exit(mysqli_error($baglanti));

}
?>


</body>



