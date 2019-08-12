# arthritis tracker

I built this website for my Intro to Web Development class but have continued to develop it since the class ended. It is designed to help me better track my arthritis.

Website: <https://arthritistracker.herokuapp.com>.

## Organization of the code

Pages are seperated into folders.

Class files have the first letter capitalized (*Dao.php*, *Page.php*, etc.). All other files are lowercase.

## Setting up locally

### Setting up wamp

I use wamp (<http://www.wampserver.com/en/>) for my local server. It can be a little tricky to setup so if you already have something that can run php locally, I would keep using that.

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

If your repo will be public, I suggest setting your database's values outside of the code like I have.

If you are using wamp, you can update the *httpd-vhosts.conf* file to set enviroment variables. (I would do this after you have setup your local server in *Setting up wamp*.)

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

To get to the *httpd-vhosts.conf* file, left click on the wamp icon, click/hover over *Apache*, and click on *httpd-vhosts.conf*.

    ![click on Apache](/img/readme/click-on-apache.png)
    ![click on file](/img/readme/click-on-file.png)

You can also get to the *httpd-vhosts.conf* file by going into your wamp directory and searching for the file.
