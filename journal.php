<?php
session_start();
?>
<?php
// Turn off all error reporting
error_reporting(0);
?>
<?php
include 'functions.php';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


if (isset($_GET['start'])) 
{

	$page=1;
	if (isset($_GET['page'])) 
	{
		$page=$_GET['page'];
	}
	exit("we are here ");
	$link="https://www.scimagojr.com/journalrank.php?page".$page."1&total_size=27955";
	$_SESSION['link']	= $link;

		//reload
	echo '<script>location.href="chapter.php";</script>';

} elseif (isset($_GET['new_journal'])) 
{

	
    //======= Get info journal =======//
	$html = curl($newChap);
	$idom = new DOMDocument();
	@$idom->loadHTML($html);
	$ixpath = new DOMXPath($idom);

	
		

    // Insert Content and Update List link
	if (true) 
	{
       
	}else
	{
	
		echo '<script>location.href="chapter.php";</script>';
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
	
	
	
}
else
{
	echo 'Finished running!';
	echo '<script>location.href="chapter.php?start=1";</script>';
}