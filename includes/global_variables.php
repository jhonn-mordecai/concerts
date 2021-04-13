<?php

if (substr($_SERVER["SERVER_ADDR"], 0, 7) == "192.168" || $_SERVER["SERVER_ADDR"] == "127.0.0.1" || $_SERVER["SERVER_ADDR"] == "::1") {

	define ("DB_SERVER", "localhost");
	define ("DB_USER", "root");
	define ("DB_PASS", "root");
	define ("DB_NAME", "concerts");
	
} else {
	
	define ("DB_SERVER", "rasmus");
	define ("DB_USER", "johnmord_admin");
	define ("DB_PASS", "ySIx;wi#cD1)");
	define ("DB_NAME", "johnmord_concerts");
}

define ("SITE_NAME", "Concert Log");
define ("APPEND_SITE_NAME_TO_PAGE_TITLE", false);

define ("META_DESCRIPTION", "All of my concerts attended since 1996.");
define ("META_KEYWORDS", "concerts, log, concert log");

?>