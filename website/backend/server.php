<?php
require_once "lib/Keccak/Keccak.php";
require_once "lib/Elliptic/EC.php";
require_once "lib/Elliptic/Curves.php";
require_once "lib/JWT/jwt.php";
$GLOBALS['JWT_secret'] = '4Eac8AS2cw84easd65araADX';

use Elliptic\EC;
use kornrunner\Keccak;

require_once('config.php');

$data = json_decode(file_get_contents("php://input"));
$request = $data->request;

// Create a standard of eth address by lowercasing them
// Some wallets send address with upper and lower case characters
if (!empty($data->address)) {
  $data->address = strtolower($data->address);
}

if ($request == "login") {
  $address = $data->address;


  // Prepared statement to protect against SQL injections
  $stmt = $conn->prepare("SELECT nonce FROM $tablename WHERE address = ?");
  $stmt->bindParam(1, $address);
  $stmt->execute();
  $nonce = $stmt->fetchColumn();

  if ($nonce) {
    // If user exists, return message to sign
    echo("Sign this message to validate that you are the owner of the account. Unique nonce: " . $nonce);
  }
  else {
    // If user doesn't exist, register new user with generated nonce, then return message to sign
    $nonce = uniqid();

    // Prepared statement to protect against SQL injections
    $stmt = $conn->prepare("INSERT INTO $tablename (address, nonce) VALUES (?, ?)");
    $stmt->bindParam(1, $address);
    $stmt->bindParam(2, $nonce);


    if ($stmt->execute() === TRUE) {
      echo ("Sign this message to validate that you are the owner of the account. Unique nonce: " . $nonce);
    } else {
      echo "Error" . $stmt->error;
    }

    $conn = null;
  }

  exit;
}

