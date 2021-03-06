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
$adminController = new AdminController();

$authorized_get_values = ["a", "reqId", "id", "itemId", "userId"];

/*------- INDEX ROUTERS/TO CONTROLLERS -------*/
if(!empty($_GET)){

    //extract-like for specific values
    foreach($_GET as $key => $value){
        if( in_array($key, $authorized_get_values) ){
            $$key = $value;
        }
    }

    if(isset($a)){
        switch($a){
            case 'home':
                $itemController->showHome();
                break;
            case 'connection':
                $userController->viewConnection();
                break;
            case 'market':
                $itemController->showMarket();
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
            case 'newSupportMessage':
                if(isset($reqId)){
                    $supportController->addMessage($reqId);
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
            case 'myChats':
                $chatController->viewAllChats();
                break;
            case 'chat':
                if(isset($userId)){
                    $chatController->viewChatWith($userId);
                }else{
                    require_once'view/404.php';
                }
                break;
            case 'updateUser':
                if(isset($id)){
                    $userController->updateUser($id);
                }else{
                    require_once'view/404.php';
                }
                break;
            case 'sendMessage':
                if(isset($userId)){
                    $chatController->sendChatMessage($userId);
                }else{
                    require_once'view/404.php';
                }
                break;

            /*------ITEM FORMS------*/
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

            /*------ITEM ACTIONS------*/
            case 'addItem':
                $itemController->addItem();
                break;
            case 'deleteItem':
               if(isset($itemId)){
                    $itemController->deleteItem($itemId);
                }else{
                    require_once 'view/404.php';
                }
                break;
            case 'updateItem':
                if(isset($itemId)){
                    $itemController->updateItem($itemId);
                }else{
                    require_once 'view/404.php';
                }
                break;

            /*------ACCOUNT------*/
            case 'myAccount':
                $userController->viewAccount();
                break;
            case 'deleteAccount':
                if(isset($_SESSION['user']) AND isset($id)){
                    $userController->deleteAccount($id);
                }else{
                    require_once'view/404.php';
                }
                break;

            /*------ADMIN------*/
            case 'adminHome':
                $adminController->viewHome();
                break;
            case 'viewAllMembers':
                $adminController->showAllMembers();
                break;
            case 'viewAllRequests':
                $adminController->showAllRequests();
                break;
            case 'adminUpdate':
                if(isset($id)){
                    $adminController->adminUpdate($id);
                }else{
                    require_once'view/404.php';
                }
                break;
            case 'adminUpdateUser':
                if(isset($id)){
                    $adminController->updateUser($id);
                }else{
                    require_once'view/404.php';
                }
                break;
                
            default:
                require 'view/404.php';
                break;
        }
    }else{
        require 'view/404.php';
    }
}else{
    $itemController->showHome();
}
