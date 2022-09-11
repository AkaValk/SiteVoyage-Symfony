<?php


namespace App\Tests\Validations;

use App\Entity\Visite;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class VisiteValidationsTest extends KernelTestCase {
    public function getVisite() : Visite{
    return (new Visite())
            ->setVille("New-York")
            ->setPays("USA"); 
    }
    public function testValidNoteVisite(){
        $visite = $this->getVisite()->setNote(10);
        $this->assertErrors($visite,0);
        
    }
    public function assertErrors(Visite $visite, int $nbErreursAttendus, string $message=""){
        
        self::bootKernel();
        $error=self::$container->get('validator')->validate($visite);
        $this->assertCount($nbErreursAttendus, $error, $message);
    }
    public function testNotValidNoteVisite(){
        $visite=$this->getVisite()->setNote(20);
        $this->assertErrors($visite, 0, "devrait réussir");
        
    }
    public function testValidTempmaxVisite(){
        $visite=$this->getVisite()->setTempmax(18)
                                  ->setTempmin(20);
        $this->assertErrors($visite,1);
    }
}

