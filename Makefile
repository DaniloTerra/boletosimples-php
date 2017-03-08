test:
	docker run -v `pwd`:/app --rm phpunit/phpunit --bootstrap tests/bootstrap.php tests

test-report:
	docker run -v `pwd`:/app --rm phpunit/phpunit --bootstrap tests/bootstrap.php --coverage-html ./report tests

open-report:
	firefox ./report/index.html

composer-install:
	docker run -it --volume `pwd`:/app --user `id -u`:`id -g` composer install

composer-update:
	docker run -it --volume `pwd`:/app --user `id -u`:`id -g` composer update