<?php

declare(strict_types=1);

use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Actions\User\CreateUserAction;
use App\Application\Actions\User\DeleteUserAction;
use App\Application\Actions\User\ModifyUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use League\Csv\Writer;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
        $group->post('/{id}/{name}', ModifyUserAction::class);
        $group->put('/{name}', CreateUserAction::class);
        $group->delete('/{id}', DeleteUserAction::class);
    });

    $app->get('/hook', function (Request $request, Response $response) {
        return $response
                        ->withHeader('Location', 'https://reqres.in/api/users/2')
                        ->withStatus(302);
    });

    $app->get('/receipt', function (Request $request, Response $response) {


        $sql = "select * FROM neo_users";
        $db = getConnection();
        $sth = $db->query($sql);

        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML('<h1>Users</h1>');

        while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $mpdf->WriteHTML('<p>' . $row['username'] . '</p>');
        }

        $mpdf->Output();
    });


    $app->get('/list', function (Request $request, Response $response) {

        $sql = "select * FROM neo_users";
        $db = getConnection();
        $sth = $db->query($sql);
        $header = ['userId', 'username'];
        $records = [];
        while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
            $records[] = [$row['id'], $row['username']];
        }

        $csv = Writer::createFromString('');
        $csv->insertOne($header);
        $csv->insertAll($records);

        $response->getBody()->write($csv->getContent());
        return $response
                        ->withHeader('Content-Type', 'text/csv');
    });
};
