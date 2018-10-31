<?php

$token = str_shuffle(base64_encode(date('mdyhis').date('mdyhis')));
			echo $token;
			
?>