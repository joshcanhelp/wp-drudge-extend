# WP-Drudge Actions and Filters
This is a functioning plugin that, on its own, does nothing. All active actions and filters have an example included here but the action or filter itself has been commented out. Best thing to do is to create your own plugin using this example and only include the actions you was to use. 

A general process to follow:

1. Create a new folder in your WordPress install at /wp-content/plugins/ and create a .php file with the same slug. For example, this plugin is in a folder called wp-drudge-extend and the plugin file is called wp-drudge-extend.php.
2. Use the first comment block in wp-drudge-extend.php to give the plugin a name, description, and other information in wp-admin. 
3. Copy and paste the actions and filters you'd like to use from this example plugin into your custom one. 
4. Once you're ready to test things out, log into your site as an admin and go to **wp-admin > Plugins**.
5. Look for the the plugin you added and click **Activate**

Hooks and filters are documented a bit in this plugin, as well as on the [documentation page here](http://wpdrudge.com/docs/extending-wp-drudge/hooks-and-filters). If you have any issues with the code here, open a GitHub issue, create a pull request, or post on the [support forums](https://theproperweb.com/support/forum/wp-drudge/customization/). 