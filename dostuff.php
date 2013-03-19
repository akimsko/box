<?php
echo "Attempting to generate wiki page."
`git clone git@github.com:akimsko/box.wiki.git`;
chdir('box.wiki.git');
file_put_contents('Lol.md', 'Test');
`git add Lol.md`;
`git commit -m "Lol.md"`;
`git push`; 

