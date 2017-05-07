## About OPTAS

OPTAS "Open Task Scheduler" is a task scheduler application built mainly for reporting but it also can be used to run automated tasks.

The main goal of this application is to build a fully automated reporting system with some more extra features to take actions based on the output.

Currently it is planned to build 3 types of actions that can be run by any job

1. **Database Query **
 * Where you can execute any type of database queries and get the result in CSV or HTML format.
2. **OS Command**
 * Where you can execute any OS command.
3. **FileTransfer**
 * Where you can move files from one server to another.

There is no limitation on the number of actions that a job can execute, for example one job can run database query, export the output to a CSV file then move the file to another server and then run cURL command to post the file to a specific web service.

## Current Status

Alpha version still under development, but it should deliver the following features:

- **Users**
 - User can login
 - Create new users
 - Create new usergroups
 - Assign users to usergroups 
 - Create roles
 - Assign roles to usergroups
- **Configuration**
 - User can define and test new database connections
- **Jobs**
 - User can define jobs
 - User can add database actions to a job
 - User can specify when the job should run and when it should not run
 - Jobs should run automatically based on the job's scheduling criteria

## Local Installation

    git clone https://github.com/shaer/optas.git
    cd optas
    composer install
    npm install
    bower install
    php artisan migrate:refresh --seed
    sudo apt-get install libphp-serialization-perl libtext-csv-perl

**Run the development environment**

    cd optas
    php artisan serve
    npm run watch
    
### Manage Jobs

**Calculate the next run of all jobs:**

    php artisan jobs:schedule

**Run all the jobs that meet the scheduling criteria:**

    php artisan jobs:run all
    
**Run a specific job regardless to its scheduling criteria:**

    php artisan jobs:run {{JOB_ID}}


