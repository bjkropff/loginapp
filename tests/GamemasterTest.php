<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    // require_once "src/Player.php";
    use PHPUnit\Framework\TestCase;

    require_once __DIR__."/../src/Gamemaster.php";
    require_once __DIR__."/../src/Team.php";




    //MySQL database info changing to seetings.php outside of the docroot
    // Orginal
    // $server = 'mysql:host=(localhost or 127 or host ip):(port);dbname=(name))';
    // $username = 'root';

    // You only need the following for one of the test pages
    require_once __DIR__."/../../settings_local.php";


    $server = 'mysql:host=' .
        $settings['host'] . ':' .
        $settings['port'] . ';dbname=' .
        $settings['testdb'];
    $username = $settings['username'];
    $password = $settings['password'];


    $DB = new PDO($server, $username, $password);

    class GamemasterTest extends TestCase
    {
        protected function tearDown()
        {
            Gamemaster::deleteAll();
        }


        function test_getUser()
        {
            //Arrange
            $user = "Brian";
            $pass = "1a2b3c4d5e6f7g8h9j0k";
            $test_gamemaster= new Gamemaster($user, $pass);
            //Act
            $result = $test_gamemaster->getUser();
            //Assert
            $this->assertEquals("Brian", $result);
            // echo("Name get \n");
        }

        function test_setUser()
        {
            //Arrange
            $user = "Brian";
            $pass = "1a2b3c4d5e6f7g8h9j0k";
            $test_gamemaster= new Gamemaster($user, $pass);
            //Act
            $result = $test_gamemaster->setUser("Gorge");
            $get = $test_gamemaster->getUser();

            //Assert
            $this->assertEquals("Gorge", $get);
        }

        function test_getPass()
        {
            //Arrange
            $user = "Brian";
            $pass = "1a2b3c4d5e6f7g8h9j0k";
            $test_gamemaster= new Gamemaster($user, $pass);
            //Act
            $result = $test_gamemaster->getPass();
            //Assert
            $this->assertEquals($pass, $result);
            // echo("Name get \n");
        }

        function test_setPass()
        {
            //Arrange
            $user = "Brian";
            $pass = "1a2b3c4d5e6f7g8h9j0k";
            $test_gamemaster= new Gamemaster($user, $pass);
            //Act
            $result = $test_gamemaster->setPass("asdgsasd");
            $get = $test_gamemaster->getPass();

            //Assert
            $this->assertEquals("asdgsasd", $get);
        }

        function test_saveUser()
        {
          //Arrange
          $user = "Brian";
          $pass = "1a2b3c4d5e6f7g8h9j0k";
          $test_gamemaster= new Gamemaster($user, $pass);
          //Act
          $result = $test_gamemaster->save();
          $get = $test_gamemaster->getId();

          // sprint($result);
          //Assert
          $this->assertTrue( is_numeric($result) && $result != 0);
        }

        function test_getIdUser()
        {
            //Arrange
            $user = "Brian";
            $pass = "1a2b3c4d5e6f7g8h9j0k";
            $test_gamemaster= new Gamemaster($user, $pass);
            //Act
            $result = $test_gamemaster->save();
            $get = $test_gamemaster->getId();
            //Assert
            $this->assertEquals($get, $result);
        }

        function test_getAllGamemasters()
        {
            //Arrange
            $user = "Brian";
            $pass = "1a2b3c4d5e6f7g8h9j0k";
            $test_gamemaster= new Gamemaster($user, $pass);

            $result = $test_gamemaster->save();

            $user2 = "Andy";
            $pass2 = "e6f7g8h9j0k";
            $test_gamemaster2= new Gamemaster($user2, $pass2);

            $result2 = $test_gamemaster2->save();

            //Act
            $arrayOfgamemasters = Gamemaster::getAllGamemasters();

            //Assert
            $this->assertEquals($arrayOfgamemasters, [$test_gamemaster, $test_gamemaster2]);
        }

        // function test_findUserById()
        // {
        //     //Arrange
        //     $name = "Goofball";
        //     $test_team = new Team($name);
        //
        //     $name2 = "CoolKids";
        //     $test_team2 = new Team($name2);
        //     //Act
        //     $result = $test_team->save();
        //
        //     $result2 = $test_team2->save();
        //
        //     $id = $test_team->getId();
        //
        //     //Act
        //     $team_id = Team::findByTeamID($id);
        //
        //     // Assert
        //      $this->assertEquals($test_team, $team_id);
        // }
        //
        // function test_findByUserName()
        // {
        //     //Arrange
        //     $name = "Goofball";
        //     $test_team = new Team($name);
        //
        //     $name2 = "CoolKids";
        //     $test_team2 = new Team($name2);
        //     //Act
        //     $result = $test_team->save();
        //
        //     $result2 = $test_team2->save();
        //
        //     $id = $test_team->getId();
        //
        //     //Act
        //     $teamname2 = Team::findByTeamname($name2);
        //
        //     // Assert
        //     // assertTrue will return the string if false
        //     // $this->assertTrue( is_numeric($test_player1->save()));
        //      $this->assertEquals($test_team2, $teamname2);
        // }

    }
?>
