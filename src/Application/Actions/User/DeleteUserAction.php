<?php
declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;

class DeleteUserAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $userId = (int) $this->resolveArg('id');
        //$userName = $this->resolveArg('name');
        $sql = "Delete From neo_users Where id=$userId;";
       
         try {
        $db = getConnection();
        $sth = $db->prepare($sql);
        $sth->execute();

        return $this->respondWithData('done');

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
        
    }
}