if ($request == "auth") {
  $address = $data->address;
  $signature = $data->signature;

  // Prepared statement to protect against SQL injections
  if($stmt = $conn->prepare("SELECT nonce FROM $tablename WHERE address = ?")) {
    $stmt->bindParam(1, $address);
    $stmt->execute();
    $nonce = $stmt->fetchColumn();

    $message = "Sign this message to validate that you are the owner of the account. Unique nonce: " . $nonce;
  }

  // Check if the message was signed with the same private key to which the public address belongs
  function pubKeyToAddress($pubkey) {
    return "0x" . substr(Keccak::hash(substr(hex2bin($pubkey->encode("hex")), 1), 256), 24);
  }

  function verifySignature($message, $signature, $address) {
    $msglen = strlen($message);
    $hash   = Keccak::hash("\x19Ethereum Signed Message:\n{$msglen}{$message}", 256);
    $sign   = ["r" => substr($signature, 2, 64),
               "s" => substr($signature, 66, 64)];
    $recid  = ord(hex2bin(substr($signature, 130, 2))) - 27;
    if ($recid != ($recid & 1))
        return false;

    $ec = new EC('secp256k1');
    $pubkey = $ec->recoverPubKey($hash, $sign, $recid);

    return $address == pubKeyToAddress($pubkey);
  }

  // If verification passed, authenticate user
  if (verifySignature($message, $signature, $address)) {

    $stmt = $conn->prepare("SELECT publicName FROM $tablename WHERE address = ?");
    $stmt->bindParam(1, $address);
    $stmt->execute();
    $publicName = $stmt->fetchColumn();
    $publicName = htmlspecialchars($publicName, ENT_QUOTES, 'UTF-8');

    $stmt = $conn->prepare("SELECT fullName FROM $tablename WHERE address = ?");
    $stmt->bindParam(1, $address);
    $stmt->execute();
    $fullName = $stmt->fetchColumn();
    $fullName = htmlspecialchars($fullName, ENT_QUOTES, 'UTF-8');

    $stmt = $conn->prepare("SELECT homeAddress FROM $tablename WHERE address = ?");
    $stmt->bindParam(1, $address);
    $stmt->execute();
    $homeAddress = $stmt->fetchColumn();
    $homeAddress = htmlspecialchars($homeAddress, ENT_QUOTES, 'UTF-8');

    $stmt = $conn->prepare("SELECT phoneModel FROM $tablename WHERE address = ?");
    $stmt->bindParam(1, $address);
    $stmt->execute();
    $phoneModel = $stmt->fetchColumn();
    $phoneModel = htmlspecialchars($phoneModel, ENT_QUOTES, 'UTF-8');

    $stmt = $conn->prepare("SELECT email FROM $tablename WHERE address = ?");
    $stmt->bindParam(1, $address);
    $stmt->execute();
    $email = $stmt->fetchColumn();
    $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

    $stmt = $conn->prepare("SELECT phoneNumber FROM $tablename WHERE address = ?");
    $stmt->bindParam(1, $address);
    $stmt->execute();
    $phoneNumber = $stmt->fetchColumn();
    $phoneNumber = htmlspecialchars($phoneNumber, ENT_QUOTES, 'UTF-8');

    $stmt = $conn->prepare("SELECT phonePrice FROM $tablename WHERE address = ?");
    $stmt->bindParam(1, $address);
    $stmt->execute();
    $phoneprice = $stmt->fetchColumn();
    $phoneprice = htmlspecialchars($phoneprice, ENT_QUOTES, 'UTF-8');

    $stmt = $conn->prepare("SELECT premiumPrice FROM $tablename WHERE address = ?");
    $stmt->bindParam(1, $address);
    $stmt->execute();
    $premiumPrice = $stmt->fetchColumn();
    $premiumPrice = htmlspecialchars($premiumPrice, ENT_QUOTES, 'UTF-8');

    $stmt = $conn->prepare("SELECT thief FROM $tablename WHERE address = ?");
    $stmt->bindParam(1, $address);
    $stmt->execute();
    $thief = $stmt->fetchColumn();
    $thief = htmlspecialchars($thief, ENT_QUOTES, 'UTF-8');

    $stmt = $conn->prepare("SELECT payInterval FROM $tablename WHERE address = ?");
    $stmt->bindParam(1, $address);
    $stmt->execute();
    $payInterval = $stmt->fetchColumn();
    $payInterval = htmlspecialchars($payInterval, ENT_QUOTES, 'UTF-8');

    $stmt = $conn->prepare("SELECT phoneAge FROM $tablename WHERE address = ?");
    $stmt->bindParam(1, $address);
    $stmt->execute();
    $phoneAge = $stmt->fetchColumn();
    $phoneAge = htmlspecialchars($phoneAge, ENT_QUOTES, 'UTF-8');

    $stmt = $conn->prepare("SELECT userPaid FROM $tablename WHERE address = ?");
    $stmt->bindParam(1, $address);
    $stmt->execute();
    $userPaid = $stmt->fetchColumn();
    $userPaid = htmlspecialchars($userPaid, ENT_QUOTES, 'UTF-8');



    $stmt = $conn->prepare("SELECT claim_title FROM $claim_table WHERE user_address = ?");
    $stmt->bindParam(1, $address);
    $stmt->execute();
    $claimTitle = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    
    $stmt = $conn->prepare("SELECT claim_content FROM $claim_table WHERE user_address = ?");
    $stmt->bindParam(1, $address);
    $stmt->execute();
    $claimContent = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    
    $stmt = $conn->prepare("SELECT claim_status FROM $claim_table WHERE user_address = ?");
    $stmt->bindParam(1, $address);
    $stmt->execute();
    $claimStatus = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    
    $stmt = $conn->prepare("SELECT claim_date FROM $claim_table WHERE user_address = ?");
    $stmt->bindParam(1, $address);
    $stmt->execute();
    $claimDate = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    $stmt = $conn->prepare("SELECT claim_price FROM $claim_table WHERE user_address = ?");
    $stmt->bindParam(1, $address);
    $stmt->execute();
    $claimPrice = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);




    $stmt = $conn->prepare("SELECT user_address FROM $claim_table");
    $stmt->execute();
    $claimAddressAdmin = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    $stmt = $conn->prepare("SELECT claim_user_name FROM $claim_table");
    $stmt->execute();
    $claimUserNameAdmin = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    $stmt = $conn->prepare("SELECT claim_title FROM $claim_table");
    $stmt->execute();
    $claimTitleAdmin = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    
    $stmt = $conn->prepare("SELECT claim_content FROM $claim_table");
    $stmt->execute();
    $claimContentAdmin = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    
    $stmt = $conn->prepare("SELECT claim_status FROM $claim_table");
    $stmt->execute();
    $claimStatusAdmin = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
    
    $stmt = $conn->prepare("SELECT claim_date FROM $claim_table");
    $stmt->execute();
    $claimDateAdmin = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

        $stmt = $conn->prepare("SELECT claim_price FROM $claim_table");
    $stmt->execute();
    $claimPriceAdmin = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
   


    // Create a new random nonce for the next login
    $nonce = uniqid();
    $sql = "UPDATE $tablename SET nonce = '".$nonce."' WHERE address = '".$address."'";
    $conn->query($sql);

    // Create JWT Token
    $token = array();
    $token['address'] = $address;
    $JWT = JWT::encode($token, $GLOBALS['JWT_secret']);

    
    echo(json_encode(["Success", $publicName, $JWT, $fullName, $homeAddress, $phoneModel, $email, $phoneNumber, $phoneprice, $premiumPrice, $thief, $payInterval, $phoneAge, $userPaid, $claimTitle, $claimContent , $claimStatus, $claimDate,$claimAddressAdmin,$claimUserNameAdmin, $claimTitleAdmin, $claimContentAdmin , $claimStatusAdmin, $claimDateAdmin, $claimPriceAdmin, $claimPrice]));
  } else {
    echo "Fail";
  }

  $conn = null;
  exit;
}

