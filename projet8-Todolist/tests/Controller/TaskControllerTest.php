<?php

namespace App\Tests\Controller;

use App\Tests\NeedLogin;
use Liip\TestFixturesBundle\Test\FixturesTrait;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;


class TaskControllerTest extends WebTestCase
{

    use FixturesTrait;
    use NeedLogin;


    public function testAddNewTask()
    {
        $client = static::createClient(array(), array(
            'HTTP_HOST'       => 'localhost:8000',
        ));
        $users = $this->loadFixtureFiles([__DIR__.'/users.yaml']);
        /** @var User $user */
        $this->login($client, $users['user_admin']);

        $crawler = $client->request('GET','/tasks/create');
        $form = $crawler->filter('button.btn-success.pull-right')->form();
        $form['task[title]'] = "TaskPhpUnit";
        $form['task[content]'] = "Hello je suis un test php unit";
        $client->submit($form);

        $crawler = $client->followRedirect();

        $this->assertSelectorTextContains("div.alert.alert-success", "La tâche a été bien été ajoutée.");

    }

    public function testDeleteTaskByAnAdminWhichIsTheAuthor()
    {
        $client = static::createClient(array(), array(
            'HTTP_HOST'       => 'localhost:8000',
        ));
        $users = $this->loadFixtureFiles([__DIR__.'/users.yaml']);
        /** @var User $user */
        $this->login($client, $users['user_admin']);

        $crawler = $client->request('GET','/tasks/create');
        $form = $crawler->filter('button.btn-success.pull-right')->form();
        $form['task[title]'] = "TaskPhpUnit";
        $form['task[content]'] = "Hello je suis un test php unit";
        $client->submit($form);

        $crawler = $client->followRedirect();
        $this->assertSelectorTextContains("button.btn.btn-danger.btn-sm.pull-right","Supprimer");
        $form = $crawler->filter('button.btn.btn-danger.btn-sm.pull-right')->form();
        $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertSelectorTextContains("div.alert.alert-success", "La tâche a bien été supprimée.");

    }

    public function testDeleteTaskByAnUserWhichIsTheAuthor()
    {
        $client = static::createClient(array(), array(
            'HTTP_HOST'       => 'localhost:8000',
        ));
        $users = $this->loadFixtureFiles([__DIR__.'/users.yaml']);
        /** @var User $user */
        $this->login($client, $users['user_user']);

        $crawler = $client->request('GET','/tasks/create');
        $form = $crawler->filter('button.btn-success.pull-right')->form();
        $form['task[title]'] = "TaskPhpUnit";
        $form['task[content]'] = "Hello je suis un test php unit";
        $client->submit($form);

        $crawler = $client->followRedirect();
        $this->assertSelectorTextContains("button.btn.btn-danger.btn-sm.pull-right","Supprimer");
        $form = $crawler->filter('button.btn.btn-danger.btn-sm.pull-right')->form();
        $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertSelectorTextContains("div.alert.alert-success", "La tâche a bien été supprimée.");

    }

    public function testButtonDeleteDoesNotAppearWhenDeletingIsNotPossibleForUserAndDeleteActionIsNotAvailable()
    {
        $client = static::createClient(array(), array(
            'HTTP_HOST'       => 'localhost:8000',
        ));
        $users = $this->loadFixtureFiles([__DIR__.'/users.yaml']);
        /** @var User $user */
        $this->login($client, $users['user_admin']);

        $crawler = $client->request('GET','/tasks/create');
        $form = $crawler->filter('button.btn-success.pull-right')->form();
        $form['task[title]'] = "TaskPhpUnit";
        $form['task[content]'] = "Hello je suis un test php unit";
        $client->submit($form);

        $crawler = $client->followRedirect();
        $this->assertSelectorTextContains("div.alert.alert-success", "La tâche a été bien été ajoutée.");
        $this->assertSelectorTextContains("a.pull-right.btn.btn-danger","Se déconnecter");
        $link = $crawler->selectLink('Se déconnecter')->link();

        $crawler = $client->click($link);
        $crawler = $client->followRedirect();
        $this->assertSelectorTextContains("h1", "Bienvenue sur Todo List, l'application vous permettant de gérer l'ensemble de vos tâches sans effort !");

        $this->login($client, $users['user_user']);
        $crawler = $client->request('GET','/tasks');
        $this->assertSelectorTextContains("p", "Hello je suis un test php unit");
        $buttonDelete = $crawler->filter('button.btn.btn-danger.btn-sm.pull-right');
        $this->assertNotCount(1,$buttonDelete);

        $crawler = $client->request('GET','/tasks/1/delete');
        $crawler = $client->followRedirect();
        $this->assertSelectorTextContains("div.alert.alert-danger", "Vous ne pouvez pas supprimer la tâche.");

    }

