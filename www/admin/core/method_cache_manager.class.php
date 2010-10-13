<?php
class MethodCacheManager {
    private $ttl       = 300; // cache life time in seconds, by default 5 minutes
    private $object    = null;
    private $methods   = null;
    private $classname = null;
    
    function __construct($object, $options=array()) {
        $this->object = $object;
        
        if(isset($options['ttl'])) {
            $this->ttl = $options['ttl'];
        }
    }
    
    function __call($method, $args) {        
        $class_methods = $this->getInternalObjectMethods();
        
        if(in_array($method, $class_methods)) {                
            $key = $this->classname.$method.md5(serialize($args));
            
            if(false === ($result = apc_fetch($key))) {
                $result = call_user_func_array(array($this->object, $method), $args);
                apc_store($key, serialize($result), $this->ttl);
                
                return( $result );
            }
            
            return( unserialize($result) );
        } else {        
            throw new Exception( " Method " . $method . " does not exist in this class " . get_class($this->object) . "." );
        }
    }
    
    public function set_cache_life($ttl) {        
        $this->ttl = $ttl;
        return $this;
    }
    
    public function clear_cache($key) {
        apc_delete( $key );
        return $this;
    }
    
    public function clear_all_cache() {
        apc_clear_cache('user');
        return $this;
    }
    
    protected function getInternalObjectMethods() {
        if ($this->methods === null && $this->object !== null) {
            $this->classname = get_class($this->object);
            $this->methods   = get_class_methods($this->classname);
        }
        
        return( $this->methods );
    }
}