<?php
/*------- CLASS AUTOLOAD -------*/
spl_autoload_register(function ($class) {
    $directories = ["class","model","controller"];
    foreach ($directories as $dir) {
        $file = $dir ."/" . $class . ".php";
        if(file_exists($file)){
            require_once $file;
        }
    }
});

session_start();

$userController = new UserController();
$supportController = new SupportController();
$chatController = new ChatController();
$itemController = new ItemController();

/*------- INDEX ROUTERS/TO CONTROLLERS -------*/
if(!empty($_GET)){
    extract($_GET);
    if(isset($a)){
        switch($a){
            case 'home':
                require_once 'view/home.php';
                break;
            case 'connection':
                require 'view/connection.php';
                break;

            /*------SIGN UP/IN/OUT------*/
            case 'signIn':
                $userController->signIn();
                break;
            case 'signUp':
                $userController->signUp();
                break;
            case 'signOut':
                $userController->signOut();
                break;

            /*------SUPPORT------*/
            case 'support':
                $supportController->supportPage();
                break;
            case 'newRequest':
                $supportController->newRequest();
                break;
            case 'viewRequest':
                if(isset($reqId)){
                    $supportController->viewRequest($reqId);
                }else{
                    require_once 'view/404.php';
                }   
                break;

            
            case 'profile':
                if(isset($id)){
                    $userController->viewProfile($id);
                }else{
                    require_once 'view/404.php';
                }   
                break;
            case 'chats':
                //if(isset($_SESSION['user'])){
                //    $chatController->viewChats();
                //}else{
                    require_once 'view/connection.php';
                //}
                break;
            case 'newItem':
                $itemController->newItem();
                break;
            case 'updateItemForm':
                if(isset($itemId)){
                    $itemController->updateItemForm($itemId);
                }else{
                    require_once 'view/404.php';
                }
                break;
            case 'manageItems':
                $itemController->showCurrentItems();
                break;
            case 'addItem':
                $itemController->addItem();
                break;
            default:
                require 'view/404.php';
                break;
        }
    }else{
        require 'view/404.php';
    }
}else{
    require 'view/home.php';
}
