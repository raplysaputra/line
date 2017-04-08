<!DOCTYPE html>
<html>
<head>
	<title>รายงานยอดขาย สด-ผ่อน</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="./bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./DataTables-1.10.13/media/css/jquery.dataTables.min.css">
	<script type="text/javascript" src="./DataTables-1.10.13/media/js/jquery.js"></script>
	<script type="text/javascript" src="./DataTables-1.10.13/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="./js/fusioncharts.js"></script>
	<script type="text/javascript" src="./js/themes/fusioncharts.theme.fint.js"></script>
	<?php
		include 'connect.php';
		$tbbrand=array();
		$tbbranch=array();
		$tbnrandbranch=array();
		$sql="SELECT 
			b_brnd as brand
			,sum(CASE WHEN s_type ='1:ขายสด' THEN s_price ELSE 0 END) as salecash
		    ,sum(CASE WHEN  s_type ='2:ขายผ่อน' THEN s_price ELSE 0 END) as installment
			,(sum(CASE WHEN s_type ='1:ขายสด' THEN s_price ELSE 0 END)+sum(CASE WHEN  s_type ='2:ขายผ่อน' THEN s_price ELSE 0 END)) as total
			FROM EHONGDB.dbo.View_MGRSALEMOTOR
			where YEAR(BL_DATE)=2017 and MONTH(BL_DATE)=2
			group by b_brnd
			order by total desc";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$brandcate=array();
		$brandsalecash=array();
		$brandinstallment=array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			//print_r($row);
			array_push($tbbrand,$row);
			array_push($brandcate,["label"=>$row['brand']]);
			array_push($brandsalecash,["value"=>$row['salecash']]);
			array_push($brandinstallment,["value"=>$row['installment']]);
		}
		/*$sql="SELECT 
				c_branch as branch
				,SUM(CASE WHEN s_type ='1:ขายสด' THEN s_price ELSE 0 END) as salecash
				,SUM(CASE WHEN  s_type ='2:ขายผ่อน' THEN s_price ELSE 0 END) as installment
				,(sum(CASE WHEN s_type ='1:ขายสด' THEN s_price ELSE 0 END)+sum(CASE WHEN  s_type ='2:ขายผ่อน' THEN s_price ELSE 0 END)) as total	
			FROM [EHONGDB].[dbo].[View_MGRSALEMOTOR]
			where YEAR(BL_DATE)=2017 and MONTH(BL_DATE)=2
				and c_branch not like '%901%'
				and c_branch not like '%902%'
				and c_branch not like '%903%'
				and c_branch not like '%999%'
			group by c_branch
			order by total desc";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			print_r($row);
		}
		unset($dbh); unset($stmt);*/
	?>
	<script type="text/javascript">
	  FusionCharts.ready(function () {
	  var revenueChart1 = new FusionCharts({
	        type: 'msbar3d',
	        renderAt: 'chart-container1',
	        width: '800',
	        height: '900',
	        dataFormat: 'json',
	        dataSource: {
	            "chart": {
	                "caption": "รายงายการขาย ขายสด-ขายผ่อน",
	                "subCaption": "เดือน กุมภาพันธ์ ปี 2560",
	                "yAxisname": "ราคา(บาท)",
	                "numberPrefix": "฿",
	                "paletteColors": "#0075c2,#1aaf5d",
	                "bgColor": "#ffffff",
	                "legendBorderAlpha": "0",
	                "legendBgAlpha": "0",
	                "legendShadow": "0",
	                "placevaluesInside": "1",
	                "valueFontColor": "#ffffff",                
	                "alignCaptionWithCanvas": "1",
	                "showHoverEffect":"1",
	                "canvasBgColor": "#0033cc",
	                "captionFontSize": "14",
	                "subcaptionFontSize": "14",
	                "subcaptionFontBold": "0",
	                "divlineColor": "#999999",
	                "divLineIsDashed": "1",
	                "divLineDashLen": "1",
	                "divLineGapLen": "1",
	                "showAlternateHGridColor": "0",
	                "toolTipColor": "#ffffff",
	                "toolTipBorderThickness": "0",
	                "toolTipBgColor": "#000000",
	                "toolTipBgAlpha": "80",
	                "toolTipBorderRadius": "2",
	                "toolTipPadding": "5"
	            },            
                "categories": [
                    {
                      	"category": <?php echo json_encode($brandcate, JSON_PRETTY_PRINT);?>             
                    }
                ],           
                "dataset": [
                    {
                      "seriesname": "ขายสด",
                      "data": <?php echo json_encode($brandsalecash, JSON_PRETTY_PRINT);?>                   
                    }, 
                    {
                      "seriesname": "ขายผ่อน",
                      "data": <?php echo json_encode($brandinstallment, JSON_PRETTY_PRINT);?>                  
                    }
                ] 
	        }
	    })
	  	revenueChart1.render();
      	$("#tablebrand").show();
		$(document).ready(function(){
	        $("#btbrand").click(function(){
	            $("#chart-container1").show();
	            $("#divbrand").show();     
	            revenueChart1.render();
	        });	        
	    });
	});
