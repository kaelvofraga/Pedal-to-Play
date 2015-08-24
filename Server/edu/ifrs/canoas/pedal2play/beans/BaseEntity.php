<?php 
abstract class BaseEntity {
    
    private $_id;
    
    public function getId() {
        return $this->_id;
    }
    
    public function setId($id) {
        $this->_id = $id;
        return $this;
    }
    
    public function __get($propertyName) {
        $method = 'get' . ucfirst($propertyName);
        if (!method_exists($this, $method)) {
            $method = 'is' . ucfirst($propertyName);
            if(!method_exists($this, $method)) {
                throw new Exception('Invalid read property ' . $propertyName . ' in ' . get_class($this) . ' class.');
            }
        }
        return $this->$method;
    }
 
    public function __isset($propertyName) {
        try {
            $_value = $this->__get($propertyName);
            return !empty($_value);
        } catch (Exception $e) {
            /* if a property isn't readable it isn't set*/
            return false;
        }
    }
 
    public function __set($propertyName, $value) {
        $method = 'set' . ucfirst($propertyName);
        if ('mapper' == $method || !method_exists($this, $method)) {
            throw new Exception('Invalid write property ' . $propertyName . ' in ' . get_class($this) . ' class.');
        }
        return $this->$method($value);
    }
 
    public function populate(array $map = null) {
        if(!empty($map)) {
            foreach($map as $key => $value) {
                try {
                    $this->__set($key, $value);
                } catch (Exception $e) {
                    /* evaluated $key isn't a bean writable property. Let's go to next one */
                    continue;
                }
            }
        }
 
        return $this;
    }
}
?>