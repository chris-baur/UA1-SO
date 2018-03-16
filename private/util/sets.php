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
                self::$sets = json_decode(file_get_contents(dirname(__FILE__).'/../../sets.txt', true));
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

        public function to_string_security_one(){
            return $this->to_string($this->getSecurityOne());
        }

        public function to_string_security_two(){
            return $this->to_string($this->getSecurityTwo());
        }

        public function to_string_professions(){
            return $this->to_string($this->getProfessions());
        }

        public function to_string_genders(){
            return $this->to_string($this->getGenders());
        }

        private function to_string($array){
            return '\'' . implode('\',\'', $array) . '\'';
        }
    }
?>
