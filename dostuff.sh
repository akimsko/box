#!/bin/bash
chmod a+rwx git_ssh_command
export GIT_SSH=`pwd`"/git_ssh_command"
php makekeyfile.php
pear channel-discover pear.phpdoc.org
pear install phpdoc/phpDocumentor-alpha
composer install --dev
phpenv rehash
cd ~
git config --global user.name "Travis"
git config --global user.email "noreply@travis-ci.org"
git clone git@github.com:akimsko/box.wiki.git
cd box.wiki
mkdir Api
git rm Api/*
phpdoc parse -t . -d ~/box/src
phpdocmd structure.xml Api
git add Api/*
git commit -m "Updated documentation." && git push
