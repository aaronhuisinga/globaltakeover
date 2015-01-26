<?php
$sandbox = isset($_POST['test_ipn']) ? true : false;
$ssl = $sandbox ? false : false;
$ppHost = $sandbox ? 'www.sandbox.paypal.com' : 'www.paypal.com';

// read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';

// Store each $_POST value in a NVP string: 1 string encoded and 1 string decoded
$IPNDecoded = '';
foreach ($_POST as $key => $value)
{
$value = urlencode(stripslashes($value));
$req .= "&$key=$value";
$IPNDecoded .= $key . " = " . urldecode($value) ."<br /><br />";
}

// post back to PayPal system to validate using SSL or not based on flag set above.
if($ssl)
{
$header = '';
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Host: " . $ppHost . ":443\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ('ssl://' . $ppHost, 443, $errno, $errstr, 30);
}
else
{
$header = '';
$header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
$header .= "Host: " . $ppHost . ":80\r\n";
$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
$header .= "Content-Length: " . strlen($req) . "\r\n\r\n";
$fp = fsockopen ($ppHost, 80, $errno, $errstr, 30);
}

if (!$fp)
{
$IsValid = false;
}
else
{
// Response from PayPal was good.  Now check to see if it returned verified or invalid.  Simply set $IsValud to true/false accordingly.
fputs ($fp, $header . $req);
while(!feof($fp))
{
$res = fgets ($fp, 1024);
if(strcmp ($res, "VERIFIED") == 0)
$IsValid = true;
elseif (strcmp ($res, "INVALID") == 0)
$IsValid = false;
}
fclose ($fp);
}

// Buyer Information
$address_city = isset($_POST['address_city']) ? $_POST['address_city'] : '';
$address_country = isset($_POST['address_country']) ? $_POST['address_country'] : '';
$address_country_code = isset($_POST['address_country_code']) ? $_POST['address_country_code'] : '';
$address_name = isset($_POST['address_name']) ? $_POST['address_name'] : '';
$address_state = isset($_POST['address_state']) ? $_POST['address_state'] : '';
$address_status = isset($_POST['address_status']) ? $_POST['address_status'] : '';
$address_street = isset($_POST['address_street']) ? $_POST['address_street'] : '';
$address_zip = isset($_POST['address_zip']) ? $_POST['address_zip'] : '';
$first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
$last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
$payer_business_name = isset($_POST['payer_business_name']) ? $_POST['payer_business_name'] : '';
$payer_email = isset($_POST['payer_email']) ? $_POST['payer_email'] : '';
$payer_id = isset($_POST['payer_id']) ? $_POST['payer_id'] : '';
$payer_status = isset($_POST['payer_status']) ? $_POST['payer_status'] : '';
$contact_phone = isset($_POST['contact_phone']) ? $_POST['contact_phone'] : '';
$residence_country = isset($_POST['residence_country']) ? $_POST['residence_country'] : '';

// Basic Information
$notify_version = isset($_POST['notify_version']) ? $_POST['notify_version'] : '';
$charset = isset($_POST['charset']) ? $_POST['charset'] : '';
$business = isset($_POST['business']) ? $_POST['business'] : '';
$item_name = isset($_POST['item_name']) ? $_POST['item_name'] : '';
$item_number = isset($_POST['item_number']) ? $_POST['item_number'] : '';
$quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
$receiver_email = isset($_POST['receiver_email']) ? $_POST['receiver_email'] : '';
$receiver_id = isset($_POST['receiver_id']) ? $_POST['receiver_id'] : '';

// Cart Items
$num_cart_items = isset($_POST['num_cart_items']) ? $_POST['num_cart_items'] : '';

