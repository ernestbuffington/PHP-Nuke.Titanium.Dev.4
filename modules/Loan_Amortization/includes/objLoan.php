<?php
/*======================================================================
  PHP-Nuke Titanium v3.0.0 : Enhanced PHP-Nuke Web Portal System
 =======================================================================*/

/***************************************************************************
 *   copyright            : (C) ESO Software Inc.
 *   email                : scottybcoder#gmail.com
 ***************************************************************************/

class Loan
{
   var $Principle;
   var $debtReducer;
   var $Interest;
   var $MonthlyInterest;
   var $Term;
   var $NumPayments;
   var $MonthlyPrinciple;
   var $TotalInterest;
   var $TotalDebt;
   var $Payment;
   // Arrays
   var $AccruedPrinciple;
   var $AccruedInterest;
   var $LoanValue;
   var $Balance;

   // Initialize the data
   function InitData($principle, $interest, $term)
   {
       $this->TotalInterest = 0;
       $this->TotalDebt = 0;	   
       // AccruedPrinciple = evenly decremented balance for monthly interest calculations only
       $this->AccruedPrinciple = Array();
       $this->AccruedInterest = Array();
       $this->Balance = Array();
       $this->LoanValue = Array();
       $this->Principle = $principle;
       $this->Interest = $interest;
	   $this->Term = $term;
       $this->NumPayments = $term * 12;
       $this->MonthlyInterest = ($interest * .01) / 12;
       $this->MonthlyPrinciple = $principle / $this->NumPayments;

   } // End function

   // Amortize the loan
   function CalcData()
   {
      // Put values in 1st elements of arrays, and start adding to total interest
      $this->AccruedPrinciple[0] = $this->Principle;
      $this->AccruedInterest[0] = $this->Principle * $this->MonthlyInterest;
      $this->TotalInterest = $this->AccruedInterest[0];

       // Calculate monthly principle balance, calculate monthly interest
      for($i=1;$i<$this->NumPayments;$i++)
      {
         $this->AccruedPrinciple[$i] = $this->AccruedPrinciple[$i-1] - $this->MonthlyPrinciple;
         $this->AccruedInterest[$i] = $this->AccruedPrinciple[$i] * $this->MonthlyInterest;
         $this->TotalInterest += $this->AccruedInterest[$i];
	  }
      // Add principle and interest, calculate the payment
      $this->TotalDebt = ($this->Principle + $this->TotalInterest);
      $this->Payment = $this->TotalDebt / $this->NumPayments;
      // Calculate Balance and Loan Value
      $this->debtReducer = $this->TotalDebt / $this->NumPayments;
      $this->Balance[0] = $this->Principle - $this->Payment + $this->AccruedInterest[0];
      $this->LoanValue[0] = $this->TotalDebt;
      for($i=1;$i<$this->NumPayments;$i++)      
      {
         $this->Balance[$i] = $this->Balance[$i-1] - $this->Payment + $this->AccruedInterest[$i];
         $this->LoanValue[$i] = $this->LoanValue[0] - ($this->debtReducer * $i);
      }
      $this->Principle =  '$' . number_format($this->Principle,2,'.',',');
      $this->TotalInterest = '$' . number_format($this->TotalInterest,2,'.',',');
      $this->TotalDebt = '$' . number_format($this->TotalDebt,2,'.',',');
      $this->Payment =  '$' . number_format($this->Payment,2,'.',',');	   	   	   
   } // End function
} // End class
?>