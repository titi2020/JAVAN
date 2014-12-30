<?php

namespace Game\PlayerBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class GamePlayerBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
