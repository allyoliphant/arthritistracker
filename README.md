# arthritis tracker

I built this website for my Intro to Web Development class but have continued to develop it since the class ended. It is designed to help me better track my arthritis.

Website: <https://arthritistracker.herokuapp.com>.

## Organization of the code

Pages are seperated into folders.

Class files have the first letter capitalized (*Dao.php*, *Page.php*, etc.). All other files are lowercase.

## Setting up locally

Clone or download the repository.

![clone or download](/img/readme/clone-or-download.PNG)

### Setting up a local server

I use wamp for my local server. Download at <http://www.wampserver.com/en/>. I would save it outside of your repo.

Once downloaded, launch the application and you will notice the wamp icon appear in the taskbar.

![wamp icon](/img/readme/wamp-icon.PNG)

Left click the wamp icon, click/hover over **Your VirtualHost**, and click on **VirtualHost Managment**.

![virtualhost](/img/readme/virtualhost.PNG)
![virtualhost management link](/img/readme/virtualhost-management-link.png)

This will open up a virtualhost management tool in your browser. Fill in the two required fields and click the **Start the creation of the VirtualHost** button to create the virtualhost.

![virtualhost management](/img/readme/virtualhost-management.PNG)

Now when wamp is running, you can go to `yourvirtualhostname:portnumber` to see your code locally. For example, if I go to `tracker:8080`, the home page of the website loads.

### Setting up the database

Queries to create the tables used in this website can be found in *arthritis-tracker-db-tables.txt*.

If you are not going to be pushing your code to a public repo, you can replace the `getenv('...')` I have in the `getConnection()` method in *Dao.php* with your database's values.

    private function getConnection () {
        
        // change these lines
        $host = getenv('DB_HOST');  // database host/connection name
        $name = getenv('DB_NAME');  // name of the schema for the database
        $username = getenv('DB_USERNAME');  // username to get into the database
        $password = getenv('DB_PASSWORD');  // password to get into the database

        $conn = new PDO("mysql:host={$host};dbname={$name}", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }

If your repo will be public, I suggest setting your database's values outside of the code to keep the values secret.

If you are using wamp (or I believe any Apache server), you can update the *httpd-vhosts.conf* file to set enviroment variables. I would do this after you setup your local server in [Setting up a local server](#setting-up-a-local-server). You will need to restart wamp (left click wamp icon, click **Restart All Services**) for the changes to be available.

    <VirtualHost *:<port for your local server>>
        ServerName <name of your local server, normally localhost>
        SetEnv DB_HOST "<database host/connection name>"
        SetEnv DB_NAME "<name of the schema for the database>"
        SetEnv DB_USERNAME "<username to get into the database>"
        SetEnv DB_PASSWORD "<password to get into the database>"
        DocumentRoot "<direct path to your code>"
        <Directory  "<direct path to your code>">
            Options +Indexes +Includes +FollowSymLinks +MultiViews
            AllowOverride All
            Require local
        </Directory>
    </VirtualHost> 

You can then use the php method `getenv()` (<https://www.php.net/manual/en/function.getenv.php>) to get the variables you have setup and use them in your code to connect to your database.

To get to the *httpd-vhosts.conf* file, left click on the wamp icon, click/hover over **Apache**, and click on **httpd-vhosts.conf** to open the file.

![click on Apache](/img/readme/click-on-apache.png)
![click on file](/img/readme/click-on-file.png)

You can also get to the *httpd-vhosts.conf* file by going into your wamp directory and searching for the file. There may be multiple *httpd-vhosts.conf* files, so be careful about which one you change.
