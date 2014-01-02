<?php
include_once "include.inc.php";
generateHeader(true, "If you need help here then you should give up now.");

?>
<div id="main">
	<h2>Welcome to the SQLI Testing Environment</h2>

	<p>This application is intended to provide an offline environment for people interested in hacking/pentesting to test their skills. A basic challenge has been set for each page just to give you something to aim for.  This is by no means the only possible target and others may be added in the future.</p>

	<hr />
	<span id="list">
	What this application will do:
	<ul class="indexlist">
		<li>
			Provide you with an environment to practice SQL Injection
		</li>
		<li>
			Expose you to some of the stranger forms of SQL Injection (eg cookies, server variables etc)
		</li>
	</ul>
	What this application <u>WON'T</u> do:
	<ul class="indexlist">
		<li>
			Walk you through the challenges
		</li>
	</ul>
	

	<h3>Challenges</h3>
	<ul class="indexlist">
		<li>
			<a href="Setup.php">Setup</a> - For resetting the database if you drop something you shouldnt have.
		</li>
		<li>
			<a href="NoProtection.php">No Proction</a> - The sort of thing that an intro to web programing student would write.
		</li>
		<li>
			<a href="EscapeQuery.php">Escaped Query</a> - Has basic protection in place. You wont find ' or 1 = " here.
		</li>
		<li>
			<a href="Cookies.php">Cookies</a> - SQLI through cookies. You not likely to find this in wide spread use but still cool.
		</li>
		<li>
			<a href="ServerVariables.php">Server Variables</a> - Some web apps save server variables into the database but some of these can be manipulated.
		</li>
		<li>
			<a href="BlindBasic.php">Blind Basic</a> - As the name suggests, you will receive no feedback on this challange. 
		</li>
		<li>
			<a href="BasicAuth.php">Basic Auth</a> - Injection via a HTTP basic auth dialog. 
		</li>
	</span>
</div>
<?php

?>