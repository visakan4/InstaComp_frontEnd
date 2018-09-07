<?php
    class user{
        private $strFirstName;
        private $strLastName;
        private $strAddress;
        private $strEmail;
        private $strPinCode;

        # set the getters and setters
        public function fnSetFirstName($paramFirstName){
            $this->strFirstName = $paramFirstName;
        }

        public function fnSetLastName($paramLastName){
            $this->strLastName = $paramLastName;
        }

        public function fnSetStreetAddress($paramStreetAddress){
            $this->strAddress = $paramStreetAddress;
        }

        public function fnSetEmail($paramEmail){
            $this->strEmail = $paramEmail;
        }

        public function fnSetPostalcode($paramPinCode){
            $this->strPinCode = $paramPinCode;
        }

        public function fnGetFirstName(){
            return $this->strFirstName;
        }

        public function fnGetLastName(){
            return $this->strLastName;
        }

        public function fnGetStreetAddress(){
            return $this->strAddress;
        }

        public function fnGetEmail(){
            return $this->strEmail;
        }

        public function fnGetPostalCode(){
            return $this->strPinCode;
        }

        # end of getters and setters
    }
?>