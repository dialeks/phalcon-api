<?php

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\Regex;


class Cars extends Model {
    public $owner_name;         //Oleksii Derzhuk
    public $reg_date;           //2011-01-19
    public $licence_plate_no;   //ABC-123
    public $engine_no;          //TMBND25J6BB600151
    public $tax_payment;        //2018-01-19
    public $car_model;          //Skoda Roomster
    public $car_model_year;     //2011
    public $seating_capacity;   //5
    public $horse_power;        //105

    //Validations

    public function validation(){
        $this->validate(
            new PresenceOf(
                array(
                    "Field"   =>  "licence_plate_no",
                    "Message" =>  "The licence plate number is required"
                )
            )
        );

        $this->validate(
            new PresenceOf(
                array(
                    "Field"   =>  "engine_no",
                    "Message" =>  "The engine number is required"
                )
            )
        );

        $this->validate(
            new PresenceOf(
                array(
                    "Field"   =>  "owner_name",
                    "Message" =>  "The owner name is required"
                )
            )
        );

        $this->validate(
            new Uniqueness(
                array(
                    "Field"   =>  "licence_plate_no",
                    "Message" =>  "The licence_plate_no Uniqueness is required"
                )
            )
        );

        $this->validate(
            new Uniqueness(
                array(
                    "Field"   =>  "engine_no",
                    "Message" =>  "The engine_no Uniqueness is required"
                )
            )
        );

        $this->validate(
            new Regex(
                array(
                    "Field"   =>  "Licence_plate_no",
                    "pattern"   =>  "/^[A-Z]{3}-[0-9]{3}$/",
                    "Message" =>  "invalid Licence_plate_no"
                )
            )
        );

        if ($this->car_model_year < 0){
            $this->appendMessage(new Message("Car's model year cannot be zero."));
        }

        if ($this->validationHasFailed() === true) {
            return false;
        }

    }
}