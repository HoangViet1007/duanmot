<?php
    require_once "../layout/layout.php" ; 
    require_once APP_PATH."/dao/pdo.php" ; 
    
   // lấy tấ cả user 
   $sqlu = "SELECT COUNT(*) as u from users" ; 
   $u = select_one($sqlu) ;

    // lấy tấ cả loai_phong 
    $sqlu = "SELECT COUNT(*) as lp from loai_phong" ; 
    $lp = select_one($sqlu) ;

    // lấy tấ cả loai_phong 
    $sqlu = "SELECT COUNT(*) as bl from binh_luan" ; 
    $bl = select_one($sqlu) ;

    // lấy tấ cả loai_phong 
    $sqlu = "SELECT sum(tong_tien) as tt from orders" ; 
    $tt = select_one($sqlu) ;

    // làm biểu đồ trong
        $sql = "SELECT
                        id,
                        ten_loai AS 'ten_loai',
                        so_luong_phong,
                        MIN(don_gia) AS gia_min,
                        MAX(don_gia) AS gia_max,
                        AVG(don_gia) AS gia_avg
                    FROM
                        loai_phong
                    GROUP BY
                         ten_loai" ;
        
    $tks = select_all($sql) ;   

    // làm biểu đồ doanh thu 
    $sql = "SELECT 
                  month(ngay_tao) as nt,
                  SUM(tong_tien) as tt
           FROM 
                orders 
           WHERE 
                month(ngay_tao)
           GROUP BY
                 month(ngay_tao)" ; 
     $dt = select_all($sql) ;             

        
  
?>
<style>
.shadow {
    box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
}

.card1 {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, .125);
    border-radius: .25rem;
}

.border-left-primary {
    border-left: .25rem solid #4e73df !important;
}

.border-left-success {
    border-left: .25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: .25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: .25rem solid #f6c23e !important;
}

.text-xs {
    font-size: .7rem;
}

.text-gray-800 {
    color: #5a5c69 !important;
}

.text-gray-300 {
    color: #dddfeb !important;
}

.col-auto {
    color: white;
}

.text-gray-300 {
    color: #dddfeb !important;
}
</style>
<script type="text/javascript">
// ----------------- làm biểu đồ trong --------------
google.charts.load("current", {
    packages: ["corechart"]
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    var data = google.visualization.arrayToDataTable([
        ['Loại', 'Số Lượng'],
        <?php
                foreach ($tks as $item){
                    echo "['$item[ten_loai]',  $item[so_luong_phong]],";
                }
                ?>
    ]);

    var options = {
        is3D: true,
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
    chart.draw(data, options);
}
</script>

<div class="page-header" style=" background-color: #FAFAFA;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.1);">
    <div class="container-fluid">
        <h2 class="h5 no-margin-bottom">Dashbroad</h2>
    </div>
</div>

<?php if(isset($_GET['msg'])) : ?>
<p style="color: #AA0000; margin-left: 20px; font-weight: bold;"><?= $_GET['msg'] ?></p>
<?php endif ?>

<div class="conten" style="margin: 30px 20px 30px 20px; background-color: #FAFAFA;">
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card1 border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                user</div>
                            <div class="h5 mb-0 font-weight-bold text-dark"><?php echo $u['u'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i style="font-size: 40px;" class="fa fa-user text-gray-300" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- category s -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card1 border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-dark">$<?php echo $tt['tt'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-usd text-gray-300" style="font-size: 40px;" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- product -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card1 border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">product
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-dark"><?php echo $lp['lp'] ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-shopping-cart text-gray-300" style="font-size: 40px;"
                                aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- comment -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card1 border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                new comment</div>
                            <div class="h5 mb-0 font-weight-bold text-dark"><?php echo $bl['bl'] ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-comments text-gray-300" style="font-size: 40px;" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="chart-left"
                style="border: 1px solid #dedede; width: 100%; height: 400px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.2);">
                <!-- biểu đồ doanh thu  -->
                <canvas id="lineChart"></canvas>

            </div>
        </div>
        <div class="col-md-4">
            <div class="chart-right"
                style="border: 1px solid #dedede; width: 100%; height: 400px;box-shadow: 0px 5px 20px 0px rgba(0, 0, 0, 0.2); padding: 30px;">
                <!-- biểu đồ hình tròn  -->
                <p
                    style="color: gray; font-size: 18px; font-weight: bold; text-transform: uppercase; margin-left: 10px; text-align: center;">
                    Thống kê loại phòng </p>
                <div id="piechart_3d" style=" height: 330px; margin-top: -20px;"></div>
            </div>
        </div>
    </div>
</div>
<script>
// làm biểu đồ doanh thu   

var ctx = document.getElementById('lineChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        // labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','October','December'],
        labels : [<?php
              foreach ($dt as $key) {
                  echo $key['nt']."," ; 
                
              } 
        ?>] ,
        datasets: [{
            label: 'Thống kê doanh thu theo tháng (Tỉ lệ $)',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: '#FFFF00',
            // data: [0, 10, 5, 2, 20, 30, 45,67,42,10,23,17]
            data : [<?php 
                 foreach ($dt as $key) {
                     echo $key['tt']."," ; 
                 }
            ?>]
        }]
    },

    // Configuration options go here
    options: {}
});
</script>