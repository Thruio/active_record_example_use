<?php
namespace Example\Models;

use Thru\ActiveRecord\ActiveRecord;

/**
 * Class Person
 * @package Example\Models
 * @var $person_id INTEGER
 * @var $name TEXT
 * @var $age INTEGER
 */
class Person extends ActiveRecord
{
    protected $_table = "people";

    public $person_id;
    public $name;
    public $age;

    private $_residences;

    /**
     * @return Residence[]|false
     */
    public function getResidences(){
        if(!$this->_residences){
            $this->_residences = Residence::search()->where('person_id', $this->person_id)->exec();
        }
        return $this->_residences;
    }
}

