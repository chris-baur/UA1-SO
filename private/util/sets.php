<?php
    
    /**
     * Used for getting the different sets for the Security questions 1 and 2,
     * professions, genders.
     * 
     * @author Christoffer Baur
     */
    class Sets{

        //static class variables
        private static $sets = null;

        public function __construct(){
            // if (is_null(self::$sets)) {  // OR if (!is_array(self::$date))
                self::$sets = json_decode(file_get_contents('../../sets.txt', true));
            // }
        }
        
        public function getSecurityOne(){
            return self::$sets->security_one;
        }
        
        public function getSecurityTwo(){
            return self::$sets->security_two;
        }
        
        public function getProfessions(){
            return self::$sets->professions;
        }

        public function getGenders(){
            return self::$sets->genders;
        }

        //To string functions used for DB SQL

        public function toStringSecurityOne(){
            return $this->toString($this->getSecurityOne());
        }

        public function toStringSecurityTwo(){
            return $this->toString($this->getSecurityTwo());
        }

        public function toStringProfessions(){
            return $this->toString($this->getProfessions());
        }

        public function toStringGenders(){
            return $this->toString($this->getGenders());
        }

        private function toString($array){
            return '\'' . implode('\',\'', $array) . '\'';
        }
    }
?>
