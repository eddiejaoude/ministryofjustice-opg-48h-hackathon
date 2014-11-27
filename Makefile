# parameters
GIT_TAG=build-$(TRAVIS_BRANCH)-$(TRAVIS_BUILD_NUMBER)

check:
	php app/check.php

composer.install:
	if [ ! -f "composer.phar" ] ; then curl -s http://getcomposer.org/installer | php ; fi
	php composer.phar install --dev --no-interaction

composer.update:
	php composer.phar upate

test.run:
	bin/robo parallel:run

scrutinizer.coverage:
	wget https://scrutinizer-ci.com/ocular.phar
	php ocular.phar code-coverage:upload --format=php-clover test/build/coverage.xml

build.package: build.user build.version build.changelog build.tag

build.user:
	git config --global user.email "builds@travis-ci.com"
	git config --global user.name "Travis CI"

build.version:
	echo $(GIT_TAG) > VERSION
	git commit -m "Set build VERSION number $(GIT_TAG)" VERSION

build.changelog:
	git log --decorate --all --oneline --graph > changelog
	git commit -m "Created changelog" changelog

build.tag:
	git tag $(GIT_TAG) -a -m "Generated tag from TravisCI build $(TRAVIS_BUILD_NUMBER)"
	@git push --quiet https://$(GITHUBKEY)@github.com/eddiejaoude/ministryofjustice-opg-48h-hackathon $(GIT_TAG) > /dev/null 2>&1

dev.run: dev.branch composer.install dev.server

dev.update: dev.branch composer.update dev.server

dev.branch:
	git pull --tags
	git checkout ${branch}

dev.server:
	php -S 0.0.0.0:8000 -t public/ 

logs:
	cat app/logs/*.log
