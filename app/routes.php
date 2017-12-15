<?php

$app->get('/', 'HomeController:index');
$app->get('/map', 'CityController:getMap');
$app->get('/cities', 'CityController:getCities');
$app->post('/city/add', 'CityController:addCity');