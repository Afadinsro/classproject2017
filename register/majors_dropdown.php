<?php

/* 
 * This file reads the majors available from the database
 * and displays them in the dropdown
 */

require '../database/init.php';

$db = connectToDB('cproject');

if(connected($db)){
    $majors = fetchMajors($db);
    if($majors != NULL){
        foreach ($majors as $record) {
            $maj = $record['majorname'];
            echo "<option>$maj</option>";
        }
    }
}
