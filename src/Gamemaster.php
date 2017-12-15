<?php
    class Gamemaster
    {
        private $user;
        private $pass;
        private $id;

        function __construct($user, $pass, $id = null)
        {
            $this->user = $user;
            $this->pass = $pass;
            $this->id = $id;
        }

        static function deleteAll()
        {
            $executed = $GLOBALS['DB']->exec("DELETE FROM gamemaster;");
            return true;
        }


        function setId($new_id)
        {
          $this->id = (int) $new_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setUser($new_user)
        {
          $this->user = $new_user;
        }

        function getUser()
        {
            return $this->user;
        }

        function setPass($new_pass)
        {
          $this->pass = $new_pass;
        }

        function getPass()
        {
            return $this->pass;
        }

        function save()
        {
            $thisuser = $this->getUser();
            // print($thisname);
            // Because this is a name, punctuations break it
            $executed = $GLOBALS['DB']->exec("INSERT INTO gamemasters (user, pass) VALUES ('{$this->getUser()}', '{$this->getPass()}');");

            if (!$executed) {
              return "A failure has accured. Did you use a punctuation?";
            }
            $returned_gamemasters = $GLOBALS['DB']->query("SELECT * FROM gamemasters WHERE user = '{$this->getUser()}';");

            foreach($returned_gamemasters as $gamemaster)
            {
                if($thisuser == $gamemaster['user'])
                {
                  $pass = $gamemaster['pass'];
                  $id = intval($gamemaster['id']);
                  $this->setId($id);

                  return $id;
                }
            }
        }

        static function getAllGamemasters()
        {
            $returned_gamemasters = $GLOBALS['DB']->query("SELECT * FROM gamemasters;");

            if (!$returned_gamemasters) {
              return "A failure has accured. Did you use a punctuation?";
            }

            $gamemasters = array();
            foreach($returned_gamemasters as $gamemaster)
            {
                $user = $gamemaster['user'];
                $pass = $gamemaster['pass'];
                $id   = intval($gamemaster['id']);

                $next_gamemaster = new Gamemaster($user, $pass, $id);

                array_push($gamemasters, $next_gamemaster);
            }

            return $gamemasters;
        }

    }
?>
