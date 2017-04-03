<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../unsecure/retrieval_functions.php';

$majors = fetchMajors();
if ($majors != NULL) {
    foreach ($majors as $record) {
        $maj = $record['majorname'];
        echo "<option>$maj</option>";
    }
}


