<?php
require_once('simpletest/autorun.php');
require_once('atmSimulator2.php');
class atmSimulatorTest extends UnitTestCase
{
    public function testAtmSimulatorForZeroAmt()
    {
            $amountRequested = 0;
            $numberOfNotes = 100;
            $simulator = new AtmSimulator();
            //test for requested amount 0
            $output = $simulator->atmSimulatorFn($amountRequested,$numberOfNotes);
            $message ="Please enter an amount more than 0<br/>";
            $this->assertEqual($message,$output);
    }
    
    public function testAtmSimulatorForHundredAmt()
    {
            $amountRequested = 100;
            $numberOfNotes = 100;
            $simulator = new AtmSimulator();
            //test for requested amount 0
            $output = $simulator->atmSimulatorFn($amountRequested,$numberOfNotes);
            $message ="Number of 20 notes given:5 available: 95<br/>";
            $this->assertEqual($message,$output);

    }
    
    public function testAtmSimulatorForSeventyAmt()
    {
            $amountRequested = 70;
            $numberOfNotes = 100;
            $simulator = new AtmSimulator();
            //test for requested amount 0
            $output = $simulator->atmSimulatorFn($amountRequested,$numberOfNotes);
            $message ="Number of 50 notes given:1 available: 99 Number of 20 notes given:1 available: 99<br />";
            $this->assertEqual($message,$output);

    }
    
    public function testAtmSimulatorForThirtyAmt()
    {
            $amountRequested = 30;
            $numberOfNotes = 100;
            $simulator = new AtmSimulator();
            //test for requested amount 0
            $output = $simulator->atmSimulatorFn($amountRequested,$numberOfNotes);
            $message ="UNABLE TO DISPENSE AMOUNT 30. PLEASE ENTER MULTIPLES OF 20 OR 50";
            $this->assertEqual($message,$output);

    }
	
    public function testAtmSimulatorForZeroNotes()
    {
            $amountRequested = 30;
            $numberOfNotes = 0;
            $simulator = new AtmSimulator();
            //test for requested amount 0
            $output = $simulator->atmSimulatorFn($amountRequested,$numberOfNotes);
            $message = "PLEASE NOTE: There are no more 50 notes left<br />";
            $this->assertEqual($message,$output);

    }
}

