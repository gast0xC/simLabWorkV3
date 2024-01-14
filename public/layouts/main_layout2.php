<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .side-bar {
            background: rgb(26, 26, 27);
            backdrop-filter: blur(15px);
            width: 290px;
            height: 100vh;
            position: fixed;
            left: 0px;
            top: 0;
            /*left: -100%; */
            overflow-y: auto;
            transition: 0.5s ease;
            /*transition-property: left;*/
        }
        .side-bar:not(.visible) {

            left: -290px;
            transition: 0.5s ease;
        }


        .side-bar .menu {
            width: 100%;
            margin-top: 100px;
        }

        .side-bar .menu .item {
            position: relative;
            cursor: pointer;
        }

        .side-bar .menu .item a {
            color: #fff;
            font-size: 16px;
            text-decoration: none;
            display: block;
            padding: 0px 30px;
            line-height: 50px;
        }

        .side-bar .menu .item a:hover:not(.active) {
            background: #8621F8;
            transition: 0.3s ease;
        }

        .side-bar a.active {
            background-color: #04AA6D;
            color: white;
        }

        .side-bar .menu .item i {
            margin-right: 15px;
        }

        .side-bar .menu .item a .dropdown {
            position: absolute;
            right: 0;
            margin: 20px;
            transition: 0.3s ease;
        }

        .side-bar .menu .item .sub-menu:not(.visible) {
            background: rgba(255, 255, 255, 0.1);
            display: none;
        }

        .side-bar .menu .item .sub-menu a {
            padding-left: 80px;
        }

        .rotate {
            transform: rotate(90deg);
        }


        .container.full_size {
            margin-left: 0px;
        }


        .container:not(full_size) {
            margin-left: 290px;
            transition: 0.5s ease;
        }



        .menu_icon_bars:not(.visible) {
            display: none;
        }

        .menu_icon_bars:hover {
            cursor: pointer;
        }





        .menu_icon_bars:hover {
            color: red;
            cursor: pointer;
        }




        

        .close-btn {
            position: relative;
            color: #fff;
            font-size: 20px;
            right: 0;
            margin: 25px;
            cursor: pointer;
        }

        #close-btn:hover {
            color: red;
        }

        .rotate {
            transform: rotate(90deg);
        }

        .close-btn {
            position: absolute;
            color: #fff;
            font-size: 20px;
            right: 0;
            margin: 25px;
            cursor: pointer;
        }


        .button_styled {
            border: 0;
            line-height: 2.5;
            padding: 0 20px;
            font-size: 1rem;
            text-align: center;
            color: #fff;
            text-shadow: 1px 1px 1px #9f7d9f;
            border-radius: 10px;
            background-color: rgb(78, 76, 76);
            background-image: linear-gradient(to top left, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2) 30%, rgba(0, 0, 0, 0));

        }

        .button_styled:hover {
            background-color: #8621F8;
        }

        .button_styled:active {
            box-shadow: inset -2px -2px 3px rgba(255, 255, 255, 0.6), inset 2px 2px 3px rgba(0, 0, 0, 0.6);
        }


        .view-area {
            all: initial;
            background-color: white;
            display: inline-block;
            vertical-align: top;
            height: 100%;
            width: 100%;
            flex-grow: 100;
        }
    </style>
</head>

