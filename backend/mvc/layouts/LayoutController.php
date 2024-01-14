<?php
namespace backend\mvc\layouts;

use \backend\library\Controller;

class MyLayoutController extends Controller
{
    function __construct()
    {
    }
    function showLayout() {
           include(__DIR__ . "/views/main_layout.php");
    }
    function showAboutUs() {
       include(__DIR__ . "/views/showAbout.php");
}
 function showContactUs() {
       include(__DIR__ . "/views/showContact.php");
}
function showDefaultPage() {
       include(__DIR__ . "/views/defaultPage.php");
}
}
