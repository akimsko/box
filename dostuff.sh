#!/bin/bash
chmod a+rwx git_ssh_options
export GIT_SSH=`pwd`"/git_ssh_options"
git config --global user.name "Travis"
git config --global user.email "noreply@travis-ci.org"
git clone git@github.com:akimsko/box.wiki.git
cd box.wiki.git
echo 'Lol' > Lol.md
git add Lol.md
git commit -m "Modified Lol.md" && git push

