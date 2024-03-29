<?php
use backend\library\Route;



// ---------------------------------- Person -------------------------------------------


Route::route("selectAllPeople", function(){  //http://localhost/webapp/app.php?service=selectAllPeople
    (new backend\mvc\Person\PersonController())->selectAll();    
});

Route::route("showPeopleAsTable", function(){  //http://localhost/webapp/app.php?service=showPeopleAsTable
    (new backend\mvc\Person\PersonController())->showPeopleAsTable();
});



Route::route("showPersonForm", function(){
    (new backend\mvc\Person\PersonController())->showPersonForm( @$_REQUEST["MODE"], @$_REQUEST["id"]);  
});
Route::route("insertPersonFromView", function(){
    (new backend\mvc\Person\PersonController())->insertFromView();  
});

Route::route("showLayout", function(){    
    (new backend\mvc\layouts\MyLayoutController())->showLayout();  
});

Route::route("selectPerson", function(){    
    (new backend\mvc\Person\PersonController())->select(@$_REQUEST['id']);  
});

Route::route("updatePerson", function(){    
    (new backend\mvc\person\PersonController())->update();  
});

Route::route("deletePerson", function(){    
    (new backend\mvc\person\PersonController())->delete(@$_REQUEST['id']);  
});



// ---------------------------------- Extras -------------------------------------------


Route::route("showAbout", function(){  //http://localhost/webapp/app.php?service=showAbout
    (new backend\mvc\layouts\MyLayoutController())->showAboutUs();  
});

Route::route("showContact", function(){  //http://localhost/webapp/app.php?service=showAbout
    (new backend\mvc\layouts\MyLayoutController())->showContactUs();  
});

Route::route("defaultPage", function(){  //http://localhost/webapp/app.php?service=showAbout
    (new backend\mvc\layouts\MyLayoutController())->showDefaultPage();  
});



// ---------------------------------- User -------------------------------------------


Route::route("registerUser", function(){ //http://localhost/webapp/app.php?service=registerUser
    (new backend\mvc\user\UserController())->register();
});

Route::route("registerSuccess", function() {
    (new backend\mvc\user\UserController())->registerSuccess();
});

Route::route("loginUser", function(){ //http://localhost/webapp/app.php?service=loginUser
    (new backend\mvc\user\UserController())->login();
});

Route::route("loginSuccess", function() {
    (new backend\mvc\user\UserController())->loginSuccess();
});

Route::route("logout", function(){ //http://localhost/webapp/app.php?service=logout
    (new backend\mvc\user\UserController())->logout();
});

Route::route("deleteUser", function(){
    (new backend\mvc\user\UserController())->deleteUser(@$_REQUEST['id']);
});

Route::route("updateUser", function(){
    (new backend\mvc\user\UserController())->updateUserRole();
});

Route::route("profile", function(){  //http://localhost/webapp/app.php?service=profile
    (new backend\mvc\user\UserController())->accessProfile();
});

Route::route("profileSuccess", function() {
    (new backend\mvc\user\UserController())->profileSuccess();
});



// ---------------------------------- Services -------------------------------------------


Route::route("showServices", function(){  //http://localhost/webapp/app.php?service=showServices
    (new backend\mvc\service\ServiceController())->showServicesAsTable();
});

Route::route("addService", function(){  //http://localhost/webapp/app.php?service=addService

    (new backend\mvc\service\ServiceController())->showServiceForm( @$_REQUEST["MODE"], @$_REQUEST["id"]);
});



Route::route("selectAllServices", function(){ 
    (new backend\mvc\service\ServiceController())->selectAll();
});

Route::route("insertServiceFromView", function(){  
    (new backend\mvc\service\ServiceController())->insertFromView();
});


Route::route("selectService", function(){    
    (new backend\mvc\service\ServiceController())->select(@$_REQUEST['id']);
});

Route::route("updateService", function(){    
    (new backend\mvc\service\ServiceController())->update(); 
});

Route::route("deleteService", function(){    
    (new backend\mvc\service\ServiceController())->delete(@$_REQUEST['id']);  
});


Route::route("buyService", function(){    
    (new backend\mvc\service\ServiceController())->buyService(@$_REQUEST['id']);  
});


Route::route("bestDeals", function(){    
    (new backend\mvc\service\ServiceController())->bestDeals();  
});

Route::route("selectBestDeals", function(){    
    (new backend\mvc\service\ServiceController())->selectBestDeals();  
});

Route::route("searchByActivity", function(){    
    (new backend\mvc\service\ServiceController())->searchByActivity(@$_REQUEST['activity']);  
});
Route::route("lookingFor", function(){    
    (new backend\mvc\service\ServiceController())->lookingFor();  
});


