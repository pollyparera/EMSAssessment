# EMSAssessment

## Overview
The project code is for the assessment test bein conducted as a part of evaluation.

## Installation
1. Clone the app using below command:
git clone https://github.com/pollyparera/EMSAssessment.git

2. copy the .env.example and rename it to .env

3. Put on the database credentials

4. Tables can be migrated and test data can be seeded using below command:
php artisan migrate --seed

5. Seeders can be run individually as in below sequence:
a) php artisan db:seed --class=TagSeeder
b) php artisan db:seed --class=SpeakerSeeder
c) php artisan db:seed --class=RoleSeeder
d) php artisan db:seed --class=UserSeeder

## .env file configuration changes
1. Below mail credentials should be added for running the mail SMTP:
MAIL_MAILER=smtp
MAIL_HOST=
MAIL_PORT587
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=
MAIL_FROM_NAME=

2. Below Pusher credentials need to be added:
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=

## Important points to consider:
1. For the API JWT authentication has been left out since there was no clarity which login user would user the API 
2. I was able to partial implement pusher in backend. However, it was not complete in frontend.
3. Due to time restriction and as I have not worked much on testing I was able to complete one Unit Test fully. Please consider the same 

## Process
1. Have created the login feature for both Speakers and Reviewers
2. For the shake of convinience the login credentials would be autofilled while running the appication or switching to the user type on login screen
3. After login Speaker would be able to submit and edit Talk proposal
4. Each Talk proposal update will also create a log in talk_proposal_revisions table
5. Reviewer would be able to review the application and a mail would be sent to speaker

## APIs
1. Please find the below APIs URL:
a) Get All Reviewers:
GET /api/get-all-reviewer

b) Reviews for a particular talk proposal:
GET /api/talk-proposals-reviews/{proposal_id}

c) API endpoint for fetching statistics about talk proposals
GET /api/talk-proposals-statistics