#!/bin/bash
git clone git@github.com:akimsko/box.wiki.git
cd box.wiki.git
echo 'Lol' > Lol.md
git add Lol.md
git commit -m "Modified Lol.md" && git push

