<?php 
 // $curl = "http://" . $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
 // $url = $curl.'/goldjs.php';
 

  //$url = 'http://localhost/goldfire2/goldjs.php';
 // $urls = $curl.'/gold.json';
  $urls = 'https://zpay2.000webhostapp.com/api/gold.json';
  $url = 'https://zpay2.000webhostapp.com/api/goldupdate.php';
  $callapi = file_get_contents($url);  
  $homepage = file_get_contents($urls);    

  $data = $homepage;

  $manage = json_decode($data, true);
  $num = 0; $nums=0;
  $price = array();

  if($manage[0]['status']=='fail'){
      $data ='fail';

    }else{
      $data ='true';

    for ($i = 0 ; $i < count($manage[1]); $i++) {    
      $num = $manage[1][$i]['price'];
      $nums = $nums +  $manage[1][$i]['price'];
    }
    if($nums<0){
          $strnum = '<i class="fa fa-sort-down" style="font-size:28px;color:red"><font color="red"> '.$nums.'</font>';
          
      } else{
        $strnum = '<i class="fa fa-sort-up" style="font-size:28px;color:green"><font color="green"> '.$nums.'</font>';
      
      }  

      if($manage[1][0]['price']<0){
        $pupd = '<i class="fa fa-sort-down" style="font-size:28px;color:red"></i><font color="red">'.$manage[1][0]['price'].'</font>';
        $cls_color = "color_red";
      }else{
        $pupd = '<i class="fa fa-sort-up" style="font-size:28px;color:green"></i><font color="green">'.$manage[1][0]['price'].'</font>';
        $cls_color = "color_green";
      }
  }  

  function chk_color($num){
    if($num<0){
      $strx = "color_red";
    }else{
      $strx = "color_green";
    }
    return  $strx;
  }

  function chk_table_color($num){
    if($num<0){
      $strx = ' class="bg-warning font-size: 150%;font-weight: 500" ';
    }else{
      $strx = ' class="bg-success font-size: 150%;font-weight: 500" ';
    }
    return  $strx;
  }
?>


