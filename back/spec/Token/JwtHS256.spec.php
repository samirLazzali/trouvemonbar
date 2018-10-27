<?php

describe('JwtHS256', function() {
    it('should generate a token with hmac sha256', function() {
        $token = \Token\JwtHS256::generate(1, 'secret', 1529495956);

        expect($token)->toBe('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoiMSIsImV4cCI6MTUyOTQ5NTk1Nn0.GwejAIAJ-XFFNhh_8Z2wVlAMbglHoimgGtG8LGc_Dvs');
    });

    it('should extract the user id', function() {
        allow('time')->toBeCalled()->andReturn(123);
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoiMSIsImV4cCI6MTUyOTQ5NTk1Nn0.GwejAIAJ-XFFNhh_8Z2wVlAMbglHoimgGtG8LGc_Dvs';

        $user_id = \Token\JwtHS256::validate($token, 'secret');

        expect($user_id)->toBe(1);
    });


    it('should throw an exception when token expired', function() {
        allow('time')->toBeCalled()->andReturn(time() + 2000);
        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VyX2lkIjoiMSIsImV4cCI6MTUyOTQ5NTk1Nn0.GwejAIAJ-XFFNhh_8Z2wVlAMbglHoimgGtG8LGc_Dvs';

        $closure = function() use($token) {
            \Token\JwtHS256::validate($token, 'secret');
        };

        expect($closure)->toThrow(new \Exception('Token has expired'));
    });
});
