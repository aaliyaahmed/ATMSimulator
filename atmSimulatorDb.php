<?php
/*
 * This can be run through atmSimulatorTestDb.php
 */
class AtmSimulator
{
    /*
     * reads from an xml file the initial count  
     */
    public function initialiseArray()
    {
        $iniArr = array();
        $xml = simplexml_load_file("denomination.xml")
	       or die("Error: Cannot create object");
       
        //set array
        foreach($xml->children() as $notes=>$data){
            $value = trim($data->id);
            $iniArr[$value] = trim($data->count);
	}
        return $iniArr;
    }
    
    //function which does processing
    public function atmSimulatorFn($requestedAmt=0)
    {
        $dispensedNumber = 0;
        $amountLeft = 0;
        $output = "";
        
        $denominationArr = $this->initialiseArray();
        
        $initialMsg = " INITIAL COUNT<br />";
        $initialMsg .="************************<br />";
        $initialMsg .=" Number of 20 notes: ".$denominationArr[20]."<br />";
        $initialMsg .= " Number of 50 notes: ".$denominationArr[50]."<br />";
        $initialMsg .= "************************<br />";
        $initialMsg .=" Amount requested:".$requestedAmt."<br />";

        $dispensed20 = $requestedAmt/20;
        $dispensed50 = $requestedAmt/50;
        if ($requestedAmt == 0)
        {
            $output = "Please enter an amount more than 0<br/>";
        }
            
        if ($denominationArr[20]<=0)
        {
            $output = "PLEASE NOTE: There are no more 20 notes left<br/>";
        }
        if ($denominationArr[50]<=0)
        {
            $output = "PLEASE NOTE: There are no more 50 notes left<br />";
        }

        if ($output=="")
        {
            if (($requestedAmt % 20 ==0)&&(($denominationArr[20]>0)&&($denominationArr[20]-$dispensed20 >=0)))
            {
                $dispensedNumber = $requestedAmt/20;
                $denominationArr[20] = $denominationArr[20] - $dispensedNumber; 
                $output = "Number of 20 notes given:".$dispensedNumber." available: ".$denominationArr[20]."<br/>";
            }
            else if (($requestedAmt % 50 == 0)&&(($denominationArr[50]>0)&&($denominationArr[50]-$dispensed50 >=0)))
            {
                $dispensedNumber = $requestedAmt/50;
                $denominationArr[50] = $denominationArr[50] - $dispensedNumber;
                $output = "Number of 50 notes given:".$dispensedNumber." available: ".$denominationArr[50]."<br/>";
            }
            else
            {
                $amountLeft = $requestedAmt % 50;
                if ($amountLeft % 20 == 0)
                {	
                    $dispensedNumber = ($requestedAmt - $amountLeft)/50;
                    $denominationArr[50] = $denominationArr[50] - $dispensedNumber;
                    $output = "Number of 50 notes given:".$dispensedNumber." available: ".$denominationArr[50];
                    $dispensedNumber = $amountLeft/20;
                    $denominationArr[20] = $denominationArr[20] - $dispensedNumber;
                    $output .= " Number of 20 notes given:".$dispensedNumber." available: ".$denominationArr[20]."<br />";
                }
                else 
                {
                    $output = "UNABLE TO DISPENSE AMOUNT ".$requestedAmt.". PLEASE ENTER MULTIPLES OF 20 OR 50";
                }
            }
        }
        
        foreach ($denominationArr as $id=>$val)
        {
            $this->changeCount($id,$val);
        }
  
        echo $initialMsg;
        echo $output;
        return $output;
    }
    
    //function to change the count of notes 
    public function changeCount($note,$count)
    {
        $xml = simplexml_load_file("denomination.xml")
	       or die("Error: Cannot create object");
        
        foreach($xml->children() as $notes=>$data){
            if (trim($data->id)==$note)
                $data->count = $count;
	}
        $xml->saveXML("denomination.xml");
        
    }
}

?>