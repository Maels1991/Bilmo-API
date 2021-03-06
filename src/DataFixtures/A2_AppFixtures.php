<?php declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\App;
use App\Entity\Permission;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;

class A2_AppFixtures extends Fixture
{
  /**
   * @param \Doctrine\Common\Persistence\ObjectManager $manager
   */
  public function load(ObjectManager $manager): void
  {
  
    /**
     * First, we create the bilmo App
     */
    
    $appBilmo = new App();
    $appBilmo
      ->setId('f4573a81-4c53-499f-96d8-333e290e7474')
      ->setSecret('04e0b5837255551a446979564cb74db99377c26b')
      ->setRoles(['ROLE_MANAGER'])
    ;
    
    $permissions = $manager->getRepository(Permission::class)->findBy(['id' => [
      Permission::LIST_APPS, Permission::POST_APPS, Permission::GET_APPS, Permission::DELETE_APPS,
      Permission::POST_USERS, Permission::LIST_USERS, Permission::GET_USERS, Permission::DELETE_USERS, Permission::PUT_USERS,
      Permission::LIST_MANUFACTURERS, Permission::POST_MANUFACTURERS, Permission::GET_MANUFACTURERS, Permission::PUT_MANUFACTURERS, Permission::DELETE_MANUFACTURERS,
      Permission::POST_CATEGORIES, Permission::GET_CATEGORIES, Permission::PUT_CATEGORIES, Permission::DELETE_CATEGORIES,
      Permission::POST_PRODUCTS, Permission::LIST_PRODUCTS, Permission::GET_PRODUCTS, Permission::PUT_PRODUCTS, Permission::DELETE_PRODUCTS
    ]]);
    
    $permissions = new ArrayCollection($permissions);
    $appBilmo->setPermissions($permissions);
    $manager->persist($appBilmo);
  
    
    /**
     * Next, we create a partner App
     */
    
    $appPartner = new App();
    $appPartner
      ->setId('d3452bb9-d8cc-4d67-a4de-8b3eb78c5ad7')
      ->setSecret('46979564cb74db99377c26b04e0b5837255551a4')
    ;
  
    $permissions = $manager->getRepository(Permission::class)->findBy(['id' => [
      Permission::POST_USERS, Permission::LIST_USERS, Permission::GET_USERS, Permission::DELETE_USERS, Permission::PUT_USERS,
      Permission::GET_MANUFACTURERS, Permission::LIST_MANUFACTURERS,
      Permission::GET_CATEGORIES,
      Permission::LIST_PRODUCTS, Permission::GET_PRODUCTS
    ]]);
  
    $permissions = new ArrayCollection($permissions);
    $appPartner->setPermissions($permissions);
    $manager->persist($appPartner);
    
    
    $manager->flush();
  }
}