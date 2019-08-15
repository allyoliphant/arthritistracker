<?php   

    // Class to put repeated content in one place and echo where needed
    // to help maintaince consistency throughout the code
    class Page {
        
        // echo repeated header content
        public function header($loggedIn) {
            echo "
            <title>arthritis tracker</title>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel='shortcut icon' href='favicon.ico' type='image/x-icon'>
            <link rel='icon' href='favicon.ico' type='image/x-icon'>
            <link rel='stylesheet' href='/index.min.css'>
            <script src='https://code.jquery.com/jquery-3.4.1.min.js' type='text/javascript'></script>
            <script src='/js/min/footer.min.js'></script>      
            ";

            // stuff to echo if the user is logged in
            if ($loggedIn) {
                echo "            
                <script src='/js/min/mobile.min.js'></script>
                <script src='/js/min/logout.min.js'></script>
                <!-- jQuery Modal -->
                <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js'></script>
                <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css'/> 
                ";
            }            
        }
        
        // echo repeated navigation content
        public function navigation($currentPage) {
            echo "
            <div class='side nav'>
                <a href='/home/home.php'><img src='/img/logo.png' width='70px' height='70px'/></a>
                <a class='button' href='/new-entry/new-entry.php'>new entry</a>
                <p id='history-section-title'>entry history</p>
                <a class='button' href='/entry-history/year/year.php'>year</a>
                <a class='button' href='/entry-history/month/month.php'>month</a>
                <a class='button' href='/entry-history/day/day.php'>day</a>
                <a class='button' id='account-nav-button' href='/account/account.php'>account</a>
                <a class='button' href='/logout/logout.php' rel='ajax:modal'>logout</a>
            </div>
            <div class='mobile nav'>	
                <a href='/home/home.php'><img id='mobile-logo' src='/img/logo.png' width='40px' height='40px'/></a>
                <div id='menuToggle'>	
                    <input type='checkbox' />			
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>	
            <div class='mobile-menu'>
                <a class='mobile-btn' href='/new-entry/new-entry.php'>new entry</a>
                <p id='history-section-title'>entry history</p>
                <a class='mobile-btn' href='/entry-history/year/year.php'>year</a>
                <a class='mobile-btn' href='/entry-history/month/month.php'>month</a>
                <a class='mobile-btn' href='/entry-history/day/day.php'>day</a>
                <a class='mobile-btn' id='account-nav-button' href='/account/account.php'>account</a>
                <a class='mobile-btn' href='/logout/logout.php' rel='ajax:modal'>logout</a>
            </div>
            <script type='text/javascript'>
                var sideButtons = document.querySelectorAll('.side .button');
                var mobileButtons = document.querySelectorAll('.mobile-menu .mobile-btn');
                var current = '" . $currentPage . "';
                sideButtons.forEach( function(button) { 
                    if (button.innerText == current) {
                        button.classList.add('current-page');
                    }
                });
                mobileButtons.forEach( function(button) { 
                    if (button.innerText == current) {
                        button.classList.add('current-page');
                    }
                });
            </script>
            ";
        }
        
        // echo footer
        public function footer() {
            echo "
            <div class='footer'>
                <div class='footer-content'>
                    <hr/>
                    arthritis tracker | ally oliphant | 2019
                </div>				
            </div>
            ";
        }
    }
?>