if ($request == "updatePublicName") {
  $publicName = $data->publicName;
  $address = $data->address;


  // Prepared statement to protect against SQL injections
  $stmt = $conn->prepare("UPDATE $tablename SET publicName = ? WHERE address = '".$address."'");
  $stmt->bindParam(1, $publicName);

  if ($stmt->execute() === TRUE) {
    echo "Public name for $address updated to $publicName";
  }

  $conn = null;
  exit;
}

if ($request == "userPaid") {
  $userPaid = $data->userPaid;
  $address = $data->address;



  // Prepared statement to protect against SQL injections
  $stmt = $conn->prepare("UPDATE $tablename SET userPaid = ? WHERE address = '".$address."'");
  $stmt->bindParam(1, $userPaid);

  if ($stmt->execute() === TRUE) {
    echo "user payment status for $address updated to $userPaid";
  }

  $conn = null;
  exit;
}

if ($request == "updateFullname") {
  $fullName = $data->fullName;
  $address = $data->address;



  // Prepared statement to protect against SQL injections
  $stmt = $conn->prepare("UPDATE $tablename SET fullName = ? WHERE address = '".$address."'");
  $stmt->bindParam(1, $fullName);

  if ($stmt->execute() === TRUE) {
    echo "full name for $address updated to $fullName";
  }

  $conn = null;
  exit;
}

if ($request == "updateHomeaddress") {
  $homeAddress = $data->homeAddress;
  $address = $data->address;



  // Prepared statement to protect against SQL injections
  $stmt = $conn->prepare("UPDATE $tablename SET homeAddress = ? WHERE address = '".$address."'");
  $stmt->bindParam(1, $homeAddress);

  if ($stmt->execute() === TRUE) {
    echo "home address for $address updated to $homeAddress";
  }

  $conn = null;
  exit;
}

if ($request == "updatePhonemodel") {
  $phoneModel = $data->phoneModel;
  $address = $data->address;



  // Prepared statement to protect against SQL injections
  $stmt = $conn->prepare("UPDATE $tablename SET phoneModel = ? WHERE address = '".$address."'");
  $stmt->bindParam(1, $phoneModel);

  if ($stmt->execute() === TRUE) {
    echo "phone model for $address updated to $phoneModel";
  }

  $conn = null;
  exit;
}

if ($request == "updateEmail") {
  $email = $data->email;
  $address = $data->address;



  // Prepared statement to protect against SQL injections
  $stmt = $conn->prepare("UPDATE $tablename SET email = ? WHERE address = '".$address."'");
  $stmt->bindParam(1, $email);

  if ($stmt->execute() === TRUE) {
    echo "email for $address updated to $email";
  }

  $conn = null;
  exit;
}

if ($request == "updatePhonenumber") {
  $phoneNumber = $data->phoneNumber;
  $address = $data->address;



  // Prepared statement to protect against SQL injections
  $stmt = $conn->prepare("UPDATE $tablename SET phoneNumber = ? WHERE address = '".$address."'");
  $stmt->bindParam(1, $phoneNumber);

  if ($stmt->execute() === TRUE) {
    echo "phone number for $address updated to $phoneNumber";
  }

  $conn = null;
  exit;
}

if ($request == "updateThief") {
  $thief = $data->thief;
  $address = $data->address;



  // Prepared statement to protect against SQL injections
  $stmt = $conn->prepare("UPDATE $tablename SET thief = ? WHERE address = '".$address."'");
  $stmt->bindParam(1, $thief);

  if ($stmt->execute() === TRUE) {
    echo "thief protection for $address updated to $thief";
  }

  $conn = null;
  exit;
}

if ($request == "updatePayinterval") {
  $payInterval = $data->payInterval;
  $address = $data->address;



  // Prepared statement to protect against SQL injections
  $stmt = $conn->prepare("UPDATE $tablename SET payInterval = ? WHERE address = '".$address."'");
  $stmt->bindParam(1, $payInterval);

  if ($stmt->execute() === TRUE) {
    echo "pay interval for $address updated to $payInterval";
  }

  $conn = null;
  exit;
}

