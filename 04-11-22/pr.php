<?php
$dni = "123456789Q";
echo var_dump((bool)!preg_match("/\d{8}[A-Z]{1}/", $dni) || strlen($dni) !== 9);