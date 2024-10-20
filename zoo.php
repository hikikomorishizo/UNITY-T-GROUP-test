<?php

abstract class Animal {
    protected $name;

    public function __construct($name) {
        $this->name = $name;
    }

    abstract public function getSpecies(): string;

    public function __toString() {
        return $this->getSpecies() . ' ' . $this->name;
    }
}

interface Fur {
    public function comb();
}

abstract class Carnivore extends Animal { 
    public function eatMeat() {
        echo $this . " eats meat.\n";
    }
}

abstract class Herbivore extends Animal { 
    public function eatPlants() {
        echo $this . " eats plants.\n";
    }
}

abstract class Omnivore extends Animal { 
    public function eatMeat() {
        echo $this . " eats meat.\n";
    }

    public function eatPlants() {
        echo $this . " eats plants.\n";
    }
}


class Tiger extends Carnivore {
    public function getSpecies(): string {
        return "Tiger";
    }
}

class Elephant extends Herbivore {
    public function getSpecies(): string {
        return "Elephant";
    }
}

class Rhino extends Herbivore {
    public function getSpecies(): string {
        return "Rhino";
    }
}

class Fox extends Omnivore implements Fur {
    public function getSpecies(): string {
        return "Fox";
    }

    public function comb() {
        echo "Combing fur of " . $this . ".\n";
    }
}

class SnowLeopard extends Carnivore implements Fur {
    public function getSpecies(): string {
        return "Snow Leopard";
    }

    public function comb() {
        echo "Combing fur of " . $this . ".\n";
    }
}

class Rabbit extends Herbivore implements Fur {
    public function getSpecies(): string {
        return "Rabbit";
    }

    public function comb() {
        echo "Combing fur of " . $this . ".\n";
    }
}

class Zoo {
    private $animals = [];

    public function addAnimal(Animal $animal) {
        $this->animals[] = $animal;
        echo $animal . " has been added to the zoo.\n";
    }

    public function listAnimals() {
        echo "\nList of animals in the zoo:\n";
        foreach ($this->animals as $animal) {
            echo $animal . "\n";
        }
    }
}

$zoo = new Zoo();

$zoo->addAnimal(new Tiger("Shere Khan"));
$zoo->addAnimal(new Elephant("Dumbo"));
$zoo->addAnimal(new Rhino("Rino"));
$zoo->addAnimal(new Fox("Foxy"));
$zoo->addAnimal(new SnowLeopard("Snowy"));
$zoo->addAnimal(new Rabbit("Peter Rabbit"));

$zoo->listAnimals();
