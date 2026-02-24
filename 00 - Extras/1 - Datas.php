<?php

//https://cursos.alura.com.br/extra/alura-mais/periodo-entre-datas-em-php-c67

echo '-------------------------------------------------' . PHP_EOL;
$inicio = new DateTime('2022-11-21');
$intervalo = new DateInterval('P4Y');
$periodo = new DatePeriod($inicio, $intervalo, 5);

foreach($periodo as $data) {
    echo $data->format('d/m/y') . PHP_EOL;
}
echo '-------------------------------------------------' . PHP_EOL;
$inicio = new DateTime('2022-11-21');
$fim = new DateTime('2042-11-22');
$periodo = new DatePeriod($inicio, $intervalo, $fim);

foreach($periodo as $data) {
    echo $data->format('d/m/y') . PHP_EOL;
}
echo '-------------------------------------------------' . PHP_EOL;