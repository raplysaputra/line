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
		function getm($m){
			if($m==1){
				return "มกราคม";
			}else if($m==2){
				return "กุมภาพันธ์";
			}else if($m==3){
				return "มีนาคม";
			}else if($m==4){
				return "เมษายน";
			}else if($m==5){
				return "พฤษภาคม";
			}else if($m==6){
				return "มิถุนายน";
			}else if($m==7){
				return "กรกฎาคม";
			}else if($m==8){
				return "สิงหาคม";
			}else if($m==9){
				return "กันยายน";
			}else if($m==10){
				return "ตุลาคม";
			}else if($m==11){
				return "พฤศจิกายน";
			}else if($m==12){
				return "ธันวาคม";
			}else{
				return "มกราคม";
			}
		}
		function gety($y){
			return $y+543;
		}
		$month;
		$year;
		if(empty($_REQUEST['y']) or empty($_REQUEST['m'])){
			$now = new DateTime('now');
			$month = $now->format('m');
			$year = $now->format('Y');
		}else{
			$month=$_REQUEST['m'];
			$year=$_REQUEST['y'];
		}
		$tbbrand=array();		
		$sql="SELECT 
			b_brnd as brand
			,sum(CASE WHEN s_type ='1:ขายสด' THEN s_price ELSE 0 END) as salecash
		    ,sum(CASE WHEN  s_type ='2:ขายผ่อน' THEN s_price ELSE 0 END) as installment
			,(sum(CASE WHEN s_type ='1:ขายสด' THEN s_price ELSE 0 END)+sum(CASE WHEN  s_type ='2:ขายผ่อน' THEN s_price ELSE 0 END)) as total
			FROM EHONGDB.dbo.View_MGRSALEMOTOR
			where YEAR(BL_DATE)=$year and MONTH(BL_DATE)=$month
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
		$tbbranch=array();		
		$sql="SELECT 
				c_branch as branch
				,SUM(CASE WHEN s_type ='1:ขายสด' THEN s_price ELSE 0 END) as salecash
				,SUM(CASE WHEN  s_type ='2:ขายผ่อน' THEN s_price ELSE 0 END) as installment
				,(sum(CASE WHEN s_type ='1:ขายสด' THEN s_price ELSE 0 END)+sum(CASE WHEN  s_type ='2:ขายผ่อน' THEN s_price ELSE 0 END)) as total	
			FROM [EHONGDB].[dbo].[View_MGRSALEMOTOR]
			where YEAR(BL_DATE)=$year and MONTH(BL_DATE)=$month
				and c_branch not like '%901%'
				and c_branch not like '%902%'
				and c_branch not like '%903%'
				and c_branch not like '%999%'
			group by c_branch
			order by total desc";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$branchcate=array();
		$branchsalecash=array();
		$branchinstallment=array();
		$branchnum=0;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			//print_r($row);
			array_push($tbbranch,$row);
			if($branchnum<15){
				array_push($branchcate,["label"=>$row['branch']]);
				array_push($branchsalecash,["value"=>$row['salecash']]);
				array_push($branchinstallment,["value"=>$row['installment']]);
			}
			$branchnum++;
		}
		$tbbranchbrand=array();
		$sql="SELECT 
				c_branch as branch
				,b_brnd as brand
				,SUM(CASE WHEN s_type ='1:ขายสด' THEN s_price ELSE 0 END) as salecash
				,SUM(CASE WHEN  s_type ='2:ขายผ่อน' THEN s_price ELSE 0 END) as installment
				,sum(CASE WHEN s_type ='1:ขายสด' THEN s_price ELSE 0 END)+sum(CASE WHEN  s_type ='2:ขายผ่อน' THEN s_price ELSE 0 END) as total	
			FROM [EHONGDB].[dbo].[View_MGRSALEMOTOR]
			where YEAR(BL_DATE)=$year and MONTH(BL_DATE)=$month
				and c_branch not like '%901%'
				and c_branch not like '%902%'
				and c_branch not like '%903%'
				and c_branch not like '%999%'
			group by c_branch,b_brnd
			order by total desc";
		$stmt = $dbh->prepare($sql);
		$stmt->execute();
		$branchbrandcate=array();
		$branchbrandsalecash=array();
		$branchbrandinstallment=array();
		$branchbrandnum=0;
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			//print_r($row);
			array_push($tbbranchbrand,$row);
			if($branchbrandnum<15){
				array_push($branchbrandcate,["label"=>$row['branch']." --- ".$row['brand']]);
				array_push($branchbrandsalecash,["value"=>$row['salecash']]);
				array_push($branchbrandinstallment,["value"=>$row['installment']]);
			}
			$branchbrandnum++;
		}
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
	                "caption": "รายงายการขาย ขายสด-ขายผ่อน ยี่ห้อ",
	                "subCaption": "เดือน <?php echo getm($month);?> ปี <?php echo gety($year);?>",
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
	  	var revenueChart2 = new FusionCharts({
	        type: 'msbar3d',
	        renderAt: 'chart-container2',
	        width: '800',
	        height: '900',
	        dataFormat: 'json',
	        dataSource: {
	            "chart": {
	                "caption": "รายงายการขาย ขายสด-ขายผ่อน สาขา",
	                "subCaption": "เดือน <?php echo getm($month);?> ปี <?php echo gety($year);?>",
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
                      	"category": <?php echo json_encode($branchcate, JSON_PRETTY_PRINT);?>             
                    }
                ],           
                "dataset": [
                    {
                      "seriesname": "ขายสด",
                      "data": <?php echo json_encode($branchsalecash, JSON_PRETTY_PRINT);?>                   
                    }, 
                    {
                      "seriesname": "ขายผ่อน",
                      "data": <?php echo json_encode($branchinstallment, JSON_PRETTY_PRINT);?>                  
                    }
                ] 
	        }
	    })
	    var revenueChart3 = new FusionCharts({
	        type: 'msbar3d',
	        renderAt: 'chart-container3',
	        width: '800',
	        height: '900',
	        dataFormat: 'json',
	        dataSource: {
	            "chart": {
	                "caption": "รายงายการขาย ขายสด-ขายผ่อน สาขา X ยี่ห้อ",
	                "subCaption": "เดือน <?php echo getm($month);?> ปี <?php echo gety($year);?>",
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
                      	"category": <?php echo json_encode($branchbrandcate, JSON_PRETTY_PRINT);?>             
                    }
                ],           
                "dataset": [
                    {
                      "seriesname": "ขายสด",
                      "data": <?php echo json_encode($branchbrandsalecash, JSON_PRETTY_PRINT);?>                   
                    }, 
                    {
                      "seriesname": "ขายผ่อน",
                      "data": <?php echo json_encode($branchbrandinstallment, JSON_PRETTY_PRINT);?>                  
                    }
                ] 
	        }
	    })
	  	revenueChart1.render();	  	
	  	$("#divbrand").show();
	    $("#divbranch").hide();
	    $("#divbranchbrand").hide();
		$(document).ready(function(){
	        $("#btbrand").click(function(){
	           	$("#divbrand").show();
	            $("#divbranch").hide();
	            $("#divbranchbrand").hide();
	            document.getElementById("librand").className = "active";
	            document.getElementById("libranch").className = "";
	            document.getElementById("libranchbrand").className = "";
	        });
	        $("#btbranch").click(function(){
	        	$("#divbrand").hide();
	            $("#divbranch").show();
	            $("#divbranchbrand").hide();
	            revenueChart2.render();
	            document.getElementById("librand").className = "";
	            document.getElementById("libranch").className = "active";
	            document.getElementById("libranchbrand").className = "";
	        });
	        $("#btbranchbrand").click(function(){
	        	$("#divbrand").hide();
	            $("#divbranch").hide();
	            $("#divbranchbrand").show();
	            revenueChart3.render();
	            document.getElementById("librand").className = "";
	            document.getElementById("libranch").className = "";
	            document.getElementById("libranchbrand").className = "active";
	        });
	    });	    
	});
