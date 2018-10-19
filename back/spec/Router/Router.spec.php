<?php
namespace Router;

describe('Router', function() {
    it('should handle get request', function() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/test/awesome/get';

        Router::get('/test/{}/{}', function($awesome, $get) {
            return [$awesome, $get];
        });

        expect(Router::execute())->toBe(['awesome', 'get']);
    });

    it('should handle post request', function() {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/test/awesome/post';

        Router::post('/test/{}/{}', function($awesome, $post) {
            return [$awesome, $post];
        });

        expect(Router::execute())->toBe(['awesome', 'post']);
    });


    it('should handle delete request', function() {
        $_SERVER['REQUEST_METHOD'] = 'DELETE';
        $_SERVER['REQUEST_URI'] = '/test/awesome/delete';

        Router::delete('/test/{}/{}', function($awesome, $delete) {
            return [$awesome, $delete];
        });

        expect(Router::execute())->toBe(['awesome', 'delete']);
    });
});
