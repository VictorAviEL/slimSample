<?php
declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;

class CreateUserAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        //$userId = (int) $this->resolveArg('id');
        $userName = $this->resolveArg('name');
        $sql = "INSERT INTO neo_users (username, password) VALUES ( \"$userName\", \"$userName\");";
       
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
