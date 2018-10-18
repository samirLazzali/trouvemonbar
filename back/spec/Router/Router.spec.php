<?php
namespace Router;

describe('Router', function() {
    beforeEach(function() {
        $this->router = new Router();
    });

    it('should handle get request', function() {
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $_SERVER['REQUEST_URI'] = '/test/awesome/get';

        $this->router::get('/test/{}/{}', function($awesome, $get) {
            return [$awesome, $get];
        });

        expect($this->router::execute())->toBe(['awesome', 'get']);
    });

    it('should handle post request', function() {
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SERVER['REQUEST_URI'] = '/test/awesome/post';

        $this->router::post('/test/{}/{}', function($awesome, $post) {
            return [$awesome, $post];
        });

        expect($this->router::execute())->toBe(['awesome', 'post']);
    });


    it('should handle delete request', function() {
        $_SERVER['REQUEST_METHOD'] = 'DELETE';
        $_SERVER['REQUEST_URI'] = '/test/awesome/delete';

        $this->router::delete('/test/{}/{}', function($awesome, $delete) {
            return [$awesome, $delete];
        });

        expect($this->router::execute())->toBe(['awesome', 'delete']);
    });
});
