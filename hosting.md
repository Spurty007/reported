# Self Hosted setup
I'm using a Raspberry Pi to host this. 

You also need a Google Mail account 

Installing the following (Ubuntu used as an example)
<pre>
# apt install nginx php-fpm postfix certbot
</pre>

## Configure webservice

Drop the contents of this project into /var/www/html

Your /etc/nginx/sites-enabled/default
<pre>
server {
    listen 80 default_server;
    root /var/www/html;
    server_name FQDN;
    index index.html index.htm index.nginx-debian.html;
    access_log /var/log/nginx/ssl-FQDN-access.log;
    error_log /var/log/nginx/ssl-FQDN-error.log;
}
</pre>

## Getting your cert with Certbot

Assumes you have a cert and FQDN. If you do not have this, you can skip this step, however moving forwards from 2022, users may be blocked by their devices rejecting non-SSL traffic.

<pre>
# certbot --certonly
</pre>

After adding Certbot and running it, your web service file should contain a new block like so:

<pre>
server {
    listen 443 ssl;
    server_name FQDN;
    root /var/www/html;
    index index.php index.html index.htm index.nginx-debian.html;
    access_log /var/log/nginx/ssl-FQDN-access.log;
    error_log /var/log/nginx/ssl-FQDN-error.log;
    # Certs
    ssl_certificate /etc/letsencrypt/live/FQDN/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/FQDN/privkey.pem;
    location ~ \.php$ {
        include fastcgi.conf;
        fastcgi_pass unix:/var/run/php/php-fpm.sock;
    }
}
</pre>
## Install & Configure Postfix
Instead of re-inventing the wheel, just going to point you off to the [docs I used](https://linuxscriptshub.com/configure-smtp-with-gmail-using-postfix/)

## Test

