<?php 
session_start();
$x = 24;
$a = str_split($x);
if($a['1']>$a['0'])
{
	$N = $a['1']/$a['0'];
	echo $N."<br/>";
}

/*next*/
$b = array("a",4,"b",9,"c",2);
//$c = str_split($b);
//$d = print_r($c);
//var_dump($b);
foreach($b as $value)
{
	//echo $value."<br/>";
	
	  $currType = gettype($value);
	switch($currType){
		 case "string" :
           echo $_SESSION['at'] = $value."\n";
            break;
          case "integer" :
		  for($i=1;$i<=$value;$i++)
		  {
           echo $_SESSION['at']."\n";
		  }
            break;
         
          default:
            echo "I am ".$currType ."\n" ;
            break;
          }
	
	  
	
}
/*next*/
$d = "aaaaabbbbbcc";
$s = str_split($d);
foreach($s as $valu)
{
	$i=0;
	while($i<=$valu)
	{
		echo $valu;
	}
	$i++;
	
}

?>