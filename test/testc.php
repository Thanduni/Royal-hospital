<?php

// Define a class called "Person"
class Person {
    private $name;
    private $age;
    private $email;

    // Constructor function that sets initial values for name, age, and email
    public function __construct($name, $age, $email) {
        $this->name = $name;
        $this->age = $age;
        $this->email = $email;
    }

    // Getter function for name property
    public function getName() {
        return $this->name;
    }

    // Getter function for age property
    public function getAge() {
        return $this->age;
    }

    // Getter function for email property
    public function getEmail() {
        return $this->email;
    }
}

// Instantiate two Person objects
$person1 = new Person("John Smith", 30, "john@example.com");
$person2 = new Person("Jane Doe", 25, "jane@example.com");

// Output the names, ages, and email addresses of the two Person objects
echo "Person 1: " . $person1->getName() . ", " . $person1->getAge() . ", " . $person1->getEmail() . "<br>";
echo "Person 2: " . $person2->getName() . ", " . $person2->getAge() . ", " . $person2->getEmail() . "<br>";

// me kohomada form ekaka radio button danne
?>


