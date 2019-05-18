# employee_management
Simple Symfony 4 CRUD Example Application with user authentication based on Employee Management. Basically it's a beginner's guide with Symfony 4.

In this application, we covered User Authentication, basic CRUD operation with file uploading, consume data from third party API and we created an API to share employee data publicly

Please follow the instruction below to setup the project

* After checking out the repository, please navigate to project root directory (ie. employee_management), the run following commands
* You can manually create the database or can execute this command - **php bin/console doctrine:database:create**
* As we added the DB migration script, you populate the tables by executing this command - **php bin/console doctrine:migrations:migrate**
* Finally, to populate applications user, please execute - **php app/console doctrine:fixtures:load**

#Credential for populated application user

* User Name: **admin**
* Password: **123456**

