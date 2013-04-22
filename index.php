<?php
require("classes/MgFactory.class.php");

$factory    = new MgFactory();
$database   = $factory->getDbo();

$database->configure();
$connection = $database->initialize();

$database->configure("DBOConfiguration2.xml");
$connection2 = $database->initialize();
?>
Connection <?=$connection->getId()?>: <?=$connection->getConfiguration()->database?><br/>
Connection <?=$connection2->getId()?>: <?=$connection2->getConfiguration()->database?>
<br/>
<?php
$query = $database->getQuery(0);

$columns = array();
array_push($columns,"id");
array_push($columns,"username");

$teste = $query->select("qwerty_users",$columns,false,array("id"=>"ASC"));

foreach($teste as $t){

	echo $t->id." ".$t->username."<br>";

}
?>