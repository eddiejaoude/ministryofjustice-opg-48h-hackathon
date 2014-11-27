[![Build Status](https://travis-ci.org/eddiejaoude/ministryofjustice-opg-48h-hackathon.svg?branch=master)](https://travis-ci.org/eddiejaoude/ministryofjustice-opg-48h-hackathon)

# Ministry of Justice OPG 48hr Hackathon

### URLs

Repo: https://github.com/eddiejaoude/ministryofjustice-opg-48h-hackathon
TravisCI: https://travis-ci.org/eddiejaoude/ministryofjustice-opg-48h-hackathon


### Contribution / Local installation

1. Clone repo https://github.com/eddiejaoude/ministryofjustice-opg-48h-hackathon

`git clone https://github.com/eddiejaoude/ministryofjustice-opg-48h-hackathon`

2. Get dependencies

`php composer.phar install`

3. Update config to your setup for ElasticSearch & Postgres DB

Best way to do this is copy `local.php.dist` to `local.php` and update parameters

4. Run built-in php webserver

`php -S 0.0.0.0:8000` and point your browser to `http://localhost:8000`