</script>
	<script type="text/javascript">
		$(document).ready(function() {
		    $('#tablebrand').DataTable( {
		        "order": [[ 3, "desc" ]]
		    } );
		    $('#tablebranch').DataTable( {
		        "order": [[ 3, "desc" ]]
		    } );
		    $('#tablebranchbrand').DataTable( {
		        "order": [[ 0, "asc" ],[ 4, "desc" ]]
		    } );
		} );
	</script>
</head>
<body>
<center>
	<h1>รายงานยอดขาย สด-ผ่อน เดือน <?php echo getm($month);?> ปี <?php echo gety($year);?></h1>
	<div style="width: 800px;margin: 30px;">
		<ul class="nav nav-tabs nav-pills">
		    <li class="active" id="librand"><a id="btbrand">ยี่ห้อ</a></li>
		    <li id="libranch"><a id="btbranch">สาขา</a></li>
		    <li id="libranchbrand"><a id="btbranchbrand">สาขาXยี่ห้อ</a></li>
	  	</ul>
  	</div>
  	*หมายเหตุ กดshiftค้างเพื่อเรียงมากกว่า2หัวข้อ
	<!-- <button id="btbrand" class="btn btn-info btn-lg">ยี่ห้อ</button>
	<button id="btbranch" class="btn btn-info btn-lg">สาขา</button> -->
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
	<div id="divbranch" style="width: 800px;">
		<table id="tablebranch" class="table table-hover table-bordered"> 
			<thead>
				<tr class="success">
					<th>สาขา</th>
					<th>ขายสด</th>
					<th>ขายผ่อน</th>
					<th>รวม</th>
				</tr>
			</thead>
			<tbody>
	<?php
	foreach ($tbbranch as $value) {
		echo "<tr class='info'>";
		echo "<td>$value[branch]</td>";
		echo "<td>$value[salecash]</td>";
		echo "<td>$value[installment]</td>";
		echo "<td>$value[total]</td>";
		echo "</tr>";
	}
	?> 		
			</tbody>
		</table> 
		<div id="chart-container2"></div>
	</div>
	<div id="divbranchbrand" style="width: 800px;">
		<table id="tablebranchbrand" class="table table-hover table-bordered"> 
			<thead>
				<tr class="success">
					<th>สาขา</th>
					<th>ยี่ห้อ</th>
					<th>ขายสด</th>
					<th>ขายผ่อน</th>
					<th>รวม</th>
				</tr>
			</thead>
			<tbody>
	<?php
	foreach ($tbbranchbrand as $value) {
		echo "<tr class='info'>";
		echo "<td>$value[branch]</td>";
		echo "<td>$value[brand]</td>";
		echo "<td>$value[salecash]</td>";
		echo "<td>$value[installment]</td>";
		echo "<td>$value[total]</td>";
		echo "</tr>";
	}
	?> 		
			</tbody>
		</table> 
		<div id="chart-container3"></div>
	</div>
	<?php unset($dbh); unset($stmt);?>
</center>
</body>
</html>
