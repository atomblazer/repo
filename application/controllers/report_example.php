<?php

   /**
    * CodeIgniter Controller for use with Tweets database.
    */
   class Report_example extends CI_controller {
      
      /** 
       * Call the Controller constructor because we'll be
       * creating an instance of our DB connection.
       */
      public function __construct() {
      
         parent::__construct();
         
         // Load the MongoDB library.
         $this->load->library('Mongo_db');
         
      }

      public index ()
      {
        $this->load->view('repots');
      }
      