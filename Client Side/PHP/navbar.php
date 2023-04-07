
<?php
// Check if the user is logged in and is an admin
if (isset($_SESSION["id"]) && isset($_SESSION["is_admin"]) && $_SESSION["is_admin"] === true) {
    $links = array(
        array(
            "name" => "Your Basket",
            "url" => "accountBasket.php"
        ),
        array(
            "name" => "Your Profile",
            "url" => "customer.php"
        ),
        array(
            "name" => "Admin Portal",
            "url" => "admin.php"
        ), 
        array(
            "name" => "Log Out",
            "url" => "logout.php"
        )
    );
} else if (isset($_SESSION["id"])) {
    $links = array(
        array(
            "name" => "Your Basket",
            "url" => "accountBasket.php"
        ),
        array(
            "name" => "Your Profile",
            "url" => "customer.php"
        ),
        array(
            "name" => "Log Out",
            "url" => "logout.php"
        )
    );
} else {
    $links = array(
        array(
            "name" => "Register/Login",
            "url" => "login.php"
        )
    );
}
?>
<div class="flex-container">
    <div>
        <a href="home.php"><svg height="1em" width="1em" version="1.1" id="_x36_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000">
            <g id="SVGRepo_bgCarrier" stroke-width="0"/>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
            <g id="SVGRepo_iconCarrier"> <g> <path style="fill:none;" d="M250.294,7.715c-22.499,8.598-42.747,33.586-54.237,65.244l109.277,2.491 C294.005,42.667,273.355,16.553,250.294,7.715z"/> <path style="fill:none;" d="M293.845,12.535c15.267,16.794,27.239,39.212,34.631,63.398l10.928,0.241 C329.681,47.811,313.049,24.266,293.845,12.535z"/> <path style="fill:none;" d="M162.631,72.157l10.606,0.241c7.392-22.82,18.963-43.871,33.506-59.863 C188.504,23.705,172.514,45.561,162.631,72.157z"/> <g> <g> <g> <path style="fill:#756B5E;" d="M336.672,140.295c0,5.865-4.982,10.525-11.089,10.525c-6.026,0-11.008-4.659-11.008-10.525 c0-17.838-3.375-35.517-9.241-51.426c-11.329-31.336-31.98-56.246-55.04-64.681c-5.544-2.091-11.169-3.135-16.874-3.135 c-9.08,0-18.079,2.733-26.596,7.633c0,0,0,0-0.08,0.08c-18.239,10.687-34.229,31.579-44.113,56.97 c-6.508,16.794-10.365,35.515-10.365,54.559c0,5.865-4.901,10.525-11.008,10.525c-6.026,0-11.008-4.659-11.008-10.525 c0-18.32,3.375-37.284,9.562-55.041C155.801,38.73,190.754,0,233.42,0c5.786,0,11.41,0.724,16.874,2.091 c16.231,3.935,30.935,13.498,43.47,26.595c0,0.08,0.081,0.08,0.081,0.08c15.267,16.07,27.239,37.445,34.631,60.505 C333.779,105.985,336.672,123.34,336.672,140.295z"/> </g> <g> <polygon style="fill:#C7CD7A;" points="442.414,489.18 80.03,511.92 83.244,387.777 85.574,298.104 85.735,292.56 90.958,88.147 90.958,86.46 91.038,84.21 139.811,85.254 162.631,85.736 173.237,85.897 196.057,86.46 305.335,88.869 328.476,89.271 339.404,89.512 362.384,90.075 392.114,90.717 394.203,90.799 399.507,90.878 420.317,91.28 421.523,112.813 421.844,119.081 "/> </g> <g> <polygon style="fill:#B5BB82;" points="94.493,86.058 84.288,386.812 80.03,511.92 80.03,512 48.372,500.591 30.132,494.001 0,483.073 1.366,465.959 1.366,465.235 2.089,456.398 30.935,87.343 64.361,89.512 90.958,86.46 "/> </g> <g style="opacity:0.5;"> <polygon style="fill:#C7CD7A;" points="4.546,481.853 78.493,508.804 52.007,471.992 "/> </g> <g style="opacity:0.1;"> <polygon style="fill:#040000;" points="92.562,87.289 91.554,88.095 65.307,92.927 52.007,471.992 78.493,508.804 "/> </g> <g> <ellipse style="fill:#E5E8F5;" cx="174.963" cy="145.515" rx="15.428" ry="14.732"/> </g> <g> <ellipse style="fill:#E5E8F5;" cx="359.304" cy="145.515" rx="15.428" ry="14.732"/> </g> <g> <path style="fill:#A2957F;" d="M370.339,140.295c0,5.865-4.982,10.525-11.008,10.525c-6.107,0-11.008-4.659-11.008-10.525 c0-1.689,0-3.294-0.08-4.983v-0.563c-0.643-15.668-3.777-31.095-8.839-45.237c-9.722-27.079-26.355-49.576-45.559-60.746 c0,0-0.081,0-0.081-0.08c-8.517-4.9-17.517-7.633-26.596-7.633c-5.705,0-11.329,1.044-16.874,3.135 c-22.499,8.196-42.747,32.058-54.237,62.272c-5.786,15.105-9.402,31.819-9.964,48.852v0.081c-0.08,1.687-0.08,3.213-0.08,4.902 c0,5.865-4.982,10.525-11.089,10.525c-6.026,0-11.008-4.659-11.008-10.525c0-1.689,0-3.455,0.16-5.224 c0.482-16.47,3.696-33.265,9.16-49.174c7.392-21.775,18.963-41.863,33.506-57.131c0.08-0.08,0.08-0.08,0.08-0.08 c12.535-13.096,27.239-22.66,43.47-26.595C255.758,0.724,261.383,0,267.168,0c18.481,0,35.435,7.313,50.059,19.285 c0.241,0.161,0.482,0.322,0.723,0.563c3.937,3.133,7.633,6.748,11.169,10.687c0.241,0.239,0.482,0.481,0.642,0.722 c14.383,15.909,25.712,36.641,32.623,58.818c2.571,8.276,4.58,16.873,5.946,25.471c1.045,6.509,1.607,13.016,1.848,19.525 C370.339,136.84,370.339,138.606,370.339,140.295z"/> </g> </g> <polygon style="opacity:0.06;fill:#040000;" points="442.414,489.18 80.03,511.92 80.03,512 48.372,500.591 30.132,494.001 0,483.073 1.366,465.959 1.768,465.637 53.996,415.739 82.521,388.419 83.244,387.777 84.288,386.812 348.243,134.749 368.33,115.546 394.203,90.799 394.284,90.717 399.507,90.799 420.317,91.28 421.523,112.813 421.844,119.081 "/> </g> </g> </g>
            </svg>X-TREME GPT (grocery price tracker)
        </a>
    </div>
    <nav class="navbar">
        <ul class="nav-links">
            <?php
            if(isset($_SESSION["username"])) { 
                echo "<li id='welcome-msg'>Welcome, ".$_SESSION["username"]."!</li>";
            }
            foreach ($links as $link) {
                if($link["welcomeMsg"] = "") { 

                }
                echo "<li class='nav-item'><a href='" . $link["url"] . "'>" . $link["name"] . "</a></li>";
            }
            ?>
        </ul>
    </nav>
</div>
