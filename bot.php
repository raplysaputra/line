<form method="post" action="$PORTAL_ACTION$">
   <input name="auth_user" type="text">
   <input name="auth_pass" type="password">
   <input name="auth_voucher" type="text">
   <input name="redirurl" type="hidden" value="$PORTAL_REDIRURL$">
   <input name="zone" type="hidden" value="$PORTAL_ZONE$">
   <input name="accept" type="submit" value="Continue">
</form>
<?php
function getdatenyear($mes){
	if(stripos($mes, 'มค')){
		if(is_numeric(substr($mes, stripos($mes, 'มค')+6,2)) and strlen(substr($mes, stripos($mes, 'มค')+6,2))==2){
			return "report.ezmember.org:7080/reportfiles/sale_report_01_".(intval(substr($mes, stripos($mes, 'มค')+6,2))-43).".html";
		}else{
			return datefail();
		}			
	}else if(stripos($mes, 'กพ')){
		if(is_numeric(substr($mes, stripos($mes, 'กพ')+6,2)) and strlen(substr($mes, stripos($mes, 'กพ')+6,2))==2){
			return "report.ezmember.org:7080/reportfiles/sale_report_02_".(intval(substr($mes, stripos($mes, 'กพ')+6,2))-43).".html";
		}else{
			return datefail();
		}			
	}else if(stripos($mes, 'มีค')){
		if(is_numeric(substr($mes, stripos($mes, 'มีค')+9,2)) and strlen(substr($mes, stripos($mes, 'มีค')+9,2))==2){
			return "report.ezmember.org:7080/reportfiles/sale_report_03_".(intval(substr($mes, stripos($mes, 'มีค')+9,2))-43).".html";
		}else{
			return datefail();
		}			
	}else if(stripos($mes, 'เมย')){
		if(is_numeric(substr($mes, stripos($mes, 'เมย')+9,2)) and strlen(substr($mes, stripos($mes, 'เมย')+9,2))==2){
			return "report.ezmember.org:7080/reportfiles/sale_report_04_".(intval(substr($mes, stripos($mes, 'เมย')+9,2))-43).".html";
		}else{
			return datefail();
		}			
	}else if(stripos($mes, 'พค')){
		if(is_numeric(substr($mes, stripos($mes, 'พค')+6,2)) and strlen(substr($mes, stripos($mes, 'พค')+6,2))==2){
			return "report.ezmember.org:7080/reportfiles/sale_report_05_".(intval(substr($mes, stripos($mes, 'พค')+6,2))-43).".html";
		}else{
			return datefail();
		}			
	}else if(stripos($mes, 'มิย')){
		if(is_numeric(substr($mes, stripos($mes, 'มิย')+9,2)) and strlen(substr($mes, stripos($mes, 'มิย')+9,2))==2){
			return "report.ezmember.org:7080/reportfiles/sale_report_06_".(intval(substr($mes, stripos($mes, 'มิย')+9,2))-43).".html";
		}else{
			return datefail();
		}			
	}else if(stripos($mes, 'กค')){
		if(is_numeric(substr($mes, stripos($mes, 'กค')+6,2)) and strlen(substr($mes, stripos($mes, 'กค')+6,2))==2){
			return "report.ezmember.org:7080/reportfiles/sale_report_07_".(intval(substr($mes, stripos($mes, 'กค')+6,2))-43).".html";
		}else{
			return datefail();
		}			
	}else if(stripos($mes, 'สค')){
		if(is_numeric(substr($mes, stripos($mes, 'สค')+6,2)) and strlen(substr($mes, stripos($mes, 'สค')+6,2))==2){
			return "report.ezmember.org:7080/reportfiles/sale_report_08_".(intval(substr($mes, stripos($mes, 'สค')+6,2))-43).".html";
		}else{
			return datefail();
		}			
	}else if(stripos($mes, 'กย')){
		if(is_numeric(substr($mes, stripos($mes, 'กย')+6,2)) and strlen(substr($mes, stripos($mes, 'กย')+6,2))==2){
			return "report.ezmember.org:7080/reportfiles/sale_report_09_".(intval(substr($mes, stripos($mes, 'กย')+6,2))-43).".html";
		}else{
			return datefail();
		}			
	}else if(stripos($mes, 'ตค')){
		if(is_numeric(substr($mes, stripos($mes, 'ตค')+6,2)) and strlen(substr($mes, stripos($mes, 'ตค')+6,2))==2){
			return "report.ezmember.org:7080/reportfiles/sale_report_10_".(intval(substr($mes, stripos($mes, 'ตค')+6,2))-43).".html";
		}else{
			return datefail();
		}			
	}else if(stripos($mes, 'พย')){
		if(is_numeric(substr($mes, stripos($mes, 'พย')+6,2)) and strlen(substr($mes, stripos($mes, 'พย')+6,2))==2){
			return "report.ezmember.org:7080/reportfiles/sale_report_11_".(intval(substr($mes, stripos($mes, 'พย')+6,2))-43).".html";
		}else{
			return datefail();
		}			
	}else if(stripos($mes, 'ธค')){
		if(is_numeric(substr($mes, stripos($mes, 'ธค')+6,2)) and strlen(substr($mes, stripos($mes, 'ธค')+6,2))==2){
			return "report.ezmember.org:7080/reportfiles/sale_report_12_".(intval(substr($mes, stripos($mes, 'ธค')+6,2))-43).".html";
		}else{
			return datefail();
		}			
	}
	return info();
}
function info(){
	return "report.ezmember.org:7080\nตัวอย่างคำขอ\n'ขอรายงานมค59'\nเดือนที่รองรับ: มค,กพ,มีค,เมย,พค,มิย,กค,สค,กย,ตค,พย,ธค";
}
function datefail(){
	return "โปรดระบุปี เช่น มค59";
}
$access_token = 'KKTDf1y+hn0XlTc/dwdnTGW3lM1iNlae4bgksk/7JLLBJo8rTZmPN5jmlCnfSQh4C9egi4Wq0pO5jx1OieL3Oph6NsrS2rnO3Frl/C5RHBP85LQmJLKAzf7fcvZoeMlufycfb5PSM0cbYpWLnWkG4wdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			$user=$event['source']['userId'];
			// Build message to reply back
			if($event['message']['text']=="google"||$event['message']['text']=="กูเกิล"){
				$messages = [
					'type' => 'text',
					'text' => $user."\nwww.google.co.th"
				];		
			}else if($event['message']['text']=="facebook"||$event['message']['text']=="เฟส"||$event['message']['text']=="fb"||$event['message']['text']=="เฟบุ๊ค"){
				$messages = [
					'type' => 'text',
					'text' => $user."\nwww.facebook.com"
				];
			}else if(stripos($text, "ขอรายงาน") !== false){
				$messages = [
					'type' => 'text',
					'text' => getdatenyear($text)
					//'text' => "sheltered-plateau-71817.herokuapp.com/reporttest.htm"
				];
			}else{
				/*$messages = [
					'type' => 'text',
					'text' => $user."\nคุณส่งคำว่า : ".$text
				];*/
				$messages = [
					'type' => 'text',
					'text' => "นี่คือระบบขอรายงาน เลิอกดูได้ที่\n".info()
				];
			}

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
?>
