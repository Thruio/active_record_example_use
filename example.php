<?php

require_once("vendor/autoload.php");

use \Example\Models\Person;

/*$database = new \Thru\ActiveRecord\DatabaseLayer([
    'db_type' => 'Mysql',
    'db_hostname' => 'localhost',
    'db_port' => '3306',
    'db_username' => 'example',
    'db_password' => 'YsATwAjD3ZYXc2nj',
    'db_database' => 'example',
]);*/

$database = new \Thru\ActiveRecord\DatabaseLayer([
    'db_type' => 'Sqlite',
    'db_file' => 'example.sqlite',
]);


$faker = Faker\Factory::create();
$faker->addProvider(new Faker\Provider\en_GB\Address($faker));

for($i = 0; $i < 5; $i++) {
    $person = new \Example\Models\Person();
    $person->name = $faker->name;
    $person->age = rand(18,90);
    $person->save();

    $num = rand(1,5);

    for($r = 0; $r < $num; $r++){
        $residence = new \Example\Models\Residence();
        $residence->person_id = $person->person_id;
        $residence->address = $faker->streetAddress;
        $residence->city = $faker->city;
        $residence->postcode = $faker->postcode;
        $residence->save(false);
    }
}

/** @var Person $randomPerson */
$randomPerson = Person::search()
    ->where('age', 5, '>')
    ->order('rand()')
    ->execOne();

\Kint::dump($randomPerson, $randomPerson->getResidences());

echo "Go welcome {$randomPerson->name} to the cult. He lives at " . str_replace("\n", ", ", reset($randomPerson->getResidences())->address) . "\n";