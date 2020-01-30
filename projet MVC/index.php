<?php
        session_start();                                                        //demarrage de la session
        require_once "./lib/File.php";                                          //inclusion de File.php
        require_once File::build_path(array('controller','routeur.php'));       //recuperation de la route grace au routeur
