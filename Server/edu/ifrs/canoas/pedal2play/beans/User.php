<?php 
class User extends BaseEntity {
    private $email;
	private $password;
	private $subscription_day;
	private $name;
	private $weight;
	private $address;
	private $birthday;
	
	public function getEmail() {
        return $this->email;
    }
	
	public function setEmail($email) {
        $this->email = $email;
        return $this;
    }
	
	public function getPassword() {
        return $this->$password;
    }
	
	public function setPassword($password) {
        $this->password = $password;
        return $this;
    }
	
	public function getSubscriptionDay() {
        return $this->$subscription_day;
    }
	
	public function setSubscriptionDay($subscription_day) {
        $this->subscription_day = $subscription_day;
        return $this;
    }
	
	public function getName(){
		return $this->name;
	}
	
	public function setName($name){
		$this->name = $name;
		return $this;
	}
	
	public function getWeight(){
		return $this->weight;
	}
	
	public function setWeight($weight){
		$this->weight = $weight;
		return $this;
	}
	
	public function getAddress(){
		return $this->address;
	}
	
	public function setAddress($address){
		$this->address = $address;
		return $this;
	}
	
	public function getBirthday(){
		return $this->birthday;
	}
	
	public function setBirthday($birthday){
		$this->birthday = $birthday;
		return $this;
	}			
}
?>