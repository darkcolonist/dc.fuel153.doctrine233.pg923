<?php
class Controller_Test_Doctore extends Controller_Test
{
  public function action_index(){
    $_t = "OH MY GOODNESS <blink>IT WORKS!!!</blink>";

    $results = Doctrine::$em->getConnection()
            ->fetchAll("SELECT * FROM users;");

    foreach($results as $row){
      $_t .= "<br />loaded: ".$row["id"].", name is: ".$row["first_name"];
    }

    return Response::forge($_t);

  }

  public function action_generate(){
    $_t = "OH MY GOODNESS <blink>IT WORKS!!!</blink>";
    $_t .= "<br />setting up nao, wait plox!";

    // fetch metadata
    $driver = new \Doctrine\ORM\Mapping\Driver\DatabaseDriver(
        Doctrine::$em->getConnection()->getSchemaManager()
    );
    Doctrine::$em->getConfiguration()->setMetadataDriverImpl($driver);
    $cmf = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory(Doctrine::$em);
    $cmf->setEntityManager(Doctrine::$em);
    $classes = $driver->getAllClassNames();
    $metadata = $cmf->getAllMetadata();
    $generator = new \Doctrine\ORM\Tools\EntityGenerator();
    $generator->setUpdateEntityIfExists(true);
    $generator->setGenerateStubMethods(true);
    $generator->setGenerateAnnotations(true);
    $generator->generate($metadata, APPPATH. 'classes/model/Entities');

    $_t .= "<br />Done!";

    return Fuel\Core\Response::forge($_t);
  }

  public function action_query(){
    $user = new Users();
    $user->setFirstName("luka");

    $_t = "i'm fvcked";

    $_t .= " ".$user->getFirstName();

    Doctrine::$em->persist($user);
    Doctrine::$em->flush();

//    $query = Doctrine::$em->createQueryBuilder()
//            ->select("u")
//            ->from("Users", "u")
//            ->getQuery();
//    $users = $query->getResult();
//
//    $_t = print_r($users->toArray(), true);

    return Fuel\Core\Response::forge($_t);
  }
}