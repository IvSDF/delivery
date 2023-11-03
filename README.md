# delivery_test

Requirements: You need to have docker installed (If you do not use docker, you must have at least PHP 8.0.2 and composer installed)

Download the project to a directory and open it in the terminal

Execute the command -

<pre> docker compose up -d --build</pre>

Enter the docker container using the command -

<pre>$ docker exec -it dt_app /bin/bash</pre>

Execute the commands in turn -

<pre>
<span>$ composer update</span>
<span>$ chmod -R 775 storage</span>
<span>$ chmod -R ugo+rw storage</span>
</pre>

Rename the file .env.example to .env



Implement the logic:

namespace App\Http\Controllers;
class DeliveryController 

namespace App\Services;
interface CourierService
class CourierServiceFactory
class NovaPoshtaService

config/delivery.php
