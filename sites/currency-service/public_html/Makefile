install:
	make clear
	make create-database
	make load-fixtures
	make create-api-user
	make create-admin-user

clear:
	make cache-clear
	make restart-nginx

create-api-user:
	php app/console fos:user:create apiuser apiuser@stefanius.nl 1234
	php app/console fos:user:promote apiuser ROLE_USER

create-admin-user:
	php app/console fos:user:create admin admin@stefanius.nl 1234
	php app/console fos:user:promote admin ROLE_ADMIN

create-database:
	php app/console doctrine:database:create
	php app/console doctrine:schema:create

load-fixtures:
	php app/console doctrine:fixtures:load

create-fixtures:
	php app/console stef:fixture:generate:bv-blog
	php app/console stef:fixture:generate:bv-news
	php app/console stef:fixture:generate:bv-page

test:
	php bin/phpunit -c app/

restart-nginx:
	sudo service nginx stop
	sudo service nginx start

cache-clear:
	rm app/cache/dev -rf
	rm app/cache/prod -rf
	rm app/cache/test -rf
	rm app/cache/dev.old -rf