    public function testButtonDeleteDoesNotAppearWhenDeletingIsNotPossibleForAdminAndDeleteActionIsNotAvailable()
    {
        $client = static::createClient(array(), array(
            'HTTP_HOST'       => 'localhost:8000',
        ));
        $users = $this->loadFixtureFiles([__DIR__.'/users.yaml']);
        /** @var User $user */
        $this->login($client, $users['user_user']);

        $crawler = $client->request('GET','/tasks/create');
        $form = $crawler->filter('button.btn-success.pull-right')->form();
        $form['task[title]'] = "TaskPhpUnit";
        $form['task[content]'] = "Hello je suis un test php unit";
        $client->submit($form);

        $crawler = $client->followRedirect();
        $this->assertSelectorTextContains("div.alert.alert-success", "La tâche a été bien été ajoutée.");
        $this->assertSelectorTextContains("a.pull-right.btn.btn-danger","Se déconnecter");
        $link = $crawler->selectLink('Se déconnecter')->link();

        $crawler = $client->click($link);
        $crawler = $client->followRedirect();
        $this->assertSelectorTextContains("h1", "Bienvenue sur Todo List, l'application vous permettant de gérer l'ensemble de vos tâches sans effort !");

        $this->login($client, $users['user_admin']);
        $crawler = $client->request('GET','/tasks');
        $this->assertSelectorTextContains("p", "Hello je suis un test php unit");
        $buttonDelete = $crawler->filter('button.btn.btn-danger.btn-sm.pull-right');
        $this->assertNotCount(1,$buttonDelete);

        $crawler = $client->request('GET','/tasks/1/delete');
        $crawler = $client->followRedirect();
        $this->assertSelectorTextContains("div.alert.alert-danger", "Vous ne pouvez pas supprimer la tâche.");

    }

    public function testDeleteTaskIsPossibleByAnAdminWhenTheAuthorIsNull()
    {
        $client = static::createClient(array(), array(
            'HTTP_HOST'       => 'localhost:8000',
        ));
        $users = $this->loadFixtureFiles([__DIR__.'/tasks.yaml']);
        /** @var User $user */
        $this->login($client, $users['user_admin']);
        $crawler = $client->request('GET','/tasks');
        $this->assertSelectorTextContains("p", "This is the content");
        $buttonDelete = $crawler->filter('button.btn.btn-danger.btn-sm.pull-right');
        $this->assertCount(1,$buttonDelete);
        $this->assertSelectorTextContains("button.btn.btn-danger.btn-sm.pull-right","Supprimer");
        $form = $crawler->filter('button.btn.btn-danger.btn-sm.pull-right')->form();
        $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertSelectorTextContains("div.alert.alert-success", "La tâche a bien été supprimée.");

    }



    public function testToggleATask()
    {
        $client = static::createClient(array(), array(
            'HTTP_HOST'       => 'localhost:8000',
        ));
        $users = $this->loadFixtureFiles([__DIR__.'/tasks.yaml']);
        /** @var User $user */
        $this->login($client, $users['user_admin']);
        $crawler = $client->request('GET','/tasks');
        $this->assertSelectorTextContains("p", "This is the content");
        $this->assertSelectorTextContains("button.btn.btn-success.btn-sm.pull-right","Marquer comme faite");
        $form = $crawler->filter('button.btn.btn-success.btn-sm.pull-right')->form();
        $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertSelectorTextContains("div.alert.alert-success", "La tâche Test Without Author a bien été marquée comme faite.");

    }

    public function testEditATask()
    {
        $client = static::createClient(array(), array(
            'HTTP_HOST'       => 'localhost:8000',
        ));
        $users = $this->loadFixtureFiles([__DIR__.'/tasks.yaml']);
        /** @var User $user */
        $this->login($client, $users['user_admin']);
        $crawler = $client->request('GET','/tasks/1/edit');
        $this->assertSelectorTextContains("button.btn.btn-success.pull-right","Modifier");
        $form = $crawler->filter('button.btn.btn-success.pull-right')->form();
        $form['task[title]'] = "TaskPhpUnit";
        $form['task[content]'] = "Hello je suis un test php unit";
        $client->submit($form);

        $crawler = $client->followRedirect();
        $this->assertSelectorTextContains("div.alert.alert-success", "La tâche a bien été modifiée.");

    }

}