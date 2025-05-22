<?php
header('Content-type:application/json');

$act = $_GET['action'];
$sum = $_GET['amount'];
$id = $_GET['id'];
$my_card = $_GET['card'];
$back = $_GET['back'];
$desc = $_GET['description'];
$parol = $_GET['parol'];
$parol2 = file_get_contents("parol.txt");

if($parol == $parol2){
if(($act == "create")){
$headers = array(
'device: 6Fk1rB;',
'user-agent: Mozilla/57.36',
    );
    
$sum1 = $sum*100;

$curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, 'https://payme.uz/api/p2p.create');
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($curl, CURLOPT_HEADER, false);                                                         
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($curl, CURLOPT_POSTFIELDS, '{"method":"p2p.create","params":{"card_id":"'.$my_card.'","amount":'.$sum1.',"description":"'.$desc.'"}}');
$res = json_decode(curl_exec($curl), true);
$csv['_id']=$res[result][cheque][_id];
$csv['_url']="https://checkout.paycom.uz";
$csv['_pay_amount']=$sum." UZS";
$csv['_pay_url']="https://checkout.paycom.uz/".$res[result][cheque][_id];
$ec['_details']=$csv;
$ec2['_result']=$ec;
echo json_encode($ec2,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
exit();
}



if($act == "info"){
$curl = curl_init();
      curl_setopt($curl, CURLOPT_URL, 'https://payme.uz/api/cheque.get');
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, '{"method":"cheque.get","params":{"id":"'.$id.'"}}');
$res = json_decode(curl_exec($curl),true);
$ok = $res['result']['cheque']['pay_time'];
$ec['mess']=$ok;
echo json_encode($ec,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);  
exit();
}
}