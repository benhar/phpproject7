<?php
/**
 * Created by PhpStorm.
 * User: rasel
 * Date: 6/11/2016
 * Time: 9:20 PM
 */


?>

<html>
<head>
    <title>Payment page</title>
</head>
<body>
<form action="https://sandbox.sslcommerz.com/gwprocess/v3/process.php" method="post">
    <input type="text" name="tran_id" value="<?php echo time();?>">
    <input type="text" name="total_amount">
    <input type="text" name="success_url" value="http://localhost/php/success.php">
    <input type="text" name="fail_url" value="http://localhost/php/fail.php">
    <input type="text" name="cancel_url" value="http://localhost/php/cancel.php">
    <input type="text" name="store_id" value="testbox">
    <input type="submit" value="Submit">
</form>
</body>
</html>
