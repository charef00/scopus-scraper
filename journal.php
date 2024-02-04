<?php
session_start();
?>
<?php
// Turn off all error reporting
error_reporting(0);
?>
<?php
include 'functions.php';

if (isset($_GET['start'])) 
{

	$page=1;
	if (isset($_SESSION['page'])) 
	{
		$page=$_SESSION['page'];
	}else
	{
		$_SESSION['page']=1;
	}
	
	$link="https://www.scimagojr.com/journalrank.php?page=".$page."&total_size=27955";
	$_SESSION['link']	= $link;

		//reload
	echo '<script>location.href="journal.php";</script>';

} elseif (isset($_GET['new_journal'])) 
{

	
    //======= get All journal in each page=======//
	$html = curl($newChap);
	$idom = new DOMDocument();
	@$idom->loadHTML($html);
	$ixpath = new DOMXPath($idom);
		

    // Insert Content and Update List link
	if (true) 
	{
       
	}else
	{
	
		echo '<script>location.href="journal.php";</script>';
		exit();
	}

} elseif(isset($_SESSION['link'])) 
{
	
	echo 'Link: '.$_SESSION['link'].'<br>';
	$source= $_SESSION['link'];
	$html = curl($source);
	$dom = new DOMDocument();
	@$dom->loadHTML($html);
	$xpath = new DOMXPath($dom);
	//--------------- get class div of all hrefs ------------
	$xpath_name="//div[@class='table_wrap']//table//td[@class='tit']/a";
	$hrefs = $xpath->evaluate($xpath_name);
	$journals_name = array();

	for ($i = 0; $i < $hrefs->length; $i++) 
	{
		$href = $hrefs->item($i);
		$link = $href->getAttribute('href');
		$journals_name[]="https://www.scimagojr.com/".$link;
	}

	print_r($journals_name);
	
}
else
{
	echo 'Finished running!';
	echo '<script>location.href="journal.php?start=1";</script>';
}