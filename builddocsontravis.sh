#!/bin/bash
PHPV=`php -r "echo PHP_MINOR_VERSION;"`
if [ "$PHPV" = "3" ]; then
	chmod a+rwx git_ssh_command
	export GIT_SSH=`pwd`"/git_ssh_command"
	php makekeyfile.php
	pear channel-discover pear.phpdoc.org
	pear install phpdoc/phpDocumentor
	composer install --dev
	phpenv rehash
	cd ~
	git config --global user.name "Travis"
	git config --global user.email "noreply@travis-ci.org"
	git clone git@github.com:akimsko/box.wiki.git
	cd box.wiki
	git rm Api/*
	mkdir Api
	phpdoc -t . -d ~/build/akimsko/box/src --visibility=public --template="xml"
	~/build/akimsko/box/vendor/evert/phpdoc-md/bin/phpdocmd --lt "%c" structure.xml Api
	git add Api/Box-*
	cp ~/build/akimsko/box/tests.out .
	php ~/build/akimsko/box/maketestreport.php
	git add Test-report.md
	git commit -m "Updated documentation." && git push
else
	echo " * Only building docs on PHP 5.3 - Not on 5.$PHPV"
fi
