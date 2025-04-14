<?
ini_set("include_path", '/home1/drtylka/php:' . ini_get("include_path") );
require_once "Mail.php";
require_once "Mail/mime.php";

if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
    <?php
    ini_set("include_path", '/home1/drtylka/php:' . ini_get("include_path"));
    require_once "Mail.php";
    require_once "Mail/mime.php";

    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
        $name = strip_tags($_POST['name']);
        $email = strip_tags($_POST['email']);
        $message = strip_tags($_POST['message']);
        $to = "drtylka@drtylka.com";

        // Send from email details
        $from = "no-reply@drtylka.com";
        $host = "ssl://mail.drtylka.com";
        $username = "no-reply@drtylka.com";
        $password = "2jRrDdN@QU84";
        $port = "465";

        // Setting up email to send
        $subject = "Dr. Tylka || Contact";
        $headers = array('From' => $from, 'To' => $to, 'Subject' => $subject, 'Reply-To' => $to);
        $smtp = Mail::factory('smtp', array('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        $body = '<!DOCTYPE html>
    <html>
    <body>
    <p><strong>Name:</strong> ' . $name . '</p>
    <p><strong>Contact Email:</strong> ' . $email . '</p>
    <p><strong>Message:</strong> ' . $message . '</p>
    </body>
    </html>';

        $mime = new Mail_mime();
        $mime->setHTMLBody($body);
        $body = $mime->get();
        $headers = $mime->headers($headers);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response = new stdClass(); // Initialize $response as an object
            $response->type = 'error';
            $response->text = 'Email is invalid!';
            $return = json_encode($response);
            die($return);
        } else {
            // Sending email
            $mail = $smtp->send($to, $headers, $body);

            // Check for errors when sending email
            $response = new stdClass(); // Initialize $response as an object
            if (PEAR::isError($mail)) {
                $response->type = 'error';
                $response->text = "Email failed to send! <p>" . $mail->getMessage() . "</p>";
            } else {
                $response->type = 'message';
                $response->text = 'Email has been sent!';
            }

            // Encode object as JSON and return
            $return = json_encode($response);
            die($return);
        }
    } else if ((isset($_POST['name']) || isset($_POST['email']) || isset($_POST['message'])) && (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message']))) {
        $response = new stdClass(); // Initialize $response as an object
        $response->type = 'error';
        $response->text = 'Please fill out all fields!';
        $return = json_encode($response);
        die($return);
    }
    ?>
	$name = strip_tags($_POST['name']);
	$email = strip_tags($_POST['email']);
	$message = strip_tags($_POST['message']);
	$to = "drtylka@drtylka.com";
	
	// Send from email details
	$from = "no-reply@drtylka.com";
	$host = "ssl://mail.drtylka.com";
	$username = "no-reply@drtylka.com";
	$password = "2jRrDdN@QU84";
	$port = "465";
	
	// Setting up email to send
	$subject = "Dr. Tylka || Contact";
	$headers = array ('From' => $from, 'To' => $to, 'Subject' => $subject, 'Reply-To' => $to);
	$smtp = Mail::factory('smtp', array ('host' => $host, 'port' => $port, 'auth' => true, 'username' => $username, 'password' => $password));
	
	$email = filter_var($email, FILTER_SANITIZE_EMAIL);	
	// $body = 'This message was automatically generated via the Dr. Tylka website at http://www.drtylka.com</br>
			// </br>
			// <span style=\"color: red\">Message Content:</span>
			// Name: $name </br>
			// Contact Email: $email </br>
			// Message: $message";
			
	$body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="width:100%;font-family:"Open Sans", sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0">
 <head> 
  <meta charset="UTF-8"> 
  <meta content="width=device-width, initial-scale=1" name="viewport"> 
  <meta name="x-apple-disable-message-reformatting"> 
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta content="telephone=no" name="format-detection"> 
  <title>New email template 2020-07-24</title> 
  <!--[if (mso 16)]>
    <style type="text/css">
    a {text-decoration: none;}
    </style>
    <![endif]--> 
  <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> 
  <!--[if !mso]><!-- --> 
  <link href="https://fonts.googleapis.com/css?family=Oswald:300,700&display=swap" rel="stylesheet"> 
  <!--<![endif]--> 
  <!--[if gte mso 9]>
<xml>
    <o:OfficeDocumentSettings>
    <o:AllowPNG></o:AllowPNG>
    <o:PixelsPerInch>96</o:PixelsPerInch>
    </o:OfficeDocumentSettings>
</xml>
<![endif]--> 
  <!--[if !mso]><!-- --> 
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i" rel="stylesheet"> 
  <!--<![endif]--> 
  <style type="text/css">
@media only screen and (max-width:600px) {p, ul li, ol li, a { font-size:14px!important; line-height:150%!important } h1 { font-size:28px!important; text-align:left; line-height:120% } h2 { font-size:20px!important; text-align:left; line-height:120% } h3 { font-size:14px!important; text-align:left; line-height:120% } h1 a { font-size:28px!important; text-align:left } h2 a { font-size:20px!important; text-align:left } h3 a { font-size:14px!important; text-align:left } .es-menu td a { font-size:14px!important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size:14px!important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size:14px!important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size:14px!important } *[class="gmail-fix"] { display:none!important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align:center!important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align:right!important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align:left!important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display:inline!important } .es-button-border { display:block!important } a.es-button { font-size:14px!important; display:block!important; border-bottom-width:20px!important; border-right-width:0px!important; border-left-width:0px!important; border-top-width:20px!important } .es-btn-fw { border-width:10px 0px!important; text-align:center!important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width:100%!important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width:100%!important; max-width:600px!important } .es-adapt-td { display:block!important; width:100%!important } .adapt-img { width:100%!important; height:auto!important } .es-m-p0 { padding:0px!important } .es-m-p0r { padding-right:0px!important } .es-m-p0l { padding-left:0px!important } .es-m-p0t { padding-top:0px!important } .es-m-p0b { padding-bottom:0!important } .es-m-p20b { padding-bottom:20px!important } .es-mobile-hidden, .es-hidden { display:none!important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { display:table-row!important; width:auto!important; overflow:visible!important; float:none!important; max-height:inherit!important; line-height:inherit!important } .es-desk-menu-hidden { display:table-cell!important } table.es-table-not-adapt, .esd-block-html table { width:auto!important } table.es-social { display:inline-block!important } table.es-social td { display:inline-block!important } }
#outlook a {
	padding:0;
}
.ExternalClass {
	width:100%;
}
.ExternalClass,
.ExternalClass p,
.ExternalClass span,
.ExternalClass font,
.ExternalClass td,
.ExternalClass div {
	line-height:100%;
}
.es-button {
	mso-style-priority:100!important;
	text-decoration:none!important;
}
a[x-apple-data-detectors] {
	color:inherit!important;
	text-decoration:none!important;
	font-size:inherit!important;
	font-family:inherit!important;
	font-weight:inherit!important;
	line-height:inherit!important;
}
.es-desk-hidden {
	display:none;
	float:left;
	overflow:hidden;
	width:0;
	max-height:0;
	line-height:0;
	mso-hide:all;
}
</style> 
 </head> 
 <body style="width:100%;font-family:"Open Sans", sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0"> 
  <div class="es-wrapper-color" style="background-color:#F5F5F5"> 
   <!--[if gte mso 9]>
			<v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t">
				<v:fill type="tile" color="#f5f5f5"></v:fill>
			</v:background>
		<![endif]--> 
   <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top"> 
     <tr style="border-collapse:collapse"> 
      <td valign="top" style="padding:0;Margin:0"> 
       <table class="es-content" cellspacing="0" cellpadding="0" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"> 
         <tr style="border-collapse:collapse"> 
          <td align="center" bgcolor="transparent" style="padding:0;Margin:0;background-color:transparent"> 
           <table class="es-content-body" cellspacing="0" cellpadding="0" bgcolor="#f5f5f5" align="center" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#F5F5F5;width:600px"> 
             <tr style="border-collapse:collapse"> 
              <td align="left" bgcolor="#efefef" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;background-color:#EFEFEF"> 
               <table cellpadding="0" cellspacing="0" width="100%" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                 <tr style="border-collapse:collapse"> 
                  <td align="center" valign="top" style="padding:0;Margin:0;width:560px"> 
                   <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> 
                     <tr style="border-collapse:collapse"> 
                      <td align="left" style="padding:0;Margin:0"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:11px;font-family:"Open Sans", sans-serif;line-height:17px;color:#262626"><em>This message was automatically generated via the Dr. Tylka website at http://www.drtylka.com</em></p></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="left" style="padding:0;Margin:0;padding-top:20px"><h3 style="Margin:0;line-height:17px;mso-line-height-rule:exactly;font-family:Oswald, sans-serif;font-size:14px;font-style:normal;font-weight:bold;color:#888888;letter-spacing:0px">Message Content:</h3></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="left" class="es-m-txt-l" style="padding:0;Margin:0;padding-top:10px"><p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-size:14px;font-family:"Open Sans", sans-serif;line-height:21px;color:#262626">
					  <strong>Name:</strong>&nbsp;' . $name . '<br>
					  <strong>Contact Email:</strong>&nbsp;' . $email . '<br>
					  <strong>Message:</strong>&nbsp;' . $message . '</p></td> 
                     </tr> 
                   </table></td> 
                 </tr> 
               </table></td> 
             </tr> 
           </table></td> 
         </tr> 
       </table></td> 
     </tr> 
   </table> 
  </div>  
 </body>
</html>';

	$mime = new Mail_mime();
	$mime->setHTMLBody($body);
	$body = $mime->get();
	$headers = $mime->headers($headers);	

	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		@$response->type ='error';
		@$response->text = 'Email is invalid!';
		@$return = json_encode($response);
		die($return);
	}
	else {		
		// Sending email
		$mail = $smtp->send($to, $headers, $body);
		
		// Check for errors when sending email
		if (PEAR::isError($mail)) {
			@$response->type ='error';
			@$response->text = "Email failed to send! <p>" . $mail->getMessage() . "</p>";			
		} else {
			@$response->type ='message';
			@$response->text = 'Email has been sent!';
		}
		
		// Encode object as json and return
		@$return = json_encode($response);
		die($return);
	}
}
else if((isset($_POST['name']) || isset($_POST['email']) || isset($_POST['message'])) && (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message']))) {
	@$response->type ='error';
	@$response->text = 'Please fill out all fields!';
	@$return = json_encode($response);
	@die($return);
}
?>