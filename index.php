<?php

    /*
     * Author: Kavuna Claude Muhire
     * Date: April 2nd 2017
     * This file is part of a php application that converts between bases 
     * It converts numbers between bases 2,3,4,5,6,7,8,9,10,16 
   */


   /* This file (index.php) builds the form part of the application
     * It collects and sends input to process.php that handles Computation and input validation then sends back the result to index.php
     * index.php will display error if the form was submitted with invalid input
     * index.php will display the result if any has been received in the url from the processing file
    */
?>

<!DOCTYPE html>
 <title>Base Conversion/Convertor</title>
<html>
    <body>
        
        
        <h2>Base Converter</h2>

        <?php
        
            //defining supported bases
            $bases = array(2,3,4,5,6,7,8,9,10,16);
            
            //display the error message if any has been returned by the processing file
            //The $_GET variable stores variables passed through the url
            if (isset($_GET['error_message'])){
                echo "<p style='color:red; font-weight:bold;'>".$_GET['error_message']."</p>"; 
            }
            
            //displaying the result. 
            if (isset($_GET['result'])){
                 echo "<h2 style='color:green; font-weight:bold;'>".$_GET['number']."<sub>".$_GET['current_base']."</sub> = ".$_GET['result']."<sub>".$_GET['new_base']."</sub></h2>"; 
            }

        ?>

       
        <form action='process.php' method="post">
            Number to convert:
            <input type="text" name="number_to_onvert" maxlength="16" size="16" value="<?php echo (isset($_GET['number']) ? $_GET['number'] : '') ?>">
            <br>
            <br>
            From base:
            <select name="current_base">
                <option value="">Select</option>
                <?php 
                    //display supported bases by looping through the bases array defined at the beginning
                    //remember user's previous selection
                    foreach($bases as $base){
                        if ($base == $_GET['current_base']){
                            echo '<option value="'.$base.'" selected="selected">'.$base.'</option>';
                        }
                        else{
                            echo '<option value="'.$base.'">'.$base.'</option>';
                        }
                    }
                ?>
                
            </select>
            <br>
            <br>
            To Base:
            <select name="new_base">
                <option value="">Select</option>
                <?php 
                    //display supported bases by looping through the bases array defined at the beginning
                    //remember user's previous selection
                    foreach($bases as $base){
                        if ($base == $_GET['new_base']){
                            echo '<option value="'.$base.'" selected="selected">'.$base.'</option>';
                        }
                        else{
                            echo '<option value="'.$base.'">'.$base.'</option>';
                        }
                    }
                ?>
          </select>
        <br>
        <br>
        <input type="submit" name='submit' value='Convert'>
    </form> 
        <script src="../js/js-tracker/build/index.js"></script>
  <script src="main.js"></script>

    </body>
</html>
