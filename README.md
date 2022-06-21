REQUISITOS:
-XAMPP CON PHP 8.X.
-COMPOSER INSTALADO.
-NODE? (PUEDE QUE QUIZAS LO OCUPES, POR ALGUNAS CUESTIONES DE UNA API QUE UTILIZA NODE Y DEPENDENCIAS).


1. Al descargar el repositorio, llegara sin las librerias que estan en la carpeta Vendor. 
    Para reestablecer el proyecto, te ubicas dentro del proyecto y ejecuta el comando:
    "composer install"

2. Composer instalara las dependencias que esten especificadas en "composer.json". Ahora al instalar
    las dependencias, deberías poder visualizar el proyecto correctamente (hasta cierto punto).
    La situación en la que probablemente estes, es que podras ver el inicio, pero quizas no puedas ver
    las páginas que ya están creadas. 

    Para eso debes levantar un servidor local. Configurar virtual host en: 

                    C:\xampp\apache\conf\extra\httpd-vhost.conf

    Y configurar tambien en: 

                    C:\Windows\System32\drivers\etc

3. El texto que necesitas para crear el servidor en apache acorde a lo que tengo yo es:

    <VirtualHost *>
        DocumentRoot "C:\xampp\htdocs\nombre_de_la_carpeta"
        ServerName nombre_de_tu_dominio
            <Directory "C:\xampp\htdocs\nombre_de_la_carpeta">
                Options All
                AllowOverride All
                Require all granted
            </Directory>
    </VirtualHost>

    Y el de host para tener el "servidor" como si fuera una dirección de internet es:

    [Dirección ip]     [Nombre de tu dominio]    --Esto lo puedes ignorar, es una guía simplemente.
    127.0.0.1	       laboratorio.test

4. Ahora bien, no recuerdo o no sé si te dara fallas para implementar el proyecto adecuadamente, 
    así que cuando hagas estos pasos, ejecuta el comando :

    "npm install"   ,luego: 
    'npm ci'        ,y finalmente:
    'npm run dev'.

    Esto no es más para la API que estoy usando en la autenticación de usuarios, Laravel Jetstream.

5. Suerte...

6. Posdata, el demo de la plantilla quizás no te funcione bien (creo que por algo interno o se debe crear 
    un servidor local, así que puedes checar, la demo en línea).
        https://www.nobleui.com/laravel/template/demo1/
