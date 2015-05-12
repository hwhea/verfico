<?php
require "settings.php";

if($ver->isVerified()){
	echo "The current user is verified.";
} else {
	echo "The current user is not verified.";
}