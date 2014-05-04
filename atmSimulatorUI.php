<?php
require_once "atmSimulatorDb.php";
$output = "";
if (isset($_POST['submitBtn'])&&($_POST['submitBtn']!=''))
{
    $requestedAmt = $_POST['amountTxt'];
    $simulator = new AtmSimulator();
    $output = $simulator->atmSimulatorFn($requestedAmt);
    echo "<input type='button' value='BACK' onclick='history.go(-1);return false;' />";
}
if ($output=='')
{
?>
<html>
    <body>
        <h1>ATM Simulator</h1>
        <form action="atmSimulatorUI.php" method="POST">
            <b>Withdrawal Amount:</b>
            <input type="textbox" name="amountTxt" id="amountTxt" value="" />
            <input type="submit" name="submitBtn" id="submitBtn" value="Withdraw" />
        </form>
    </body>
</html>
<?php
}
?>