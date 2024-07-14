<?php 
$receiverMail = "care@pickyourcraft.in"; 
$templateId = 1;        // id of email template
$storeId = 1;           // desired store id
$templateParams = [];   // params of template by array
$organization = $_POST["organization"];
$person = $_POST["person"];
$address = $_POST["address"];
$email = $_POST["email"];
$tel = $_POST["tel"];
$product_name = $_POST["product_name"];
$code = $_POST["code"];
$details = $_POST["details"];
/*echo $organization;
echo $person;
echo $address;
echo $email;
echo $tel;
echo $product_name;
echo $code;
echo $details;
exit;*/
//$html = "Name: ".$name."Email: ".$email."Telephone: ".$telephone."Comment: ".$comment;
$html ='<div class="conmail_table">
<table width="100%" border="0">
	<tr>
		<td>Organization :</td>
		<td>'.$organization.'</td>
	</tr>
	<tr>
		<td>Person :</td>
		<td>'.$person.'</td>
	</tr>
	<tr>
		<td>Address :</td>
		<td>'.$address.'</td>
	</tr>
	<tr>
		<td>Email :</td>
		<td>'.$email.'</td>
	</tr>
	<tr>
		<td>Contact Number :</td>
		<td>'.$tel.'</td>
	</tr>
	<tr>
		<td>Product Name :</td>
		<td>'.$product_name.'</td>
	</tr>
	<tr>
		<td>Code :</td>
		<td>'.$code.'</td>
	</tr>
	<tr>
		<td>Order details :</td>
		<td>'.$details.'</td>
	</tr>
			</table>
			</div>
			</body>    
			';
$headers =  'From: quality-web-developer.com' . "\r\n" .
                    'Reply-To: care@pickyourcraft.in' . "\r\n" .
                    "Content-type:text/html;charset=UTF-8" . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

//php mail 
mail($receiverMail, "Contact us for bulk order. ", $html, $headers);

header("Location: http://quality-web-developer.com/pickyourCraftNew/thank-you");
exit;
?>
<script>
//window.location.replace("http://quality-web-developer.com/pickyourCraftNew/");
</script>