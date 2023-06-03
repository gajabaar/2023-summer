## Starting PHP

```bash
sudo service apache2 start
```
By default this will serve `/var/www/html/` at `localhost:80`?

Questions:
- Does this also server `https` over port `443`?
- Where is the configuration file for apache2 to change the default location of your project?

Another way to start the service is to be inside your project and start the server provided
by PHP itself, instead of the apache server.
```bash
.../axyut$ php -S 0.0.0.0:8000 -t .
```
This will serve your application with current directory as web root.

## Debugging PHP
// about turning on log data on apache2
// about viewing log within the php server
Tip: Some (configuration) changes will require restarting apache2 or the php server.
If you have made the changes, try to confirm by restarting.

## Session handling in PHP


