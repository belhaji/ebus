<?php

namespace Epark\Middleware;

use Epark\Models\User;


class Authentication {


	public function __invoke($req,$res,$next){

		if( !$auth = $req->getHeader('Authorization')){

			return $res->withStatus(401);
		}

		 $_apikey = $auth[0];
        $apikey = substr($_apikey, strpos($_apikey, ' '));
        $apikey = trim($apikey);

        $user = new User();

        if (!$user->authenticate($apikey)) {
            $res->withStatus(401);

            return $res;
        }

        $req = $req->withAttribute('user_id', $user->current_user->id);
        $res = $next($req, $res);

        return $res;













	} 












}