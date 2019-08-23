# Base Project Template

The starting point for all my projects.



[![Build Status](https://img.shields.io/travis/SidRoberts/project/master.svg?style=for-the-badge)](https://travis-ci.org/SidRoberts/project)

[![GitHub issues](https://img.shields.io/github/issues-raw/SidRoberts/project.svg?style=for-the-badge)](https://github.com/SidRoberts/project/issues)
[![GitHub pull requests](https://img.shields.io/github/issues-pr-raw/SidRoberts/project.svg?style=for-the-badge)](https://github.com/SidRoberts/project/pulls)



## Installation

```bash
composer create-project sidroberts/project

npm install

docker-compose up -d

# Seed the database
docker-compose exec background .vendor/bin/doctrine orm:schema-tool:create
```



## License

Licensed under the MIT License.
© [Sid Roberts](https://github.com/SidRoberts)
