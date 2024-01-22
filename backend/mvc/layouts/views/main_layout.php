<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./public/responsivity/responsivity.css">
    <link rel="stylesheet" href="./backend/mvc/layouts/views/main_layout.css">
</head>

<body>
<div style="display: flex; flex-direction: row; justify-content: space-between;">
    <div class="bar-button">
        <span style="font-size:30px;cursor:pointer" onclick="changeSideNavVisibility();">&#9776;</span>
    </div>
    <div class="top-nav">
    
        <a href="#" id="home"  onclick="loadContent(this);"><i class="fa fa-fw fa-home"></i> Home</a>
        <a href="#" id="signIn"  onclick="loadContent(this);"><span class="fa fa-fw fa-user"></span> Sign In</a>
        <a href="#" id="signUp"  onclick="loadContent(this);"><span class="fa fa-fw fa-user"></span> Sign Up</a>
    </div>
</div>


    <div class="container">
    <div id="mySidenav" class="side-nav side-nav-visible">
        
        
        <div class="submenu">
            <a href="#" id="services" class="menu-item" onclick="toggleServicesDropdown();"> <span class="fa fa-fw fa-wrench"></span>Services <span class="fa fa-fw fa-caret-down" id="servicesCaret"></span></a>
            <div class="dropdown-content" id="servicesDropdown" style="display: none;">
                <a href="#" id="showServices" onclick="loadContent(this);">Show Services</a>
                <a href="#" id="bestDeals" onclick="loadContent(this);">Best Deals</a>
                <a href="#" id="lookingFor" onclick="loadContent(this);">Looking For</a>
            </div>
        </div>

        <div class="submenu">
            <a href="#" id="wallet" class="menu-item" onclick="toggleWalletDropdown();"> <span class="fa fa-fw fa-credit-card"></span>Wallet <span class="fa fa-fw fa-caret-down" id="walletCaret"></span></a>
            <div class="dropdown-content" id="walletDropdown" style="display: none;">
                <a href="#" id="makePurchase" onclick="loadContent(this);">Make Purchase</a>
                <a href="#" id="history" onclick="loadContent(this);">History</a>
            </div>
        </div>
        
        
        
        
        <a href="#" id="about" class="menu-item" onclick="loadContent(this);"> <span class="fa fa-fw fa-info-circle"></span>About us</a>
        <a href="#" id="contact" class="menu-item" onclick="loadContent(this);"> <span class="fa fa-fw fa-address-book"></span>Contact us</a>
        <a href="#" id="people" class="menu-item" onclick="loadContent(this);"> <span class="fa fa-fw fa-user"></span>DEBUG DB</a>
    </div>

    <div class="view-area" id="view-area">
        <object id="viewArea" type="text/html" data="" style="width:100%; height:100%; margin:0; padding:0;"></object>
    </div>
</div>


<script>
    function changeSideNavVisibility() {
        var sideNav = document.getElementById("mySidenav");
        if (sideNav.classList.contains("side-nav-visible")) {
            sideNav.classList.remove("side-nav-visible");
            sideNav.style.display = "none";
            sideNav.style.visibility = "hidden";
        } else {
            sideNav.classList.add("side-nav-visible");
            sideNav.style.display = "";
            sideNav.style.visibility = "visible";
        }
    }

    function navItemClicked(element) {
        var navElements = document.querySelectorAll('.top-nav a, .side-nav a');
        navElements.forEach((elem) => {
            elem.classList.remove("active");
        });
        if (element) {
            element.classList.add("active");
        }
    }

    function loadContent(element) {
        navItemClicked(element);
        var viewAreaElement = document.getElementById("viewArea");
        var pageId = element ? element.id : 'home';

        switch(pageId) {

            
            case "signUp":
                viewAreaElement.setAttribute("data", "./app.php?service=loginUser");
                break;
            case "signIn":
                viewAreaElement.setAttribute("data", "./app.php?service=registerUser");
                break;
            case "showServices":
                viewAreaElement.setAttribute("data", "./app.php?service=showServices");
                break;
            case "bestDeals":
                viewAreaElement.setAttribute("data", "./app.php?service=bestDeals");
                break;
            case "lookingFor":
                viewAreaElement.setAttribute("data", "./app.php?service=lookingFor");
                break;
            case "home":
                viewAreaElement.setAttribute("data", "./app.php?service=defaultPage");
                break;
            case "about":
                viewAreaElement.setAttribute("data", "./app.php?service=showAbout");
                break;
            case "contact":
                viewAreaElement.setAttribute("data", "./app.php?service=showContact");
                break;
            case "people":
                viewAreaElement.setAttribute("data", "./app.php?service=showPeopleAsTable");
                break;
            default:
                viewAreaElement.setAttribute("data", "");
                break;
        }
    }

    // Carregar conteúdo da página 'Home' por padrão
    window.onload = function() {
        loadContent(document.getElementById('home'));
    };

        function toggleServicesDropdown() {
    var servicesDropdown = document.getElementById("servicesDropdown");
    var servicesCaret = document.getElementById("servicesCaret");
    if (servicesDropdown.style.display === "block") {
        servicesDropdown.style.display = "none";
        servicesCaret.classList.remove("fa-caret-up");
        servicesCaret.classList.add("fa-caret-down");
    } else {
        servicesDropdown.style.display = "block";
        servicesCaret.classList.remove("fa-caret-down");
        servicesCaret.classList.add("fa-caret-up");
    }
}

function toggleWalletDropdown() {
    var walletDropdown = document.getElementById("walletDropdown");
    var walletCaret = document.getElementById("walletCaret");
    if (walletDropdown.style.display === "block") {
        walletDropdown.style.display = "none";
        walletCaret.classList.remove("fa-caret-up");
        walletCaret.classList.add("fa-caret-down");
    } else {
        walletDropdown.style.display = "block";
        walletCaret.classList.remove("fa-caret-down");
        walletCaret.classList.add("fa-caret-up");
    }
}
</script>

</body>

</html>
