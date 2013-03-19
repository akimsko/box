#!/bin/bash
export GIT_SSH=.git_ssh_options
git clone git@github.com:akimsko/box.wiki.git
cd box.wiki.git
echo 'Lol' > Lol.md
git add Lol.md
git commit -m "Modified Lol.md" && git push

