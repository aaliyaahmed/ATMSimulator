<?php
require_once('simpletest/autorun.php');
require_once('atmSimulator2.php');

//Test class 
class atmSimulatorTest extends UnitTestCase
{
    //function to test for zero amount requested
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
    
    //function to test for 100 amount requested
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
    
    //test for 70 as amount requested
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
    
    //test for requested amount of 30
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
	
    //test for when no more notes of certain denomination left
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

