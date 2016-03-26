<?php
    
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Timetable extends CI_Model {
    private $xml = null;
    private $daysofweek = array();
    private $instructors = array();
    private $blocks = array();
    
    public function __construct() {

        $this->xml = simplexml_load_string(file_get_contents('data/timetable.xml'));
        
        foreach ($this->xml->periods->block as $period) {
            foreach ($period->class as $class) {
                $temp = array();
                $temp['time'] = (string) $class['time'];
                $temp['day'] = (string) $class['day'];
                $temp['name'] = (string) $class->name;
                $temp['code'] = (string) $class->code;
                $temp['classinstructor'] = (string) $class->classinstructor;
                $temp['location'] = (string) $class->location;
                $temp['type'] = (string) $class->type;
                $this->periods[] = new Booking($temp);
            }
        }
        
        foreach ($this->xml->instructors->instructor as $instructor) {
            foreach ($instructor->class as $class) {
                $temp = array();
                $temp['name'] = (string) $class['name'];
                $temp['time'] = (string) $class['time'];  
                $temp['name'] = (string) $class->name;
                $temp['code'] = (string) $class->code;
                $temp['dayofclass'] = (string) $class->dayofclass;
                $temp['location'] = (string) $class->location;
                $temp['type'] = (string) $class->type;
                $this->periods[] = new Booking($temp);
            }
        }
        
        foreach ($this->xml->daysofweek->day as $day) {
            foreach ($day->class as $class) {
                $temp = array();
                $temp['day'] = (string) $class['day'];
                $temp['time'] = (string) $class['time'];  
                $temp['name'] = (string) $class->name;
                $temp['code'] = (string) $class->code;
                $temp['classinstructor'] = (string) $class->classinstructor;
                $temp['location'] = (string) $class->location;
                $temp['type'] = (string) $class->type;
                $this->periods[] = new Booking($temp);
            }
        }
    }
    
    public function getInstructors() {
        return $this->instructors;
    }
    
    public function getDaysOfWeek() {
        return $this->daysofweek;
    }
    
    public function getBlocks() {
        return $this->blocks;
    }
    
    
}

class Booking extends CI_Model {
    public $name;
    public $code;
    public $dayofclass;
    public $classinstructor;
    public $location;
    public $type;

    public function __construct($booking) {
       $this->$name = (string) $booking['$name'];
       $this->$code = (string) $booking['$code'];
       $this->$dayofclass = (string) $booking['$dayofclass'];
       $this->$classinstructor = (string) $booking['$classinstructor'];
       $this->$type = (string) $booking['$type']; 
    }
    
}
