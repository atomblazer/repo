<?php

   /**
    * CodeIgniter Controller for use with Tweets database.
    */
   class DB_tweet extends CI_controller {
      
      /** 
       * Call the Controller constructor because we'll be
       * creating an instance of our DB connection.
       */
      public function __construct() {
      
         parent::__construct();
         
         // Load the MongoDB library.
         $this->load->library('Mongo_db');
         
         // Load the Tweet model.
         $this->load->model('tmodel');
         
         // Use the TweetData database.
         $this->mongo_db->switch_db('TweetData');
      }
      
      // Get the documents based upon the passed parameters
      public function get_where($collection = "", $where = array()) {
      
      }
         
      // Get the documents based upon the passed parameters
      public function get() {
         $data = $this->tmodel->get();
         // TODO log event.
         
         return $data;
      }
      
      // Insert a new document into the passed collection
      public function insert($collection = "", $insert = array()) {
      
      }

      // Insert a multiple new document into the passed collection
      public function batch_insert($collection = "", $insert = array()) {
      
      }

      // Delete all documents from the passed collection based upon certain criteria
      public function delete_all($collection = "") {
      
      }
      
   }
   
?>