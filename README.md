# Manitoba Moose (WordPress 6.x) ***NEW***

**Site Environment**

Hosting for the Manitoba Moose website is provided by Amazon Elastic Beanstalk, CloudFront and RDS,
and is set up to automatically scale to meet system demand.

Basic site environment:

- Nginx 1.24.x
- PHP 8.1.x
- MySQL 8.0.x

## Production Environment

www.moosehockey.com runs on a hardware configuration of 1x - 4x AWS t3a.small instances (see
https://aws.amazon.com/ec2/instance-types/ for details). At this time, these are each a 2-vCPU instances
with 2 GB of RAM. 

The production site is served from the following URLs:

- https://prod-www.moosehockey.com/
- https://www.moosehockey.com/

### Deploying ###

Run the following at the command line to deploy the latest commited code in your local Git repository to
the production website:

    eb deploy tnse-manitobamoose-web

You may be required to execute **eb init** if this is your first attempt to deploy the website to the 
Elastic Beanstalk server(s); instructions can be found further down in this document.

### SSH

In order to SSH/SFTP to the servers for www.moosehockey.com, run the command:

    eb ssh tnse-manitobamoose-web

You may be required to execute **eb ssh --setup** if this is your first attempt to
connect via SSH to the Elastic Beanstalk server(s).

### Files

The production website has a root folder of:

    /var/www/html/web/

### MySQL Database

The production website is configured to connect to the MySQL database:

    Host: tnse-data.cluster-cstl3uviglyz.ca-central-1.rds.amazonaws.com
    Username: root
    Password: 6PxuaQ7a9CKgSWJAoixdSVln4Qam5ddY
    Database: manitobamoose

To quickly connect at the command line (as the root/admin user), run:

    mysql -h tnse-data.cluster-cstl3uviglyz.ca-central-1.rds.amazonaws.com -u root -p6PxuaQ7a9CKgSWJAoixdSVln4Qam5ddY -D manitobamoose

### Logs

In the production environment, Nginx and PHP error logs can be found at this location:

    /var/log/nginx/access.log

Nginx server access logs can be found at:

    /var/log/nginx/error.log


## First Time Setup Instructions

### Local Server Setup

For the purposes of this guide, we'll assume that your GitHub username is **yllus**. Substitute that values where needed.

1.  Via https://github.com/ , fork this project to create a copy of it under your own GitHub username.

2.  Clone the fork of your repository into a local folder:

        git clone git@github.com:true-north-sports-entertainment/manitobamoose_site.git

3.  Okay, let's get the database up and going! First, you'll need to create a database named "moose" in MySQL using phpMyAdmin,
    MySQLWorkbench or at the command line:

        CREATE DATABASE moose;

4.  Next, you'll need to get a recent copy of the database from a fellow developer. One backup of the database is included with the 
    site files in the wp-content/uploads/ folder as **db_2023-08-01.zip**, and you can unzip it to prep it for import:

        unzip wp-content/uploads/db_2023-08-01.zip

5.  Next, import the decompressed SQL file into MySQL using a command like the following:

        mysql -u root -proot -D moose < db_2023-08-01.sql

6.  With that complete, you'll need to now open the following file:

        .env.sample

    Within this file, examine the values of to verify that the database settings are correct. Save it as a new file named **.env**.

7. Now we'll start using Composer to install the requirements for the project. In the root folder of the project, run:

        composer install --ignore-platform-reqs

   If you don't currently have Composer installed, head to https://getcomposer.org/download/ .

8. We'll also need to install the Node Package Manager (NPM) so we can write CSS/SASS and JavaScript and compile them together 
   in the project. Run the following command to set up NPM in the project:

        npm install

   If you don't currently have NPM installed, run `brew install npm` on Mac OS X or use the appropriate package manager for 
   your operating system.

9. Point your local webserver to a root folder of this repository:

        /

10. Let's test to see if the website is up! Navigate to the domain name your local website is set up upon to use the WordPress site. 
   By default, the primary administrator account will have the username/password of:

        URL: http://local-www.moosehockey.com/wp-admin/
        Username: tnsedev
        Password: oibaF.rub5!

11. While the website should now be online locally, let's continue and set ourselves up to be able to deploy the website and connect 
   to its servers via SSH. We'll need the Elastic Beanstalk CLI command (**eb**), so on a Mac with Homebrew installed 
   ( https://formulae.brew.sh/formula/aws-elasticbeanstalk ), run:

   		brew install aws-elasticbeanstalk

   On a Windows PC using Visual Studio, start a Linux shell/CLI, and run:

        python
        pip install awsebcli --upgrade --user

   With the **eb** command now installed but not in our common path, let's put it in there so we can run the command from any folder:

        mkdir ~/bin
        ln -nfs ~/AppData/Local/Packages/PythonSoftwareFoundation.Python.3.11_qbz5n2kfra8p0/LocalCache/local-packages/Python311/Scripts/eb.exe ~/bin/eb

12. Within this directory for this website, next run:

		eb init
  
    Choose the Region of **ca-central-1**, and then the Application **tnse-manitobamoose-web**. (Note that if you are 
    juggling multiple AWS accounts, you may need to run **eb init --profile=tnse** or somehow otherwise indicate the profile 
    to set up properly.) Choose **N** for CodeCommit.

13. All done! Use the instructions in the *Deploying* section above to test your ability to deploy the website using the latest 
    commit in this Git repository, and ensure you can connect to the webserver(s) by *SSH* in that section above to confirm that 
    access as well.


## Common Tasks / Issues

### I Need To Develop / Modify Assets (JS/CSS) Locally ###

Run the following command to have WordPress "watch" the SASS/CSS assets of the site, and cause 
it to automatically re-compile them when changes are made:

    npm run watch

### I Need To Compile Assets (JS/CSS) For Production ###

Run the following command, and commit the resulting files to Git so they're deployed with the site:

    npm run production

Make sure to add and commit the style.css file via Git to include it with your production release.

### Where Are File Uploads Being Stored? ###

File uploads are uploaded to the website's Elastic Beanstalk webserver, and then immediately moved to a Amazon S3 
storage bucket using the AWS user's credentials:

    IAM User: tnse-website-uploads

### How Is E-mail Being Sent? ###

E-mail is sent from the burtoncummingstheatre.ca domain using AWS's Simple Email Service (SES) managed service 
and the WP Mail SMTP WordPress plug-in; the SES credentials are:

    Server Hostname: email-smtp.ca-central-1.amazonaws.com
    Server Port: 587
    IAM Username: ses-smtp-user.20250416-060828
    SMTP Encryption: tls

See the Confluence page at https://tnse.atlassian.net/wiki/spaces/BI/pages/5767169/ for more details.

