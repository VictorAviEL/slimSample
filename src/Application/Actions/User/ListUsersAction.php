<?php
declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;

class ListUsersAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        
         $sql = "select * FROM neo_users";
    try {
        $db = getConnection();
        $sth = $db->prepare($sql);
        $sth->execute();

        /* Fetch all of the remaining rows in the result set */
        print("Fetch all of the remaining rows in the result set:\n");
        $result = $sth->fetchAll();
            $jresult = json_encode($result);
        return $this->respondWithData($jresult);

    } catch(PDOException $e) {
        echo '{"error":{"text":'. $e->getMessage() .'}}';
    }
    
 
    }
}
