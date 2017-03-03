<?php 


abstract class Tariff {

	//abstract public function getNameClass();
	
	abstract public function getTariff();
}

abstract class TypeLessons {

	abstract public function getCost($tariff, $quantity);
	
}

class Fixed extends Tariff {
	
	const VALUE = 200;
	
	public function getTariff()
	{
		return self::VALUE;
	}


}

class Hourly extends Tariff {
	
	const VALUE = 100;
	
	public function getTariff()
	{
		return self::VALUE;
	}
}


class Speaking extends TypeLessons {

    public function __construct($tariff, $quantity)
    {
		$value = $tariff->getTariff();
		//$this->getCost($value, $quantity);
    }


    public function getCost($tariff, $quantity)
    {
        echo $tariff * $quantity;
    }

}

class Grammar extends TypeLessons {
   

    public function __construct($tariff, $quantity)
    {
		$value = $tariff->getTariff();
		//$this->getCost($value, $quantity);
    }


    public function getCost($tariff, $quantity)
    {
        return $tariff * $quantity;
    }

}

class Factory {
	
	public function create($type)
	{
		$className = $type['type'];
		
		if(class_exists($type['tariff'])) {
			
			return new $className(new $type['tariff'], $type['quantity']);
			
		} else {
		
			throw new Exception('error');

			
		}
		
	}
}

$typeLessons = array(
    "speaking" => array(
        'type'  => 'Speaking',
		'tariff' => 'fixed2',
		'quantity' => 2
        
    ),
    "grammar" => array(
		'type'  => 'Grammar',
        'tariff' => 'hourly',
		'quantity' => 1
        
    )
);


$factory = new Factory();

foreach($typeLessons as $type) {
    
	if(class_exists($type['type'])) {
        try {
			$factory->create($type);
		} catch(Exception $e) {
			echo $e->getTraceAsString();
		}
	   
	   
    } else {
	
        return false;
		
    }
} 







	
?>