<?php

    namespace cotcotfarm\jeu\entities;

    Class Player
    {
        private $pseudo;
        private $farmName;
        private $walletAmount;

        public function __construct($pseudo,$farmName){
            $this->pseudo = $pseudo;
            $this->farmName = $farmName; 
            $this->walletAmount = 1000;
        }

        public function getPseudo(){
            return $this->pseudo;
        }

        public function getFarmName(){
            return $this->farmName;
        }

        public function setPseudo($pseudo){
            $this->pseudo = $pseudo;
        }

        public function setFarmName($farmName){
            $this->farmName = $farmName;
        }   

        public function getWalletAmount(){
            return $this->walletAmount;
        }

        public function setWalletAmount($walletAmount){
            $this->walletAmount = $walletAmount;
        }


    }