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
        
        public function get_security_one(){
            return self::$sets->security_one;
        }
        
        public function get_security_two(){
            return self::$sets->security_two;
        }
        
        public function get_professions(){
            return self::$sets->professions;
        }

        public function get_genders(){
            return self::$sets->genders;
        }

        //To string functions used for DB SQL

        public function to_string_security_one(){
            return $this->to_string($this->get_security_one());
        }

        public function to_string_security_two(){
            return $this->to_string($this->get_security_two());
        }

        public function to_string_professions(){
            return $this->to_string($this->get_professions());
        }

        public function to_string_genders(){
            return $this->to_string($this->get_genders());
        }

        private function to_string($array){
            return '\'' . implode('\',\'', $array) . '\'';
        }
    }
?>
