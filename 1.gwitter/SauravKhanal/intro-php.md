<h1> Starting PHP</h1>

This guide provides instructions on how to start a PHP development environment using either Apache or the built-in PHP server. It also covers debugging PHP and handling sessions.
1.Using Apache

Start the Apache service:

``` sudo service apache2 start```

By default, Apache serves files located in the /var/www/html/ directory at localhost on port 80.

- To serve over HTTPS on port 443, configure SSL/TLS certificates and update the Apache configuration.

1. Changing the default project location:
    - Open the Apache configuration file located at `/etc/apache2/sites-available/000-default.conf` using a text editor.
    - Update the DocumentRoot directive to the desired project directory.
    -  Save the changes and restart Apache to apply the new configuration.

<h1> Using the Built-in PHP Server</h1>

2.Navigate to your project directory in the terminal:

``` cd /path/to/your/project ```

3.Start the PHP development server:

```php -S 0.0.0.0:8000 -t .```

Your application will be served with the current directory as the web root, accessible at `localhost:8000.`
- Note that the built-in PHP server is suitable for development purposes, but a production-grade web server like Apache is recommended for production environments.

<h1> Debugging PHP</h1>

To enable logging in Apache:

1. Locate the Apache configuration file (typically at /etc/apache2/apache2.conf).
1. Uncomment the ErrorLog directive and specify the desired log file path.

For viewing PHP errors within the PHP server:

- Add the following lines at the beginning of your PHP script:
```bash 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);```

# These lines enable error reporting and display PHP errors and warnings on the page.