<form method="post" action="$PORTAL_ACTION$">
   <input name="auth_user" type="text">
   <input name="auth_pass" type="password">
   <input name="auth_voucher" type="text">
   <input name="redirurl" type="hidden" value="$PORTAL_REDIRURL$">
   <input name="zone" type="hidden" value="$PORTAL_ZONE$">
   <input name="accept" type="submit" value="Continue">
</form>
<?php
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
			}else if($event['message']['text']=="ขอรายงาน"){
				$messages = [
					'type' => 'text',
					'text' => "msu.ezmember.org:7080/report/";
					//'text' => "sheltered-plateau-71817.herokuapp.com/reporttest.htm"
				];
			}else{
				$messages = [
					'type' => 'text',
					'text' => $user."\nคุณส่งคำว่า : ".$text
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
