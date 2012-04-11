<?php

class ResourceControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{
    public function testResourceDbShouldContainTheOwnerCompany(){
        
        $request = $this->getRequest();
        $request->setMethod('GET')
                ->setGet(array(
                    'company' => 'Secogal',
                    
                ));
        $this->dispatch('/user/add');
        $adapter = new Zend_Test_DbAdapter();
        $resource = $adapter->query("SELECT * FROM company WHERE name ='$request->company'"); //TODO "secogal must config in the config.ini
        $this->assertCount($resource,"0");
        $this->assertRedirectTo('/resource/error');
        
    }

    public function testResourceFormShouldContainOneFormAndSixImputs()
    {
        $this->dispatch('/resource/add');
        $this->assertController('resource');
        $this->assertAction('add');
        $this->assertQueryCount('zend_form', 1);
        $this->assertQueryCount('inputboxes#name', 1);//brand name
        $this->assertQueryCount('inputboxes#status', 1);//0 If the resource its available to rent
        $this->assertQueryCount('inputboxes#location', 1);// place where is the store of resource or the production        
        $this->assertQueryCount('inputboxes#dateBuy', 1);// date of buy
        $this->assertQueryCount('inputboxes#lastUse', 1);// The last time we move the resource from his store
        $this->assertQueryCount('inputboxes#metadata', 1);// words for helping the search
        $this->assertQueryCount('inputboxes#description', 1);// Description and observation of the resource
        $this->assertQueryCount('inputboxes#image', 1);//picture of the resource and the bill
        
    }
    public function testAddResourceShouldShowOneErrorMessageIfTheCompanyIsNotInTheDataBase()
    {
        
    }
     public function testAddResourceShouldFailWithInvalidData()
    {
        $data = array(
            'name' => 'This is not a correct name',
            'dateBuy'    => 'this is not a correct date',
            'image' => 'This is not a image'
            
        );
        $request = $this->getRequest();
        $request->setMethod('POST')
                ->setPost($data);
        $this->dispatch('/resource/add');
        $this->assertNotRedirect();
        
        //Deberian estar entre OR
        $this->assertQuery('form#name.errors');
        $this->assertQuery('form#dataBuy.errors');
        $this->assertQuery('form#image.errors');
    }
    
    public function testAaddResourceShouldBeRedirectedToListofResouce()
    {
        $data = array(
            'name' => 'correct name',
            'dateBuy'=> 'correct date',
            'image' => 'image'
            
        );
        $request = $this->getRequest();
        $request->setMethod('POST')
                ->setPost($data);
         
        $this->dispatch('/user/add');
        $this->assertRedirectTo('/resource/index');
        $this->assertQuery('tbody.tr.td#$data["name"]');//name tiene que hacer referencia al de $data
    }

}
?>
