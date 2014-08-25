#!/usr/local/bin/php
<?php
$adminEmail="admin@etebaran.com";
$highLoad=20;
$criticalLoad=$highLoad*5;

const StateFile="/tmp/loadman.state";
$uptimeString=`uptime`;

if (preg_match("/.*?load average[s]?: (\d*\.\d*).*?(\d*\.\d*).*?(\d*\.\d*)/", $uptimeString,$match))
	$load=$match[1]*1;
else
	die("Unable to grep load.");
$oldLoad=@file_get_contents(StateFile);

$plist=`ps aux | sort -rk 3,3 | head -n 10`;
if ($load>$criticalLoad)
{
	#emergency
	$subject="Critical Load";
	$msg="The load is critically high {$load}
Apparently killing Apache didn't help with this, so the culprit must be something else.
Anyway, I couldn't contain it.

{$plist}
";
}
elseif ($oldLoad<$highLoad and $load>$highLoad)
{
	#load went up, handle
	$res=`killall httpd`;
	$res.=`killall apache2`;
	if ($res)
		$killStat="un";
	$killStat.="successfully";
	$subject="High Load Detected";
	$msg="High load detected: {$load}.
Apache was {$killStat} killed to contain the high (above {$highLoad}) load.
When the load goes down again, I will notify you.

{$uptimeString}

{$plist}
";

	file_put_contents(StateFile, $load);
}
elseif ($oldLoad>$highLoad and $load<$highLoad)
{
	#contained
	$msg="";
	$res=`service httpd start`;
	$res.=PHP_EOL.`service apache2 start`;
	$subject="High Load Contained";
	$msg="High load succesfully contained. Load is now {$load} down from a high of {$oldLoad}
Apache was restarted:

{$res}

{$plist}
";
	file_put_contents(StateFile, $load);
}
elseif ($load>$highLoad)
{
	#it might restart on its own, kill until we're good
	$res=`killall httpd`;
	$res.=`killall apache2`;

}
if (isset($msg))
	mail($adminEmail,"[LoadMan Report] {$subject}", $msg);