<body>
    <div class="main" style="display:flex; flex-direction:row; width:100%">
        <div class="side-bar visible" id="side-bar">

            <div class="close-btn" style="display: flex; flex-direction: row;  align-items: center;">
                <img src="public/images/sideMenuLogo.png" alt="sideMenuLogo" width="150" height="65">
                <i class="fas fa-times" style="margin-left: 50px;" onclick="ControlLeftSideVisibility()"></i>
            </div>

            <div class="menu">
                <div class="item"><a href="#" onclick="menuItemSelected(event.target);"><i class="fas fa-desktop"></i>Dashboard</a></div>
                <div class="item"><a href="#" onclick="menuItemSelected(event.target);"><i class="fas fa-th"></i>People</a></div>
                <div class="item">
                    <a class="sub-btn" onclick="groupMenuClicked(event.target);"><i class="fas fa-table"></i>Products<i class="fas fa-angle-right dropdown"></i></a>
                    <div class="sub-menu">
                        <a href="#" class="sub-item" onclick="menuItemSelected(event.target);">Show Products</a>
                        <a href="#" class="sub-item" onclick="menuItemSelected(event.target);">Warehouses</a>
                        <a href="#" class="sub-item" onclick="menuItemSelected(event.target);">History</a>
                    </div>
                </div>

                <div class="item">
                    <a class="sub-btn" onclick="groupMenuClicked(event.target);"><i class="fas fa-cogs"></i>Purchases<i class="fas fa-angle-right dropdown"></i></a>
                    <div class="sub-menu">
                        <a href="#" class="sub-item" onclick="menuItemSelected(event.target);">Make purchase</a>
                        <a href="#" class="sub-item" onclick="menuItemSelected(event.target);">Process payments</a>
                        <a href="#" class="sub-item" onclick="menuItemSelected(event.target);">History</a>
                    </div>
                </div>
                <div class="item"><a href="#" onclick="menuItemSelected(event.target);"><i class="fas fa-info-circle"></i>About Us</a></div>
                <div class="item"><a href="#" id="playVideo" onclick="menuItemSelected(event.target);"><i class="fas fa-info-circle"></i>Play Music</a></div>
            </div>

            <!--
            <ul>
                <li><a id="home"            href = "#home"   class="active"   onclick="menuItemSelected(event.target);"> <i class="fa fa-fw fa-home"></i>  Home</a></li>
                <li><a id="MyData"          href = "#myData"                 onclick="menuItemSelected(event.target);"> <i class="fa fa-fw fa-wrench"> </i>My Data</a>
                    <ul>
                        <li><a id="Upload"  href = "#upload"                 onclick="menuItemSelected(event.target);"> <i class="fa fa-fw fa-wrench"> </i>Upload</a></li>
                        <li><a id="Browse"  href = "#browse"                 onclick="menuItemSelected(event.target);"> <i class="fa fa-fw fa-wrench"> </i>Browse</a></li>
                        <li><a id="Model"   href = "#model"                 onclick="menuItemSelected(event.target);"> <i class="fa fa-fw fa-wrench"> </i>Model</a></li>
                    </ul>
                </li>
                
                <li><a id="Shared Data"     href = "#sharedData"             onclick="menuItemSelected(event.target);"> <i class="fa fa-fw fa-wrench"> </i>Shared Data</a></li>
                <li><a id="news"            href = "#news"                   onclick="menuItemSelected(event.target);"> <i class="fa fa-fw fa-wrench"> </i>News</a></li>
                <li><a id="contact"         href = "#contact"                onclick="menuItemSelected(event.target);"> <i class="fa fa-fw fa-user"> </i>Contact Us</a></li>
                <li><a id="about"           href = "#about"                  onclick="menuItemSelected(event.target);"> <i class="fa fa-fw fa-envelope"></i>About Us</a></li>
            </ul>
        -->
        </div>
        <div class="container" id="container" style="display:flex; flex-direction: column; width:100%; height: 100vh">
            <div class="header" id="header" style=" position:fixed; left:290px; transition: 0.5s ease; right:0; height:90px; display:flex; justify-content: flex-start; flex-grow: 1; align-items: center; background-color: rgb(169, 182, 168);">
                <div class="menu_icon_bars" id="menu_icon_bars" style="padding: 1em; font-size: 30px;" onclick="ControlLeftSideVisibility()">&#8801;</div>
                <div class="search" style="flex-grow: 12;  align-self: center; margin-left:10px;">
                    <input type="text" id="searchField" name="searchField" style="width:100%; border-radius: 5px; height: 30px;" placeholder="Search">
                </div>
                <div class="authorization" style="flex-grow: 2; display:flex; flex-direction: row; justify-content: flex-end;">
                    <div class="signIn" style="padding: 1em;">
                        <input class="button_styled" type="button" value="Sign In" style="margin-left:30px" id="signIn">
                    </div>
                    <div class="signUP" style="padding: 1em;">
                        <input class="button_styled" type="button" value="Sign UP" style="margin-left:30px" id="signUp">
                    </div>

                </div>

            </div>
            <div class="content" id="content" style="flex-grow: 50; background-color: white; z-index: -10; margin-top: 90px;">                
                <div class="view-area" id="view-area">
                    <object id="viewArea" type="text/html" data="" style="width:100%; height:100%; margin:0; padding:0;"></object>
                </div>
            </div>
        </div>
    </div>

    <script>
        const sideAreaDiv = document.querySelector('#side-bar');
        const containerDiv = document.querySelector('#container');
        //const contentDiv = document.querySelector('#content');
        const menuIconBars = document.querySelector('#menu_icon_bars');
        const headerDiv = document.querySelector('#header');

        function ControlLeftSideVisibility() {
            if (sideAreaDiv.classList.contains('visible')) {
                sideAreaDiv.classList.remove('visible');
                menuIconBars.classList.add('visible');
                containerDiv.classList.add('full_size');
                headerDiv.classList.add("full_size");
                headerDiv.style.left = "0px";

            } else {
                sideAreaDiv.classList.add('visible');
                menuIconBars.classList.remove('visible');
                containerDiv.classList.remove('full_size');
                headerDiv.classList.remove("full_size");
                headerDiv.style.left = "290px";
            }
        }

        function menuItemSelected(target) {
            const currentMenu = document.querySelector('.side-bar a.active');
            if (currentMenu !== null) {
                currentMenu.classList.remove("active");
            }
            target.classList.add("active");
            
            loadContent(target);
        }


        function groupMenuClicked(target) {
            const parentItem = target.closest('.item');
            console.log(parentItem);
            if (parentItem !== null) {
                const dropDown = parentItem.querySelector('.sub-btn .dropdown');
                dropDown.classList.toggle('rotate');

                const subMenu = parentItem.querySelector('.sub-menu');


                var isActive = dropDown.classList.contains('rotate');
                console.log("isActive = " + isActive);


                if (isActive) {
                    subMenu.classList.add('visible');
                } else {
                    subMenu.classList.remove('visible');
                }
            }
        }


        function loadContent(element) {
            //debugger;            
            var viewAreaElement = document.getElementById("viewArea");
            switch( element.id ) {
                case "see-ontologies"   : viewAreaElement.setAttribute("data", "./app.php?module=data&service=see-ontologies"); break;
                case "playVideo"        : viewAreaElement.setAttribute("data", "./app.php?service=playVideo");            break;
                case "people"           : viewAreaElement.setAttribute("data", "./app.php?service=showPeopleAsTable"); break;
                case "importData"       : viewAreaElement.setAttribute("data", "./app.php?module=data&service=display-import-view"); break;
                default                 : viewAreaElement.setAttribute("data", ""); break;
            }
            //document.getElementById("viewArea").setAttribute("data", theContent);
        }


        // Listen for changes in side_menu classList and update margin-left accordingly
        //const observer = new MutationObserver(ControlLeftSideVisibility);
        //observer.observe(sideAreaDiv, { attributes: true });

        // Update margin-left on window resize
        //  window.addEventListener('resize', ControlLeftSideVisibility);
    </script>
</body>

</html>