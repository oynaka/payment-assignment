# Stripe Payment Test App

## Prerequisites
1. [Docker Desktop](https://www.docker.com/products/docker-desktop/), choose one for your OS
2. [Git for Windows](https://git-scm.com/download/win) or (Git for MacOS)[https://git-scm.com/download/mac], choose one for your OS
___
## How to Run the Application
1. Make sure you have Docker Desktop service started.
2. Clone this repository to your local machine.
3. Open Terminal and navigate to the directory of the project.
4. Run the following command to build the Docker image.
```
docker-compose build
```
5. Once finish without any error, run the following command to start all requird services in the container.
```
docker-compose up -d
```
6. Once the application started, you need to install the required packages of Laravel since this application was developed with Laravel. In order to do that, run the following command.
```
docker-compose exec laravel_app php composer.phar install
```
7. If all packages successfully installed without any critical error (some warning is acceptable), open your browser to [http://localhost:8082/](http://localhost:8082/) to see the application.
8. If you finish all checking and no longer need this application, feel free to run the following command to stop the container.
```
docker-compose down
```
9. After stopping container successful, you are free to delete it from the container list in Docker Desktop app dashboard.
___
## How to Run Unit Test
While the service is still active in Docker, run the following command to run the unit test.
```
docker-compose exec laravel_app php artisan test
```

---

##  The architecture and the design were adopted to solve the challenges


I used a simple view and API controller of Laravel to create an API endpoint since it's very easy to implement via the framework as well as Bootstrap for a little help in look and feel. 

After that, I applied the Striped PHP library to help me in all the simple payment process and that's all for this application.