$i = 1;
$cart_items = array();
while(isset($_POST['item_number' . $i]))
{
$item_number = isset($_POST['item_number' . $i]) ? $_POST['item_number' . $i] : '';
$item_name = isset($_POST['item_name' . $i]) ? $_POST['item_name' . $i] : '';
$quantity = isset($_POST['quantity' . $i]) ? $_POST['quantity' . $i] : '';
$mc_gross = isset($_POST['mc_gross_' . $i]) ? $_POST['mc_gross_' . $i] : '';
$mc_handling = isset($_POST['mc_handling' . $i]) ? $_POST['mc_handling' . $i] : '';
$mc_shipping = isset($_POST['mc_shipping' . $i]) ? $_POST['mc_shipping' . $i] : '';
$custom = isset($_POST['custom' . $i]) ? $_POST['custom' . $i] : '';
$option_name1 = isset($_POST['option_name0_' . $i]) ? $_POST['option_name0_' . $i] : '';
$option_selection1 = isset($_POST['option_selection0_' . $i]) ? $_POST['option_selection0_' . $i] : '';
$option_name1 = isset($_POST['option_name1_' . $i]) ? $_POST['option_name1_' . $i] : '';
$option_selection1 = isset($_POST['option_selection1_' . $i]) ? $_POST['option_selection1_' . $i] : '';
$option_name2 = isset($_POST['option_name2_' . $i]) ? $_POST['option_name2_' . $i] : '';
$option_selection2 = isset($_POST['option_selection2_' . $i]) ? $_POST['option_selection2_' . $i] : '';

$current_item = array(
'item_number' => $item_number,
'item_name' => $item_name,
'quantity' => $quantity,
'mc_gross' => $mc_gross,
'mc_handling' => $mc_handling,
'mc_shipping' => $mc_shipping,
'custom' => $custom,
'option_name0' => $option_name0,
'option_selection0' => $option_selection0,
'option_name1' => $option_name1,
'option_selection1' => $option_selection1,
'option_name2' => $option_name2,
'option_selection2' => $option_selection2
);

array_push($cart_items, $current_item);
$i++;
}

// Advanced and Custom Information
$custom = isset($_POST['custom']) ? $_POST['custom'] : '';
$invoice = isset($_POST['invoice']) ? $_POST['invoice'] : '';
$memo = isset($_POST['memo']) ? $_POST['memo'] : '';
$option_name1 = isset($_POST['option_name1']) ? $_POST['option_name1'] : '';
$option_selection1 = isset($_POST['option_selection1']) ? $_POST['option_selection1'] : '';
$option_name2 = isset($_POST['option_name2']) ? $_POST['option_name2'] : '';
$option_selection2 = isset($_POST['option_selection2']) ? $_POST['option_selection2'] : '';
$tax = isset($_POST['tax']) ? $_POST['tax'] : '';

// Website Payments Standard, Website Payments Pro, and Refund Information
$auth_id = isset($_POST['auth_id']) ? $_POST['auth_id'] : '';
$auth_exp = isset($_POST['auth_exp']) ? $_POST['auth_exp'] : '';
$auth_amount = isset($_POST['auth_amount']) ? $_POST['auth_amount'] : '';
$auth_status = isset($_POST['auth_status']) ? $_POST['auth_status'] : '';

// Fraud Management Filters
$i = 1;
$fraud_management_filters = array();
while(isset($_POST['fraud_management_filters_' . $i]))
{
$filter_name = isset($_POST['fraud_management_filter_' . $i]) ? $_POST['fraud_management_filter_' . $i] : '';

array_push($fraud_management_filters, $filter_name);
$i++;
}

$mc_gross = isset($_POST['mc_gross']) ? $_POST['mc_gross'] : '';
$mc_handling = isset($_POST['mc_handling']) ? $_POST['mc_handling'] : '';
$mc_shipping = isset($_POST['mc_shipping']) ? $_POST['mc_shipping'] : '';
$mc_fee = isset($_POST['mc_fee']) ? $_POST['mc_fee'] : '';
$num_cart_items = isset($_POST['num_cart_items']) ? $_POST['num_cart_items'] : '';
$parent_txn_id = isset($_POST['parent_txn_id']) ? $_POST['parent_txn_id'] : '';
$payment_date = isset($_POST['payment_date']) ? $_POST['payment_date'] : '';
$payment_status = isset($_POST['payment_status']) ? $_POST['payment_status'] : '';
$payment_type = isset($_POST['payment_type']) ? $_POST['payment_type'] : '';
$pending_reason = isset($_POST['pending_reason']) ? $_POST['pending_reason'] : '';
$protection_eligibility  = isset($_POST['protection_eligibility']) ? $_POST['protection_eligibility'] : '';
$reason_code = isset($_POST['reason_code']) ? $_POST['reason_code'] : '';
$remaining_settle = isset($_POST['remaining_settle']) ? $_POST['remaining_settle'] : '';
$shipping_method = isset($_POST['shipping_method']) ? $_POST['shipping_method'] : '';
$shipping = isset($_POST['shipping']) ? $_POST['shipping'] : '';
$tax = isset($_POST['tax']) ? $_POST['tax'] : '';
$transaction_entity = isset($_POST['transaction_entity']) ? $_POST['transaction_entity'] : '';
$txn_id = isset($_POST['txn_id']) ? $_POST['txn_id'] : '';
$txn_type = isset($_POST['txn_type']) ? $_POST['txn_type'] : '';
// Currency and Currency Exchange Information
$exchange_rate = isset($_POST['exchange_rate']) ? $_POST['exchange_rate'] : '';
$mc_currency = isset($_POST['mc_currency']) ? $_POST['mc_currency'] : '';
$settle_amount = isset($_POST['settle_amount']) ? $_POST['settle_amount'] : '';
$settle_currency = isset($_POST['settle_currency']) ? $_POST['settle_currency'] : '';