if ($request == "updatePhoneage") {
  $phoneAge = $data->phoneAge;
  $address = $data->address;



  // Prepared statement to protect against SQL injections
  $stmt = $conn->prepare("UPDATE $tablename SET phoneAge = ? WHERE address = '".$address."'");
  $stmt->bindParam(1, $phoneAge);

  if ($stmt->execute() === TRUE) {
    echo "phone age for $address updated to $phoneAge";
  }

  $conn = null;
  exit;
}



if ($request == "updatePhoneprice") {
  $phoneprice = $data->phoneprice;
  $address = $data->address;



  // Prepared statement to protect against SQL injections
  $stmt = $conn->prepare("UPDATE $tablename SET phonePrice = ? WHERE address = '".$address."'");
  $stmt->bindParam(1, $phoneprice);

  if ($stmt->execute() === TRUE) {
    echo "phone price for $address updated to $phoneprice";
  }

  $conn = null;
  exit;
}

if ($request == "updatePremiumprice") {
  $premiumPrice = $data->premiumPrice;
  $address = $data->address;



  // Prepared statement to protect against SQL injections
  $stmt = $conn->prepare("UPDATE $tablename SET premiumPrice = ? WHERE address = '".$address."'");
  $stmt->bindParam(1, $premiumPrice);

  if ($stmt->execute() === TRUE) {
    echo "premium price for $address updated to $premiumPrice";
  }

  $conn = null;
  exit;
}

if ($request == "changePublicName"){

    $publicName = $data->publicName;
    $address = $data->address;
  
    // Check if the user is logged in
    try { $JWT = JWT::decode($data->JWT, $GLOBALS['JWT_secret']); }
    catch (\Exception $e) { echo 'Authentication error'; exit; }
  
    // Prepared statement to protect against SQL injections
    $stmt = $conn->prepare("UPDATE $tablename SET publicName = ? WHERE address = '".$address."'");
    $stmt->bindParam(1, $publicName);
  
    if ($stmt->execute() === TRUE) {
      echo "Public name for $address updated to $publicName";
    }

    $conn = null;
    exit;
}


    if ($request == "updateUserPaid") {
  $publicName = $data->publicName;
  $address = $data->address;



  // Prepared statement to protect against SQL injections
  $stmt = $conn->prepare("UPDATE $tablename SET publicName = ? WHERE address = '".$address."'");
  $stmt->bindParam(1, $publicName);

  if ($stmt->execute() === TRUE) {
    echo "Public name for $address updated to $publicName";
  }

  $conn = null;
  exit;
}


    if ($request == "setClaim") {
         $address = $data->address;
      $UserName = $data->claimUserName;
      $Title = $data->claimTitle;
      $Content = $data->claimContent;
      $rawPrice = "0";
     




  // Prepared statement to protect against SQL injections
  $stmt = $conn->prepare("INSERT INTO claims (user_address,
  claim_user_name,claim_title,claim_content, claim_price)  VALUES (?,?,?,?,?)");
  $stmt->bindParam(1, $address);
  $stmt->bindParam(2, $UserName);
  $stmt->bindParam(3, $Title);
  $stmt->bindParam(4, $Content);
  $stmt->bindParam(5, $rawPrice);
  

  if ($stmt->execute() === TRUE) {
    echo "claim created";
  }

  $conn = null;
  exit;
}

if ($request == "updateClaimPrice") {
  $claimPrice = $data->claimPrice;
  $claimStatus = $data->approvement;
  $user_id = $data->user_id;


  
  $stmt = $conn->prepare("UPDATE claims SET claim_status= ?, claim_price = ? WHERE claim_id  = '".($user_id+1)."' ");
  $stmt->bindParam(1, $claimStatus);
  $stmt->bindParam(2, $claimPrice);

  if ($stmt->execute() === TRUE) {
    echo "";
  }

  $conn = null;
  exit;
}

if ($request == "dissapproveClaim") {

  $claimStatus = $data->dissapprovement;
  $user_id = $data->user_id;


  
  $stmt = $conn->prepare("UPDATE claims SET claim_status= ? WHERE claim_id  = '".($user_id+1)."' ");
  $stmt->bindParam(1, $claimStatus);

  if ($stmt->execute() === TRUE) {
    echo "";
  }

  $conn = null;
  exit;
}

if ($request == "claimPaidStatus") {

  $claimStatus = $data->claimPaidStatus;
  $user_id = $data->user_id;


  
  $stmt = $conn->prepare("UPDATE claims SET claim_status= ? WHERE claim_id  = '".($user_id+1)."' ");
  $stmt->bindParam(1, $claimStatus);

  if ($stmt->execute() === TRUE) {
    echo "";
  }

  $conn = null;
  exit;
}

?>