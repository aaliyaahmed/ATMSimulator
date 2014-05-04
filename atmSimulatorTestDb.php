<?php
require_once('simpletest/autorun.php');
require_once('atmSimulatorDb.php');
class atmSimulatorTest extends UnitTestCase
{
    //initialise xml file
    private function initialise()
    {
        $simulator = new AtmSimulator();
        $simulator->changeCount(20,1000);
        $simulator->changeCount(50,1000);
    }
    
    //test for 0 amount requested
    public function testAtmSimulatorForZeroAmt()
    {
            $this->initialise();
            $amountRequested = 0;
            $simulator = new AtmSimulator();
            //test for requested amount 0
            $output = $simulator->atmSimulatorFn($amountRequested);
            $message ="Please enter an amount more than 0<br/>";
            $this->assertEqual($message,$output);
    }
    //test for 100
    public function testAtmSimulatorForHundredAmt()
    {
            $amountRequested = 100;
            $simulator = new AtmSimulator();
            //test for requested amount 0
            $output = $simulator->atmSimulatorFn($amountRequested);
            $message ="Number of 20 notes given:5 available: 995<br/>";
            $this->assertEqual($message,$output);

    }
    //test for 70
    public function testAtmSimulatorForSeventyAmt()
    {
            $amountRequested = 70;
            $simulator = new AtmSimulator();
            //test for requested amount 0
            $output = $simulator->atmSimulatorFn($amountRequested);
            $message ="Number of 50 notes given:1 available: 999 Number of 20 notes given:1 available: 994<br />";
            $this->assertEqual($message,$output);

    }
    //test for 30
    public function testAtmSimulatorForThirtyAmt()
    {
            $amountRequested = 30;
            $simulator = new AtmSimulator();
            //test for requested amount 0
            $output = $simulator->atmSimulatorFn($amountRequested);
            $message ="UNABLE TO DISPENSE AMOUNT 30. PLEASE ENTER MULTIPLES OF 20 OR 50";
            $this->assertEqual($message,$output);

    }
	
    public function testAtmSimulatorForZeroNotes()
    {
            $amountRequested = 40;
            $simulator = new AtmSimulator();
            $simulator->changeCount(20,0);
            //test for requested amount 0
            $output = $simulator->atmSimulatorFn($amountRequested);
            $message = "PLEASE NOTE: There are no more 20 notes left<br/>";
            $this->assertEqual($message,$output);
            
    }
    
}