<html lang="en" class="h-100">
  <head>
      <meta charset="utf-8">
      
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="ราคาทองคำวันนี้">
      <meta name="author" content="K@rnDIY | goldreport Thailand">
      <meta name="generator" content="K@rnDIY">
      <title> ราคาทองคำวันนี้ </title></title>

      <!-- <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sticky-footer/"> -->

      <!-- Bootstrap core CSS -->
      <!-- <link href="https://getbootstrap.com/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
      <!-- Favicons -->
      <!-- <link rel="apple-touch-icon" href="https://getbootstrap.com/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
      <link rel="icon" href="https://getbootstrap.com/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
      <link rel="icon" href="https://getbootstrap.com/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
      <link rel="manifest" href="https://getbootstrap.com/docs/4.5/assets/img/favicons/manifest.json">
      <link rel="mask-icon" href="https://getbootstrap.com/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
      <link rel="icon" href="https://getbootstrap.com/docs/4.5/assets/img/favicons/favicon.ico"> -->
      <!-- <meta name="msapplication-config" content="https://getbootstrap.com/docs/4.5/assets/img/favicons/browserconfig.xml"> -->
        <meta name="theme-color" content="#563d7c">

      <?php include_once('tamplate/head.php');?>
        <style>
          .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
          }

          @media (min-width: 768px) {
            .bd-placeholder-img-lg {
              font-size: 3.5rem;
            }
          }
          .font-SZ{font-size: 150%;font-weight: 500;}
          .color_red{ color:red;font-size: 150%;font-weight: 900;}
          .color_green{ color:green;font-size: 150%;font-weight: 900;}

          .container {
          width: auto;
          max-width: 680px;
          padding: 0 15px;
          }
          
        .dark-mode {
          background-color: #222;
          color: white;
        }

          .footer {
          background-color: #f5f5f5;
          }
        </style>
        <!-- Custom styles for this template -->
        <!-- <link href="sticky-footer.css" rel="stylesheet"> -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  </head>
  <body class="d-flex flex-column h-100">
    <!-- Begin page content -->
 <main role="main" class="flex-shrink-0">
  <div class="container">
 

   <div class="text-center">
      <input onclick="myFunction()" type="checkbox"  data-toggle="toggle"> Dark mode
      </label> 
   </div>

    <div  class="card-body" id="report-gold2day">
          <h3 class="mt-5 text-center">ราคาทองตามประกาศของสมาคมค้าทองคำ </h3>
          <p class="lead text-center">ราคาทองคำ ประจำวันที่ : <?=$manage[1][0]['time'];?> : ครั้งที่ <?=$manage[1][0]['upd'];?> </p>
          <?php  if($data == 'true'){ ?>
        <table class="table table-warning">
          <thead>  
            <tbody>
              <thead>                            
                          <tr>                             
                                  <th>96.5%</th>
                                  <th class="text-center">รับซื้อ</th>
                                  <th class="text-center">ขายออก</th>                                
                              </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>ทองคำแท่ง</td>
                              <td class="text-center <?=$cls_color;?>"><?=$manage[1][0]['blbuy'];?></td>
                              <td class="text-center <?=$cls_color;?>"><?=$manage[1][0]['blsell'];?></td>  
                          </tr>
                          <tr>
                              <td >ทองคำรูปพรรณ</td>
                              <td class="text-center <?=$cls_color;?>"><?=$manage[1][0]['ombuy'];?></td>
                              <td class="text-center <?=$cls_color;?>"><?=$manage[1][0]['omsell'];?></td>                           
                          </tr>
                          <tr>
                            <td >วันนี้ <?= $strnum;?></td>
                            <td class="text-center <?=$cls_color;?>"><?=$pupd;?></td>    
                            <td class="text-center <?=$cls_color;?>"><?=$pupd;?></td>                           
                          </tr>
            </tbody>
        </table>  

         <?php  }else{ echo 'รอการ update';   }
                      ?>  
    </div>
    <div  class="card-body" id="report-Cal-gold">
      <h3 class="mt-5 text-center">คำนวนราคาทองคำ </h3>
          
      <table class="table table-dark ">
      <?php 
                        function toNumber($val) {
                          $val =   str_replace(',','',$val);
                          if (is_numeric($val)) {
                              $int = (int)$val;
                              $float = (float)$val;
                      
                              $val = ($int == $float) ? $int : $float;
                              return $val;
                          } else {
                              trigger_error("Cannot cast $val to a number", E_USER_WARNING);
                              return null;
                          }
                      }
                        $golds = toNumber($manage[1][0]['ombuy']);
                        
                        ?>
                            <thead>
                                  <tr>                             
                                      <th class="font-SZ"  >ทองคำรูปพรรณ</th>
                                      <th class="text-center font-SZ">ราคา/บาท</th>                                                             
                                  </tr>
                              </thead>
                              <tbody>
                              <tr>
                                  <td class="font-SZ" >1 บาท</td>  
                                  <td class="text-center font-SZ"><?=number_format($golds,2);?></td> 
                              </tr>
                              <tr>
                                  <td class="font-SZ">2 สลึง</td>  
                                  <td class="text-center font-SZ"><?=number_format(($golds/2),2);?></td> 
                              </tr>
                              <tr>
                                  <td class="font-SZ">1 สลึง</td>  
                                  <td class="text-center font-SZ"><?=number_format((($golds)/4),2);?></td> 
                              </tr>
                              <tr>
                                  <td class="font-SZ">ครึ่งสลึง</td>  
                                  <td class="text-center font-SZ"><?=number_format(((($golds/4))/2),2);?></td> 
                              </tr>
              </tbody>
          </table>    

        
    </div>


  </div>
</main>

<footer class="footer mt-auto py-3 text-center">
  <div class="container">  
    <span class="text-muted"><a href="https://Smsgoldthai.blogspot.com">เวปไซต์ ราคาทองคำวันนี้ | </a></span>
    <span class="text-muted"><a href="https://www.facebook.com/Smsgoldthai">เพจ ราคาทองคำวันนี้ | </a></span>
    <span class="text-muted"><a href="https://www.facebook.com/groups/229399434638052">กลุ่ม ราคาทองคำวันนี้ |</a></span>
  </div>
</footer>

<script>
function myFunction() {
   var element = document.body;
   var etable = document.table;
   element.classList.toggle("dark-mode");
  <?php $_SESSION['darkmode'] = !$_SESSION['darkmode'];?>
}
</script>
</body></html>
