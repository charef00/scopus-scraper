<?php
class Journal 
{
  public $xpath;

  function __construct($xpath) 
  {
    $this->xpath = $xpath;
  }
  function name()
  {
    $name="";
    $temp = $this->xpath->evaluate("//div[@class='journaldescription colblock']/h1");
    if($temp->length>0)
    {
        $name=$temp->item(0)->nodeValue;
    }
    return $name;
  }
  function test()
  {
    return "ok";
  }
}

?>