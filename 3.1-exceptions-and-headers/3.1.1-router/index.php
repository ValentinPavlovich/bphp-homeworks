<?php
/**
 * Доступные страницы на сайте
 *
 * @var array $availableLinks
 */
$availableLinks = include './availableLinks.php';
require './router.php';

class BadRequest extends Exception{}
class NotFound extends Exception{}

    function route($availableLinks) {
        if (!isset($_GET['page'])) {
            throw new BadRequest('Ошибка запроса');
        } 

        $tryToRoute = new Router($availableLinks);        
        $routeResult = $tryToRoute->isAvailablePage($_GET['page']);

        if (!$routeResult)  {
            throw new NotFound('Страницы ' . $_GET['page'] . ' не существует');     
        }        
        return 'Вы находитесь на странице ' . $_GET['page'];
  
    }

    try {
        echo route($availableLinks);
    }
    catch (BadRequest $e) {
        echo $e->getMessage() . '<br/>';
        header('Location: error.php');
    }
    catch (NotFound $e) {
        echo $e->getMessage() . '<br/>';
        header('Location: 404.php');       
    }  

?>