<?php
abstract class Animal
{
    public $name;
    public $word;
    function __construct($name)
    {
        $this->name = $name;

    }
    public function say()
    {
    }
    public function drawLine()
    {
        echo "<br>";
    }
    public function walk()
    {
        echo $this->name . ' ходит топ топ топ';
        $this->drawLine();
    }
    public function getName()
    {
        return $this->name;
    }
    public function vote()
    {
        return $this->word;
    }
}

abstract class Bird extends Animal
{
    public $name;
    public $word;
    function __construct($name)
    {
        $this->name = $name;
    }
    public function tryToFly()
    {
        echo '<hr>';
        echo $this->name . ' вжих-вжих-топ-топ';
        $this->drawLine();
    }
}

class cow extends Animal
{
    public $word = 'му';
}
class pig extends Animal
{
    public $word = 'хрю-хрю';
}
class chicken extends Animal
{
    public $word = 'куд-кудах';
}
class horse extends Animal
{
    public $word = 'тыг-тыгыдык';
}

class goose extends Bird
{
    public $word = 'го-го-го';
}
class turkey extends Bird
{
    public $word = 'балаболю';
}

class farm
{
    public $animals = [];

    public function addAnimal(Animal $animal)
    {
        array_push($this->animals, $animal);
        $animal->walk();
    }
    public function rollCall()
    {
        $votes = [];
        foreach ($this->animals as $animal) {
            $votes[$animal->getName()] = $animal->vote();
        }
        shuffle($this->animals);
        foreach ($this->animals as $animal) {
            $name = $animal->getName();
            echo $name . " говорит, " . $votes[$name] . '<br>';
        }
    }
}

class BirdFarm extends farm
{
    public $birds = [];
    public function showAnimalsCount()
    {
        echo 'Птиц на ферме: ' . count($this->birds);
    }
    public function addBird(Bird $bird)
    {
        array_push($this->birds, $bird);
        $bird->tryToFly();
        $this->showAnimalsCount();
    }
    public function rollCall()
    {
        $votes = [];
        foreach ($this->birds as $bird) {
            $votes[$bird->getName()] = $bird->vote();
        }
        shuffle($this->birds);
        foreach ($this->birds as $bird) {
            $name = $bird->getName();
            $bird->tryToFly();
            echo $name . " говорит, " . $votes[$name] . '<br>';
        }
    }

}
class farmer
{
    protected $farms = [];

    public function addAnimal($farm, Animal $animal)
    {
        $this->farms[] = $farm;
        $farm->addAnimal($animal);
    }
    public function addBird($farm, Bird $bird)
    {
        $this->farms[] = $farm;
        $farm->addBird($bird);
    }
    public function rollCall()
    {
        foreach ($this->farms as $farm) {
            $farm->rollCall();
        }
    }

    public function callAllAnimals()
    {
        $this->rollCall();
    }
}

$farmer = new farmer();
$farm = new farm();
$cow = new cow('Мурка');
$chicken1 = new chicken('Ряба');
$chicken2 = new chicken('Басан');
$pig1 = new pig('Хрюша');
$farmer->addAnimal($farm, $cow);
$farmer->addAnimal($farm, $chicken1);
$farmer->addAnimal($farm, $chicken2);
$farmer->addAnimal($farm, $pig1);

$birdFarm1 = new BirdFarm();
$bird1 = new goose('Виталик');
$bird2 = new turkey('Дурак');
$farmer->addBird($birdFarm1, $bird1);
$farmer->addBird($birdFarm1, $bird2);

$farmer->rollCall();
?>