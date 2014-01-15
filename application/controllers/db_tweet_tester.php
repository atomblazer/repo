<?php

   /**
    * Test data file.
    *----------------------------------------------------------
    * Testers: Ryan, Ronen
    *----------------------------------------------------------
    * Classes to test:
    *
    * Class: db_tweet.php
    * Type: CI Controller
    *
    * Class: tweet_model.php
    * Type: CI Model
    */
   class DB_tweet_tester extends CI_controller {
      
      /** 
       * Call the Controller constructor because we'll be
       * creating an instance of our DB connection.
       */
      public function __construct() {
      
         parent::__construct();
         
         // Load the MongoDB library.
         $this->load->library('Mongo_db');
         
         // Load the Tweet model.
         $this->load->model('tweet_model');
         
         // Use the TweetData database.
         $this->mongo_db->switch_db('TweetData');
      }
      
      // Get the documents based upon the passed parameters
      public function get_where($collection = "", $where = array()) {
      
      }
         
      // Get the documents based upon the passed parameters
      public function get() {
         $data = $this->tweet_model->get();
         // echo "Name: ".$data['name']."&nbsp&nbsp&nbsp&nbsp Role: ".$data['role'];
         echo $data[0]['name'].$data[1]['name'];
      }
      
      // Insert a new document into the passed collection
      public function insert($collection = "", $insert = array()) {
         echo 'insert test';

         $data = $this->tweet_model->insert(
            array(
            "name" => "Darius",
            "role" => "Fighter"
            )
         );
      }

      // Insert a multiple new document into the passed collection
      public function batch_insert($collection = "", $insert = array()) {
         $data = $this->tweet_model->batch_insert(
            array(
               array(
                  "name" => "Aatrox",
                  "role" => "Fighter"
               ),
               array(
                  "name" => "Ahri",
                  "role" => "Mage"
               ),
               array(
                  "name" => "Darius",
                  "role" => "Fighter"
               ),
               array(
                  "name" => "Diana",
                  "role" => "Fighter"
               ),
               array(
                  "name" => "Fizz",
                  "role" => "Assassin"
               ),
               array(
                  "name" => "Gangplank",
                  "role" => "Fighter"
               ),
               array(
                  "name" => "Jax",
                  "role" => "Fighter"
               ),
               array(
                  "name" => "Jayce",
                  "role" => "Fighter"
               ),
               array(
                  "name" => "Kennen",
                  "role" => "Mage"
               ),
               array(
                  "name" => "Kha'Zix",
                  "role" => "Assassin"
               ),
               array(
                  "name" => "Master Yi",
                  "role" => "Assassin"
               ),
               array(
                  "name" => "Mordekaiser",
                  "role" => "Fighter"
               )
         ));
      }

      // Delete all documents from the passed collection based upon certain criteria
      public function delete_all($collection = "") {
      
      }
      
      public function get_all() {
         $cursor = $this->tweet_model->get_all();

         // Get all of the documents and display contents.         
         foreach ($cursor as $id => $value)
         {
            echo "Document: <br/>";
            echo "$id: ";
            var_dump($value);
            echo "<br/><br/>";
         }
      }
      
      public function search($select, $where) {
         
         // $data = $this->tweet_model->search($select, $where);
         $data = $this->tweet_model->search(array('name'), array('name'=>'Aatrox'));
         
         foreach ($data as $id => $value) {
            echo "$id: ";
            var_dump($value);
            echo "<br/>";
         }
      }
   }
   
?>