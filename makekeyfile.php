<?php

$baseKey = '';
for ($i = 1; $i <= 28; $i++) {
	$baseKey .= getenv("LOL$i");
}

file_put_contents('/home/travis/.ssh/travis', base64_decode($baseKey));
chmod('/home/travis/.ssh/travis', 0700);
