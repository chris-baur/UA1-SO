UA1-SO

# Stack Overflow Wannabe site

[![Build Status](https://travis-ci.org/chris-baur/UA1-SO.svg?branch=master)](https://travis-ci.org/chris-baur/UA1-SO)

Project assignment for SOEN 341, Concordia University.
The goal of the project is to create a site like Stack Overflow.

## Getting Started

Download the project and place it in your www folder of your apache server. Advanced users, you know where to go if you want to change the default folder.These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

Ensure that you have sowftare such as WAMP installed and running on your computer.
Windows Apache MySQL PHP (WAMP)
This project requires that you have:
  - PHP
  - Composer
  - MySQL
  - Apache server
  - Travis-CI account

### Installing

For windows,
 install wamp which can be found: http://www.wampserver.com/en/
 install composer which can be found: https://getcomposer.org/doc/00-intro.md
 
 Access your phpmyadmin page from wamp, login using root and '' for login credentials (password is empty).
 Import the database file.
 You may change the user credentials that are used for accessing the database.
 
 At this point the project can be run locally.
 For preparing testing environment, continue
 
 The settings for Travis-CI, the continuous integration testing tool, are found in the .travis.yml file
 Ensure that you have your own github repository now with your version of the project. Create a travis-CI account
 on their website at https://travis-ci.org/. Check the repositories you want travis to watch. Every push to your repository will cause a 
 build to be done, and tests will be run based on the configuration you have for .travis.yml. Testing details and test folder configurations
 are located in the phpunit.xml
 

## Running the tests

The tests defined in the tests folder, with help of the phpunit and travis yml file will allow the tests to be run every push
to the repository. The static tool test can be run via commmand line as such:
/vendor/bin/parallel-lint insert_directory_of_files_to_test

