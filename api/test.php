<?php
require_once '../connect.php';
require_once '../auth.php';

echo  nl2br("Test authentication passed.\nParameters extracted: \nEmployee id: " . $user_id . "\nClinic id " . $clinic_id . "\nAccess level: " . $access_level . "\n");
 ?>
