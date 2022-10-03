# Self Hosted setup
I've used a Raspberry Pi to host this over the last 4 years (different domains, but same hardware). Usage is very very light. 10~30 form posts a week for each season.

Access to a Google e-mail account is recommended (and what I configure in these docs)

The following commandline is for a Ubuntu OS - please correct for your distro:
<pre>
# apt install nginx php-fpm postfix certbot
</pre>

Once done, please clone this project into /var/www/html

## Configure webservice

Ensure your /etc/nginx/sites-enabled/default looks something like so:

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

After adding Certbot and running it, your /etc/nginx/sites-enabled/default file should contain a new block like so:

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

