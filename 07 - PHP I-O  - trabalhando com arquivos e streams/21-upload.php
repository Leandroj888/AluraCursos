<?php

var_dump($_FILES['arquivo']);

var_dump(is_uploaded_file($_FILES['arquivo']['tmp_name']));
var_dump(move_uploaded_file($_FILES['arquivo']['tmp_name'], __DIR__ . '/a.gato'));