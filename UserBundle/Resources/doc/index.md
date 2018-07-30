#Bundle simple para usuario con login, registro y una plantilla


#Cargar en el kernel

            new UserBundle\UserBundle(),

#Chequear en el composer.json que se incluya en el autoload el bundle ejemplo:

    "autoload": {
        "psr-4": {
            "AppBundle\\": "src/AppBundle",
            "UserBundle\\": "src/UserBundle"
        },
        "classmap": [ "app/AppKernel.php", "app/AppCache.php" ]
    },

#Luego ejecutar

composer dump-autoload

#Agregar en app/config/routing.yml

user:
    resource: "@UserBundle/Controller/"
    type:     annotation
    prefix:   /    

#Agregar en app/config/services.yml


    UserBundle\Controller\:
        resource: '../../src/UserBundle/Controller'
        public: true
        tags: ['controller.service_arguments']       

#Actualizar app/config/security.yml

# To get started with security, check out the documentation:
# https://symfony.com/doc/current/security.html
security:

    encoders:
        UserBundle\Entity\User:
            algorithm: bcrypt

    # https://symfony.com/doc/current/security.html#b-configuring-how-users-are-loaded
    providers:
        our_db_provider:
            entity:
                class: UserBundle:User
                property: username

    firewalls:
        # disables authentication for assets and the profiler, adapt it according to your needs
        dev:
            pattern: ^/(_(profiler|wdt)|css|images|js)/
            security: false
        main:
            pattern:    ^/
            http_basic: ~
            provider: our_db_provider
            anonymous: ~
            form_login:
                login_path: login
                check_path: login  
            logout:
                path:   /logout
                target: /                          
            
    access_control:
        # require ROLE_ADMIN for /admin*
        - { path: ^/admin, roles: ROLE_ADMIN }   


#Ejecutar el comando

php bin/console assets:install             