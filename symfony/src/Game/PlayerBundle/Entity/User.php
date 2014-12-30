<?php
// src/Acme/UserBundle/Entity/User.php

namespace Game\PlayerBundle\Entity;


use FOS\UserBundle\Entity\User as BaseUser;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="snow_user")
 */

class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        // Mantener esta línea para llamar al constructor
        // de la clase padre
        parent::__construct();

        // Aquí podremos añadir el código necesario.
    }
}
