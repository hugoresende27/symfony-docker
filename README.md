## https://www.youtube.com/watch?v=j6T32WGyz_o&list=PLk294aochS5C1JYXVvF0RJAhFUaApbB2L

# TUTORIAL 1

Hello !!!
- how to run a symfony fresh project with docker using dunglas/symfony-docker ??

 1. git clone  https://github.com/dunglas/symfony-docker.git

 2.   cd symfony-docker 

 3.   docker compose build --no-cache

 4.   docker compose up --pull always -d --wait

 5.   https://localhost/

 6.   docker ps

 7.   docker exec -it name bash

 8.   composer require symfony/maker-bundle --dev

 9.   composer require twig

 10.  php bin/console make:controller HomeController

 11.  change  : 'app_home' 

 12.  change in template   




# TUTORIAL 2

- how to use mysql DB with dunglas/symfony-docker ??

 1. docker ps

 2. docker exec -it symfony-docker-php-1 bash

 3. composer require symfony/orm-pack



 4. edit compose.yaml
  - DATABASE_URL: mysql://${MYSQL_USER:-app}:${MYSQL_PASSWORD:-!ChangeMe!}@database:3306/${MYSQL_DATABASE:-app}?serverVersion=${MYSQL_VERSION:-8}&charset=${MYSQL_CHARSET:-utf8mb4}
  - image: mysql:${MYSQL_VERSION:-8}
  - MYSQL_DATABASE: ${MYSQL_DATABASE:-app}
  - MYSQL_RANDOM_ROOT_PASSWORD: "true"
  - MYSQL_PASSWORD: ${MYSQL_PASSWORD:-!ChangeMe!}
  - MYSQL_USER: ${MYSQL_USER:-app}
  - test: ["CMD", "mysqladmin" ,"ping", "-h", "localhost"]
  - database_data:/var/lib/mysql:rw



 5. edit compose.override.yaml
  - port to "3306"



 6. Dockerfile
  - RUN install-php-extensions pdo_mysql



 7. .env
  - DATABASE_URL=mysql://${MYSQL_USER:-app}:${MYSQL_PASSWORD:-!ChangeMe!}@database:3306/${MYSQL_DATABASE:-app}?serverVersion=${MYSQL_VERSION:-8}&charset=${MYSQL_CHARSET:-utf8mb4}



 8. docker compose down --remove-orphans && docker compose build --pull 



 9. docker compose up -d



 10. docker compose exec php bin/console dbal:run-sql -q "SELECT 1" && echo "OK" || echo "Connection is not working"


# TUTORIAL 3

- how to create an Entity CRUD Controller with twig views ??

 1. php bin/console make:entity Task 
   - title - string
   - description - string
   - status - boolean
   - created_at - datetime


 2. php bin/console make:migration


 3. php bin/console doctrine:migrations:migrate (to rollback : php bin/console doctrine:migrations:migrate prev)


 4. composer require form validator 


 5. php bin/console make:form TaskType (Task)


 6. Now lets make Task CRUD :
  - composer require security-csrf 
  - php bin/console make:crud Task (TaskController)


 7. Check the routes : php bin/console debug:router


 8. Let's add bootstrap to base.html https://getbootstrap.com/docs/5.0/getting-...
  - class="p-5"


 9. Symfony generated a nice boilerplate for you, add data edit or delete


 # TUTORIAL 4

 - [Symfony Tutorials] : How to consume an API using symfony ?

	1. For this example lets use TMDB (https://developer.themoviedb.org/docs/getting-started)

		- get a key in the website above

		- create TMDBService in src/Services

	2. add this vars to .env :
		TMDB_BASE_URL='https://api.themoviedb.org/'
		TMDB_APIKEY='XXXXXXXXXX'

	3. add to config/services.yaml
		api.tmdb_base_url : '%env(TMDB_BASE_URL)%'
    	api.tmdb_apikey : '%env(TMDB_APIKEY)%'

    4. check the parameters with command php bin/console debug:container --parameters

    5. composer require guzzlehttp/guzzle (we will use guzzle to consume the TMDB api)

    6. Create the functions construct, callApi and getMovies (3/discover/movie) function in TMDBService

    7. Make a controller  php bin/console make:controller Front\\MoviesController

    8. Create function construct with TMDBService 

    9. Edit function index for callMovies() from TMDBService and return to the view

    10. Edit front/movies index.html.twig with a for loop and show title and image of the movie, add some style


    


# TUTORIAL 5

 - [Symfony Tutorials] : How to Implement Authentication and Authorization with Symfony ?


---- to run project : docker compose up --pull always -d --wait


    1. composer require maker orm validator security twig , this will add :

      - orm: This bundle allows us to use an ORM (Symfony defaults to Doctrine)
      - validator: This bundle is used for input validation.
      - maker: This package (referred to as a bundle in Symfony) is used for code generation.
      - security: all security aspects of our application and will be used for the authentication process.
      - twig: Twig is the default templating engine for Symfony.

    2. composer require symfony/security-bundle

    4. php bin/console make:user (username as UNIQUE)

    5. bin/console make:security:form-login (https://symfony.com/doc/current/security.html#form-login php)

    6. php bin/console make:registration for registration form and routes (no no yes no)

    7. php bin/console make:migration && php bin/console doctrine:migrations:migrate

    8. create partials/header.html.twig and add it to base.html.twig and add css/style.css in public

                /* public/css/styles.css */
                header {
                    background-color: #333;
                    padding: 1rem;
                }

                nav ul {
                    list-style-type: none;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                }

                nav ul li {
                    display: inline;
                    margin-right: 10px;
                }

                nav ul li a {
                    color: white;
                    text-decoration: none;
                }

    9. Edit base html with {% if is_granted('IS_AUTHENTICATED_FULLY') %}

    10. Lets add some style to register template, get the code at github repo https://github.com/hugoresende27/symfony-docker/blob/tutorial-5/templates/registration/register.html.twig

    11. Browse in localhost, try to register and login

    12. Lets handle duplicate username with a try catch :
             try {
                $entityManager->persist($user);
                $entityManager->flush();

                // Log the user in after registration
                return $security->login($user, 'form_login', 'main');
            } catch (UniqueConstraintViolationException $e) {
                // Handle the duplicate username error
                $this->addFlash('error', 'Username already exists. Please choose a different one.');
            }

        - add this to template register : 
            {% for message in app.flashes('error') %}
                <div class="alert alert-danger">{{ message }}</div>
            {% endfor %}


    13. Register and login, test routes with logout 

    14. Edit Task and Movie Controller #[IsGranted('IS_AUTHENTICATED_FULLY')] 

    Thank you for watching !!!!

    By Hugo Resende.....

    visit github/hugoresende27 to get source code !


    

    


