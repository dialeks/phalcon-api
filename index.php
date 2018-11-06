<?php

use Phalcon\Mvc\Micro;
use Phalcon\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql as PdoMysql;

$loader = new Loader();

$loader->registerDirs(
    array(
        __DIR__ . '/app/models/'
    )
)->register();

$di = new FactoryDefault();

$di -> set('db', function () {
    return new PdoMysql(array("host" => "localhost", "username" => "root", "password" => "Zaqwsx12354", "dbname" => "phalcon_api"));
});

$app = new Micro($di);

//retrieve all cars
$app->get('/api/cars', function () use ($app){
    // first
    $phql = "SELECT * FROM Cars ORDER BY id DESC";
    $cars = $app->modelsManager->executeQuery($phql);

    //second
    $data = array();
    foreach($cars as $car){
        $data[] = array(
            'id'                =>  $car->id,
            'owner_name'        =>  $car->owner_name,
            'reg_date'          =>  $car->reg_date,
            'licence_plate_no'  =>  $car->licence_plate_no,
            'engine_no'         =>  $car->engine_no,
            'tax_payment'       =>  $car->tax_payment,
            'car_model'         =>  $car->car_model,
            'car_model_year'    =>  $car->car_model_year,
            'seating_capacity'  =>  $car->seating_capacity,
            'horse_power'       =>  $car->horse_power

        );
    }

    //third
    echo json_encode($data);
});

//searches for cars with $license_plate_no in their name
$app->get('/api/cars/search/{$license_plate_no}', function ($license_plate_no){
});

//Retrieves cars based on primary key ($id)
$app->get('/api/cars/{id: [0-9]+}', function ($id){
});

//Add a new car
$app->post('/api/cars', function (){
});

//Update car based on primary key ($id)
$app->put('/api/cars/{id: [0-9]+}', function ($id){
});

//Delete car based on primary key ($id)
$app->delete('/api/cars/{id: [0-9]+}', function ($id){
});

$app->handle();