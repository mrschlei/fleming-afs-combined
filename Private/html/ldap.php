<?php        

//Grab the username off the server
$user = $_SERVER['REMOTE_USER'];

//The LDAP module has conflicts with the oracle module, so you'll need to load it specifically.
if ( !extension_loaded( 'ldap' )) {
  if ( !dl( 'ldap.so' )) {
      exit( 'Cannot load ldap extension.' );
  }



$ldaphost = "ldap.itd.umich.edu";  // your ldap servers
$ldapport = 389;                 // your ldap server's port number

// Connecting to LDAP
$ldapconn = ldap_connect($ldaphost, $ldapport)
          or die("Could not connect to $ldaphost");

if ($ldapconn) {
    // binding to ldap server anonymously --- MAY NEED CREDENTIALS LATER
    $ldapbind = ldap_bind($ldapconn);

    // verify binding
    if ($ldapbind) {
        //echo "<span id='ldap'>LDAP bind successful!!</span><p>";

//just ripped from directory.umich.edu results URLs - no real documentation on this, sadly
			$dn = "ou=People,dc=umich,dc=edu";

//ldap_search is pretty sweet - here we're just looking for the user's uniqname, but we could do
//something like, looking for all users by saying uid=*
			$result = ldap_search($ldapconn, $dn, "(uid=".$user.")");


//Assuming uniqnames are actually unique to people, the first result should be the only one
//so this might not be necessary, but I wanted to make sure I'm only grabbing one profile
//instead of, like, 5 million, if something breaks.
$entry = ldap_first_entry($ldapconn, $result);

//http://us2.php.net/manual/en/function.ldap-get-attributes.php
$attrs = ldap_get_attributes($ldapconn, $entry);

//Form variables...
$name = $attrs["displayName"][0];
$phone = $attrs["telephoneNumber"][0];
$title = $attrs["title"][0];


//echo "<span id='hello'>Hello,</span><h2>".$attrs["displayName"][0]."</h2>";

//echo "<span id='count'>" . $attrs["count"] . "</span> attributes held for this entry:<p>";


}

}

}

?>