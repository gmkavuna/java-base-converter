<?php 

    /*
     * Author: Kavuna Claude Muhire
     * Date: April 2nd 2017
     * This file is part of a php application that converts between bases 
     * It converts numbers between bases 2,3,4,5,6,7,8,9,10,16 
   */


    /* This file (process.php) handles the processing and input validation part of the application
     * It collects received from the form (index.php)
     * It validates the input. If any irregularity is found with input his file sends an error back to the form where the user gets notified
     * If input is error-free computation is done and the result is sent back to the form for display to the user
    */

    if (!empty($_POST)){
      
        //allowed letters - this array is used below in validation
        $valid_letters = array('A','a','B','b','C','c','D','d','E','e','F','f');
        
        //collect submitted data from $_POST
        $number = $_POST['number_to_onvert']; //number to convert
        $current_base = $_POST['current_base'];
        $new_base = $_POST['new_base'];
        
        //validate input 
        //$error_message will contain a comprehensive error message to display to the user
        $error_message = ''; 
        
        //array contain all the possible errors that a user can make
        //default is 0
        $errors = array(
            'empty_number' => 0,
            'out_of_bound' => 0,
            'invalid_number' => 0,
            'current_base_not_selected' => 0,
            'new_base_not_selected' => 0,
        );
        //checking for empty input 
        if (strlen($number) == 0){
            $error_message .= '<br/>Number to convert cannot be empty '; 
            $errors['empty_number'] = 1;
        }
        //checking for empty input 
        if (strlen($current_base) == 0){
            $error_message .= '<br/>Current base must be selected '; 
            $errors['current_base_not_selected'] = 1;
        }
        //checking for empty input 
        if (strlen($new_base) == 0){
            $error_message .= '<br/>New base must be selected '; 
            $errors['new_base_not_selected'] = 1;
        }
        
       
        //finding how many digits the input number contains
        $num_digits = strlen((string)$number);
        
        //check every digit of the input to make sure it is not out of base
        //also make sure that it only contains valid letters
        for ($i = 0; $i < $num_digits; $i++){
            
            $digit = substr((string)$number, $i, 1);
            //this condition block checks for out of bound errors
            if ((int)$digit >= $current_base){
                $error_message .= '<br/>'.$number.' is not a valid number in base '.$current_base.' '; 
                $errors['out_of_bound'] = 1;
                break; //break out of the loop at first occurance
            }
            
            //this condition block detects invalid letters 
            if (!is_numeric($digit) && !(in_array($digit, $valid_letters))){
                $error_message .= '<br/>'.$number.' contains invalid digits/characters'; 
                $errors['invalid_number'] = 1;
                break; //break out of the loop at first occurance
            }
        }

       
        //loop through the errors array to check if any of the errors has been set to 1
        //if so redirect the user back to the form with the error message
        //if any error flag is set to 1 processing will not continue
        
        $error_link = '';
        foreach ($errors as $key=>$value){
            if ($value == 1){
                $error_link .= '&'.$key.'='.$value;
            }
        }
        //if we have an error at all redirect back to the form
        //we will make sure that all the input is sent back to the user through the url with a detailed message of what may have gone wrong
        if (strlen($error_link) > 0){
            header("Location: index.php?number=".$number."&current_base=".$current_base."&new_base=".$new_base."&error_message=".$error_message."".$error_link); 
            return;
        }
        
        //we will only get here if validation test is passed
        //step1 is to convert from any base to base 10
        $result = 0;
        for ($i = 0; $i < $num_digits; $i++){
            $digit = substr((string)$number, $i, 1);
            //convert A B C D E F to their corresponding numbers 
            switch ($digit){
                case 'a':
                case 'A':
                    $digit = '10';
                    break;
                case 'b':
                case 'B':
                    $digit = '11';
                    break;
                case 'c':
                case 'C':
                    $digit = '12';
                    break;
                case 'd':
                case 'D':
                    $digit = '13';
                    break;
                case 'e':
                case 'E':
                    $digit = '14';
                    break;
                case 'f':
                case 'F':
                    $digit = '15';
                    break;
                default :
                    $digit;
            }
            $result += pow($current_base, $num_digits-$i-1)*$digit;
        }
        
        //Step2 - if we are converting to a base different than base 10 we need to go the extra step of converting
        //from base 10 to the requred base
        if ($new_base != 10){
            //this array holds the remainders
            $remainders = array();
            
            //variable is initialized with base 10 number received from step1
            //until quotient is greater than 0 we will divide it by the base we are converting to
            //at every division we will ignore the decimal part and will prepend the remainder to the remainders array
            $quotient = $result;
            while ($quotient > 0)
            {
                $remainder = $quotient%$new_base;
                //converts digits greater than 9 to their corresponding letters
                switch ($remainder){
                    case 10:
                        $remainder = 'A';
                        break;
                    case 11:
                        $remainder = 'B';
                        break;
                    case 12:
                        $remainder = 'C';
                        break;
                    case 13:
                        $remainder = 'D';
                        break;
                    case 14:
                        $remainder = 'E';
                        break;
                    case 15:
                        $remainder = 'F';
                        break;
                    default :
                        $remainder;
                }
                //array_unshift adds an element at the beginning of the array
                array_unshift($remainders, $remainder); 
                $quotient = (int) ($quotient/$new_base);
            }
            
            //building the final result by looping through the remainders array and adding every element to $result
            $result = ''; 
            foreach ($remainders as $value){
               $result .= $value;
            }
        }
        //redirect the user back to the form with the result 
        header("Location: index.php?number=".$number."&current_base=".$current_base."&new_base=".$new_base."&result=".$result); 
    }