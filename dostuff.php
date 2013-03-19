<?php
echo "Attempting to generate wiki page."
system('git clone git@github.com:akimsko/box.wiki.git');
chdir('box.wiki.git');
file_put_contents('Lol.md', 'Test');
system('git add Lol.md');
system('git commit -m "Modified Lol.md"');
system('git push'); 

