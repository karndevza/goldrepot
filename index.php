<?php 
$url = 'http://localhost/goldfire2/goldjs.php';
$urls = 'http://localhost/goldfire2/gold.json';
//$urls = 'https://karndiyza.000webhostapp.com/goldjs.php';
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
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once('tamplate/head.php');?>
</head>

<body class="index-page sidebar-collapse">
<?php //include_once('tamplate/nav.php');?>
  
  <div class="main main-raised">
    <div class="section section-tabs">
      <div class="container">
        <!--                nav tabs	             -->
        <div id="nav-tabs">
          <!-- <h3>Navigation Tabs</h3> -->
          <div class="row">
            <div class="col-md-12">
              <h3><div class="text-center"><small >ราคาทองตามประกาศสมาคมค้าทองคำ</small></div></h3>
              <!-- Tabs with icons on Card -->
              <div class="card card-nav-tabs">
                <div class="card-header card-header-warning">
                  <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                  <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                      <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                          <a class="nav-link active" href="#profile" data-toggle="tab">
                            <i class="material-icons">update</i>
                            ราคาล่าสุด
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#messages" data-toggle="tab">
                            <i class="material-icons">analytics</i>
                            สรุป
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#settings" data-toggle="tab">
                            <i class="material-icons">calculate</i>
                            คำนวณ
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="card-body ">                 
                  <div class="tab-content ">                  
                    <div class="tab-pane active" id="profile">
                      <div class="font-SZ text-center">  
                      ประจำวันที่ <?=$manage[1][0]['time'];?> ครั้งที่ ( <?=$manage[1][0]['upd'];?> )
                      </div>
                      <?php  
                        if($data == 'true'){
                      ?>
                          <table class="table">
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
                      <?php 
                        }else{
                          echo 'รอการ update';
                        }
                      ?>
                     
                    </div>

                    <div class="tab-pane" id="messages">
                    <table class="table">
                            <thead>
                                <tr>                             
                                    <th>เวลา</th>
                                    <th class="text-center">ครั้งที่</th>
                                    <th class="text-center">Gold Spot</th>
                                    <th class="text-center">USD/บาท</th>
                                    <th class="text-center">ขึ้นลง</th>                                
                                </tr>
                            </thead>
                            <tbody>
                           
                            <?php 
                            
                            for ($i = 0 ; $i < count($manage[1]); $i++) {
                               $tr_class_color  = chk_table_color($manage[1][$i]['price']);
                                $data = '';
                                $data = '<tr '.$tr_class_color.' >';
                                $data .= '<td>'.$manage[1][$i]['time'].'</td>';                               
                                
                                 $data .= '<td class="text-center">'.$manage[1][$i]['upd'].'</td>';  
                                 $data .= '<td class="text-center">'.$manage[1][$i]['gspot'].'</td>';
                                 $data .= '<td class="text-center">'.$manage[1][$i]['usd'].'</td>';                               
                                $data .= '<td class="text-center '.chk_color($manage[1][$i]['price']).'">'.$manage[1][$i]['price'].'</td>';
                                $data .= '</td>';
                                echo $data;

                            }
                            ?> 
                            </tbody>
                            </table>
                    </div>

                    <div class="tab-pane" id="settings">
                    

                  </div>
                </div>
              </div>
              <!-- End Tabs with icons on Card -->
            </div>
            <div class="row">
            <div class="col-md-12" >
                <div class="card card-nav-tabs">
                    <div class="card-header card-header-warning text-center">
                      คำนวณราคาทองคำ
                    </div>
                    <div class="card-body">
                    <table class="table">
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
                   
                  <div>            
                </div>          
            </div>
            </div>
            
        
          </div>
        </div>
      </div>
    </div>
    
   

  </div>
  <?php //include_once('tamplate/foot.php');?>
  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
  <script src="./assets/js/plugins/moment.min.js"></script>
  <!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
  <script src="./assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/material-kit.js?v=2.0.7" type="text/javascript"></script>
  <script>
    $(document).ready(function() {
      //init DateTimePickers
      materialKit.initFormExtendedDatetimepickers();

      // Sliders Init
      materialKit.initSliders();
    });


    function scrollToDownload() {
      if ($('.section-download').length != 0) {
        $("html, body").animate({
          scrollTop: $('.section-download').offset().top
        }, 1000);
      }
    }
  </script>
</body>

</html>