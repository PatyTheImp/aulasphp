<?php
    class User 
    {
        public $name;

        public function sayHello()
        {
            return $this->name .  ' says hello.';
        }
    }

    $user1 = new User();

    $user1->name = 'Paty';
    echo $user1->name;
    echo '<br>';
    echo $user1->sayHello();
    echo '<br>';

    $user2 = new User();

    $user2->name = 'Eric';
    echo $user2->name;
    echo '<br>';
    echo $user2->sayHello();