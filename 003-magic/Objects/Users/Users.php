<?php

namespace Objects\Users;

use Objects\Traits\TAppUserAuth;
use Objects\Traits\TMobileUserAuth;
class Users
{
    use TAppUserAuth, TMobileUserAuth {
        TAppUserAuth::authenticate insteadof TMobileUserAuth;
        TMobileUserAuth::authenticate as MobileAuthenticate;
    }
}