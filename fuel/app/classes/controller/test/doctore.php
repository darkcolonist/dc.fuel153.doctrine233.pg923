<?php
class Controller_Test_Doctore extends Controller_Test
{
  public function action_index(){
    $_t = "OH MY LORD <blink>IT WORKS!!!</blink>";

    $results = Doctrine::$em->getConnection()
            ->fetchAll("SELECT * FROM tbl_chat;");

    foreach($results as $row){
      $_t .= "<br />loaded: ".$row["id"].", direction is: ".$row["direction"];
    }

    return Response::forge($_t);

  }
}
