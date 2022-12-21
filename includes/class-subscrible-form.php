<?php

class SubscribeForm
{

    public $database;

    public function __construct()
    {
        // Only change code below this line 

            // Instruction: add database connection into $this->database
            $this->database = connectToDB();

        // Only change code above this line
    }

    public function subscribe($email)
    {
        // Only change code below this line 
        $error = '';
            // Instruction: check if $email is empty or not, if empty, return 'Email is required'    
            
                if (
                    empty($email)
                )
                {
                    $error = 'email is valid.';
                }

                if(!empty ( $error ))
                return $error;
    
                // make sure user's email wasn't already exists in database
                $statement = $this->database->prepare(
                'SELECT * FROM subscribe_list WHERE email = :email'
                );

                $statement->execute([
                    'email' => $email 
                ]);

                $user = $statement->fetch();

                // start here

                // if user exists, return error
                if ( $user ) {
                    return 'Email already exists';
                } else {
                    // if user doesn't exists, insert user data into database
                    $statement = $this->database->prepare(
                        'INSERT INTO subscribe_list ( email)
                        VALUES (:email)'
                    );

                    $statement->execute([
                        'email' => $email,
                    ]);
                    return 'You have successfully subscribed to our newsletter';
                }



            // Instruction: check if $email is valid, then add it into database, and return 'You have successfully subscribed to our newsletter'

        // Only change code above this line
    }
}