</script>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#tablebrand').DataTable( {
		        "order": [[ 3, "desc" ]]
		    } );
		} );
	</script>
</head>
<body>
<center>
	<h1>รายงานยอดขาย สด-ผ่อน เดือน กุมภาพันธ์ ปี 2560</h1>
	<button id="graph1" class="btn btn-info btn-lg">graph1</button>
	<?php
		include 'connect.php';		
		$sql="SELECT 
			b_brnd as brand
			,sum(CASE WHEN s_type ='1:ขายสด' THEN s_price ELSE 0 END) as salecash
		    ,sum(CASE WHEN  s_type ='2:ขายผ่อน' THEN s_price ELSE 0 END) as installment
			,(sum(CASE WHEN s_type ='1:ขายสด' THEN s_price ELSE 0 END)+sum(CASE WHEN  s_type ='2:ขายผ่อน' THEN s_price ELSE 0 END)) as total
			FROM EHONGDB.dbo.View_MGRSALEMOTOR
			where YEAR(BL_DATE)=2017 and MONTH(BL_DATE)=2
			group by b_brnd
			order by total desc";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		echo "<h1>ยี่ห้อ</h1>";
		?> 
		<div id="divbrand" style="width: 800px;">
			<table id="tablebrand" class="table table-hover table-bordered"> 
				<thead>
					<tr class="success">
						<th>ยี่ห้อ</th>
						<th>ขายสด</th>
						<th>ขายผ่อน</th>
						<th>รวม</th>
					</tr>
				</thead>
				<tbody>
		<?php
		foreach ($tbbrand as $value) {
			echo "<tr class='info'>";
			echo "<td>$value[brand]</td>";
			echo "<td>$value[salecash]</td>";
			echo "<td>$value[installment]</td>";
			echo "<td>$value[total]</td>";
			echo "</tr>";
		}
		?> 		
				</tbody>
			</table> 
			<div id="chart-container1"></div>
		</div>
		<?php
		$sql="SELECT 
				c_branch as branch
				,SUM(CASE WHEN s_type ='1:ขายสด' THEN s_price ELSE 0 END) as salecash
				,SUM(CASE WHEN  s_type ='2:ขายผ่อน' THEN s_price ELSE 0 END) as installment
				,(sum(CASE WHEN s_type ='1:ขายสด' THEN s_price ELSE 0 END)+sum(CASE WHEN  s_type ='2:ขายผ่อน' THEN s_price ELSE 0 END)) as total	
			FROM [EHONGDB].[dbo].[View_MGRSALEMOTOR]
			where YEAR(BL_DATE)=2017 and MONTH(BL_DATE)=2
				and c_branch not like '%901%'
				and c_branch not like '%902%'
				and c_branch not like '%903%'
				and c_branch not like '%999%'
			group by c_branch
			order by total desc";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		echo "<h1>สาขา</h1>";
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			print_r($row);
			echo "<br>";
		}
		unset($dbh); unset($stmt);
	?>
</center>
</body>
</html>