<?php
error_reporting(-1);
ini_set('display_errors', 'On');

// multiple recipients
//$to  = 'OHDAnalytics@umich.edu';
$to = 'mrschlei@umich.edu';
//. ', '; // note the comma
//$to .= 'wez@example.com';

// subject
$subject = 'Birthday Reminders for April';

// message
$message = '
<html>
<head>
  <title>Birthday Reminders for April</title>
</head>
<body>
  <p>Here are the birthdays upcoming in April!</p>
  <table>
    <tr>
      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
    </tr>
    <tr>
      <td>Joe</td><td>3rd</td><td>April</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17th</td><td>April</td><td>1973</td>
    </tr>
  </table>
<p>https://fleming.bf.umich.edu/occupant3.php</p>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers = "MIME-Version: 1.0" . "\n";
$headers .= "Content-type: text/html; charset=\"iso-8859-1\"" . "\n";

// Additional headers
//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\n";
$headers .= "From: 'Birthday Reminder' <birthday@example.com>" . "\n";
//$headers .= 'Cc: birthdayarchive@example.com' . "\n";
//$headers .= 'Bcc: birthdaycheck@example.com' . "\n";

// Mail it
mail($to, $subject, $message, $headers);
?>