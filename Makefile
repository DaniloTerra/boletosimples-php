PWD := $(shell pwd -L)
#PHPUnit
PHPUNIT_IMAGE := phpunit/phpunit:4.8.5
PHPUNIT_RUN   := docker run -w /app -v ${PWD}:/app ${PHPUNIT_IMAGE} --bootstrap tests/bootstrap.php
WEB_BROWSER   := firefox
#Composer
COMPOSER_IMAGE := composer:1.4
COMPOSER_RUN   := docker run -w /app -v ${PWD}:/app --user `id -u`:`id -g` ${COMPOSER_IMAGE}


unit-test:
	@${PHPUNIT_RUN} tests

unit-test-report:
	@${PHPUNIT_RUN} --coverage-html ./report tests

open-test-coverage-report:
	@${WEB_BROWSER} report/index.html

clear:
	sudo rm -rf report

composer-install:
	@${COMPOSER_RUN} install

composer_update:
	@${COMPOSER_RUN} update
