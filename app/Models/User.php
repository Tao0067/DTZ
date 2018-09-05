<?php

namespace App\Models;

    use Illuminate\Notifications\Notifiable;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Tymon\JWTAuth\Contracts\JWTSubject as AuthenticatableUserContract;



        class User extends Authenticatable implements AuthenticatableUserContract
        {
            use Notifiable;

            /**
             * The attributes that are mass assignable.
             *F
             * @var array
             */
            protected $fillable = [
                'name', 'email', 'password',
            ];

            /**
             * The attributes that should be hidden for arrays.
             *
             * @var array
             */
            protected $hidden = [
                'password', 'remember_token',
            ];

            public function getJWTIdentifier()
            {
                return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
