<?php


class Game
{

    private $u_choice, $total, $c_choice;
    private $final = array();

    public function __construct($user)
    {
        $this->u_choice = $user;
    }


    public function play()
    {
        $this->c_choice = $this->computer_choice();

        $this->result();

        $this->final['user'] = $this->u_choice;
        $this->final['computer'] = $this->c_choice;
        $this->final['result'] = $this->total;

        return $this->final;
    }


    //computer's choice
    private function computer_choice()
    {
        $a = rand(0,2);
        $list = array('Rock', 'Paper', 'Scissor');
        return $list[$a];
    }


    //final result of the game
    private function result()
    {
        if($this->c_choice == $this->u_choice)
        {
            $this->total = "It's a tie!";
        }
        else if($this->u_choice == 'Rock')
        {
            if($this->c_choice == 'Scissor')
            {
                $this->total = 'You win!';
            }
            else
            {
                $this->total = 'You loose!';
            }
        }
        else if($this->u_choice == 'Paper')
        {
            if($this->c_choice == 'Rock')
            {
                $this->total = 'You win!';
            }
            else
            {
                $this->total = 'You loose!';
            }
        }
        else if($this->u_choice == 'Scissor')
        {
            if($this->c_choice == 'Paper')
            {
                $this->total = 'You win!';
            }
            else
            {
                $this->total = 'You loose!';
            }
        }
    }

}

?>