// Auction Variables
$auction_buyer_id = isset($_POST['auction_buyer_id']) ? $_POST['auction_buyer_id'] : '';
$auction_closing_date = isset($_POST['auction_closing_date']) ? $_POST['auction_closing_date'] : '';
$auction_multi_item = isset($_POST['auction_multi_item']) ? $_POST['auction_multi_item'] : '';
$for_auction = isset($_POST['for_auction']) ? $_POST['for_auction'] : '';

// Mass Payments
$i = 1;
$mass_payments = array();
while(isset($_POST['masspay_txn_id_' . $i]))
{
$masspay_txn_id = isset($_POST['masspay_txn_id_' . $i]) ? $_POST['masspay_txn_id_' . $i] : '';
$mc_currency = isset($_POST['mc_currency_' . $i]) ? $_POST['mc_currency_' . $i] : '';
$mc_fee = isset($_POST['mc_fee_' . $i]) ? $_POST['mc_fee_' . $i] : '';
$mc_gross = isset($_POST['mc_gross_' . $i]) ? $_POST['mc_gross_' . $i] : '';
$receiver_email = isset($_POST['receiver_email_' . $i]) ? $_POST['receiver_email_' . $i] : '';
$status = isset($_POST['status_' . $i]) ? $_POST['status_' . $i] : '';
$unique_id = isset($_POST['unique_id_' . $i]) ? $_POST['unique_id_' . $i] : '';

$current_payment_data_set = array(
'masspay_txn_id' => $masspay_txn_id,
'mc_currency' => $mc_currency,
'mc_fee' => $mc_fee,
'mc_gross' => $mc_gross,
'receiver_email' => $receiver_email,
'status' => $status,
'unique_id' => $unique_id
);

array_push($mass_payments, $current_payment_data_set);
$i++;
}

// Dispute Notification Variables
$case_id = isset($_POST['case_id']) ? $_POST['case_id'] : '';
$case_type = isset($_POST['case_type']) ? $_POST['case_type'] : '';
$case_creation_date = isset($_POST['case_creation_date']) ? $_POST['case_creation_date'] : '';

// Gather information and send a message
require_once("members/config.php");
$mysqli->query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('Tokens Purchased', '$custom purchased $item_name Tokens through Paypal.', '1', 'Global Takeover', 'unread', NOW())");

$res=$mysqli->query("SELECT `id` FROM `Players` WHERE `username`='$custom' LIMIT 1");
$uid=$res->fetch_array();
if ($item_name >= 200) {
	$mysqli->query("UPDATE Players SET tokens=(tokens+$item_name), donor='1' WHERE username='$custom' LIMIT 1;");
	$message="Thank you for your purchase of $item_name Tokens! The $item_name Tokens have been added to your account! You have also been given VIP status!";
} else {
	$mysqli->query("UPDATE Players SET tokens=(tokens+$item_name) WHERE username='$custom' LIMIT 1;");
	$message="Thank you for your purchase of $item_name Tokens! The $item_name Tokens have been added to your account!";
}
$mysqli->query("INSERT INTO `pmessages` ( `title` , `message` , `touser` , `from` , `unread` , `date` ) VALUES ('Tokens Awarded', '$message', '$uid[0]', 'Global Takeover', 'unread', NOW())");
?>