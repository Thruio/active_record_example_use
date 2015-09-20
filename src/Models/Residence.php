<?php
namespace Example\Models;

use Thru\ActiveRecord\ActiveRecord;

/**
 * Class Residence
 * @package Example\Models
 * @var $residence_id INTEGER
 * @var $person_id INTEGER
 * @var $address TEXT
 * @var $city TEXT
 * @var $postcode TEXT
 */
class Residence extends ActiveRecord
{
    protected $_table = "residences";

    public $residence_id;
    public $person_id;
    public $address;
    public $city;
    public $postcode;

    private $_person;

    /**
     * @return false|Person
     */
    public function getPerson(){
        if(!$this->_person){
            $this->_person = Person::search()->where('person_id', $this->person_id)->execOne();
        }
        return $this->_person;
    }
}
