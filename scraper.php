<?php
session_start();
?>
<?php
// Turn off all error reporting
//error_reporting(0);
?>
<?php
include 'functions.php';
include 'journal.php';

if (isset($_GET['start'])) 
{
	$page=getPage();
	$link="https://www.scimagojr.com/journalrank.php?page=".$page."&total_size=27955";
	$_SESSION['link']	= $link;
	//reload
	echo '<script>location.href="scraper.php";</script>';

} elseif (isset($_GET['new_journal'])) 
{

	$journal_list	= $_SESSION['arrNewJournal'];
    //======= get All journal in each page=======//
	$html = curl($journal_list[0]);
	$idom = new DOMDocument();
	@$idom->loadHTML($html);
	$ixpath = new DOMXPath($idom);
		
	echo $journal_list[0];
    // delete first journal link
	array_shift($journal_list); 
	$_SESSION['arrNewJournal']	= $journal_list;// for link

	//If the chapter ends, transfer another story
	if (empty($journal_list)) 
	{
		$nbr=getPage()+1;
		setPage($nbr);
		echo '<script>location.href="scraper.php?start=1";</script>';
	} else 
	{
		echo '<meta http-equiv="refresh" content="0">';
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
	echo '<pre>'. print_r($journals_name, true).'</pre>';
	//the journal name not exist
	if (empty($journals_name)) 
	{
		echo 'empty list in page '.getPage();
	} else 
	{
		$_SESSION['arrNewJournal']	= $journals_name;
		echo '<script>location.href="scraper.php?new_journal=1";</script>';
	}
}
else
{
	echo 'Finished running!';
	
}