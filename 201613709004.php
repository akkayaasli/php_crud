<?php

$sunucu_adi="localhost";
$kullanici_adi="root";
$sifre="";
$vt="ara_sinav";

$baglanti=new mysqli($sunucu_adi,$kullanici_adi,$sifre,$vt);

mysqli_set_charset($baglanti,"utf8");
if($baglanti->connect_error)
	die("bağlantı sağlanamadı:".$baglanti->connect_error);

?>



<!doctype html>
<html lang="en">
  <head>
   

    <title>ASLI AKKAYA-CRUD</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
  </head>

  <body class="bg-light">
  
  
  

  
 
    <div class="container">
      <div class="py-5 text-center">
        <h2>CRUD İŞLEMLERİ</h2>
		</div>
		<div class="row">
		<div class="col-md-12 order-md-2">
		
		<?php
			//düzenleme kodları yazılacak güncelleme butonu eklenecek.
			if(isset($_POST["aa_duzenle"]))
			{
				$sorgu_duzenle="SELECT * FROM kullanici WHERE id=".$_POST["aa_duzenle"];
				$sonuc=$baglanti->query($sorgu_duzenle);
				$kayit=$sonuc->fetch_assoc();
			
		?>





        <form class="needs-validation" method="POST" action="" >
            <div class="row">
              <div class="col-md-6 mb-3">


                <label for="firstName"> Kullanıcı Adı</label>
                <input type="text" name="aa_kullanici_adi" class="form-control" id="firstName" placeholder="" value="<?=$kayit["kullanici_adi"]?>" >

                <label for="firstName"> Şifre</label>
                <input type="password" name="aa_sifre" class="form-control" id="secondName" placeholder="" value="<?=$kayit["sifre"]?>" >

                  <label for="firstName"> Eposta</label>
                <input type="email" name="aa_eposta" class="form-control" id="thirdName" placeholder="" value="<?=$kayit["eposta"]?>" >


				<input type="hidden" name="aa_id" class="form-control" id="firstName" placeholder="" value="<?=$kayit["id"]?>" >


              </div>
            
            </div>
			
            <button class="btn btn-primary btn-lg btn-block" name="aa_guncelle" type="submit">Kullanıcı Bilgilerini Güncelle</button>
        </form>
		





		<?php
			//kapatılacak else ile devam edilecek
			}
			else
			{
		?>
		






		<form class="needs-validation" method="POST" action="" >
            <div class="row">
              <div class="col-md-6 mb-3">


                <label for="firstName"> Kullanıcı Adı</label>
                <input type="text" name="aa_kullanici_adi" class="form-control" id="firstName" placeholder="" value="" >


                 <label for="firstName"> Şifre</label>
                <input type="text" name="aa_sifre" class="form-control" id="secondName" placeholder="" value="" >

                 <label for="firstName"> Eposta</label>
                <input type="text" name="aa_eposta" class="form-control" id="thirdName" placeholder="" value="" >


              </div>
            
            </div>
			
            <button class="btn btn-primary btn-lg btn-block" name="aa_kullanici_kaydet" type="submit">Kullanıcıyı Kaydet</button>
        </form>
		  
        </div>
      </div>
	  
	  <?php
			}
	  ?>
	  
	  
       
	   
	   <?php
			if(isset($_POST["aa_kullanici_kaydet"]))
			{
				$sorgu_kullanici_kayıt="INSERT INTO `kullanici` (`id`, `kullanici_adi`,`sifre`,`eposta`)

				 VALUES (NULL, '".$_POST["aa_kullanici_adi"]."','".$_POST["aa_sifre"]."','".$_POST["aa_eposta"]."');";

				$baglanti->query($sorgu_kullanici_kayıt);

			}





			if(isset($_POST["aa_sil"]))
			{
				$sorgu_sil="DELETE FROM `kullanici` WHERE `kullanici`.`id` =".$_POST["aa_sil"];
				$baglanti->query($sorgu_sil);
				
			}
			
			if(isset($_POST["aa_guncelle"]))
			{
				$sorgu_guncelle="UPDATE `kullanici` 

				SET `kullanici_adi` = '".$_POST["aa_kullanici_adi"]."',
				`sifre` = '".$_POST["aa_sifre"]."',

				`eposta` = '".$_POST["aa_eposta"]."'


				 WHERE `kullanici`.`id` =".$_POST["aa_id"];

				$baglanti->query($sorgu_guncelle);
				
			}
	   ?>
      
      
          
        <form method="POST" action="">
			<div class="container">
			<div class="py-5 text-center">
				<h2>Kullanıcıları Listele,Düzenle,Sil</h2>
			</div>
			<div class="row">
				<table class="table">
					<thead>
					<tr>
						<th>ID</th>
						<th>KULLANICI ADI</th>
						<th>ŞİFRE</th>
						<th>E-POSTA</th>
					</tr>
					</thead>
					<tbody>
					
					<?php
						$sorgu_listele="SELECT * FROM kullanici";
						$sonuc=$baglanti->query($sorgu_listele);
						while($kayit=$sonuc->fetch_assoc())
						{
					?>
					<tr>
						<td><?=$kayit["id"]?></td>
						<td><?=$kayit["kullanici_adi"]?></td>
						<td><?=$kayit["sifre"]?></td>
						<td><?=$kayit["eposta"]?></td>
						<td>
							<button name="aa_duzenle" type="submit" value="<?=$kayit["id"]?>">Düzenle</button>
							<button name="aa_sil" type="submit" value="<?=$kayit["id"]?>">Sil</button>
						</td>
					</tr>
					<?php
						}
					?>
					</tbody>
				</table>
			</div>
			</div>
		</form>                                  			      
                           
                                            
      <footer class="my-5 pt-5 text-muted text-center text-small">
       
        <ul class="list-inline">
        </ul>
      </footer>
    </div>
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  </body>
</html>













