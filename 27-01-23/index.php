<?php

require_once "./entity/ImgGallery.php";

// Ejercicio 2
$gallery = [];

for ($i = 0; $i < 12; $i++) {
    array_push($gallery, new ImgGallery("$i.jpg", "img_description_$i", $i, $i, $i));
}

// var_dump($gallery);

// Ejercicio 3
$category_id = "category1";
$active = true;
// include "partials/image_gallery.part.php";

// $category_id = "category2";
// $active = false;
// include "partials/image_gallery.part.php";

// $category_id = "category3";
// include "partials/image_gallery.part.php";

for ($id = 1; $id <= 3; $id++) {
    $category_id = "category$id";
    $active = $category_id === 1;

    shuffle($gallery);
    include "partials/image_gallery.part.php";
}
