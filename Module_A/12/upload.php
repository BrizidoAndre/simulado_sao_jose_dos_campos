<?php
$file = file_put_contents('./uploads/' . $_FILES['file']['name'], file_get_contents($_FILES['file']['tmp_name']));
header("Location: http://172.17.1.8/BR_SPEED_MODULES/12");