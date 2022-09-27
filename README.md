# Pick Server

This is a server that [laravel-pick](https://github.com/pkboom/laravel-pick) sends data to.

# Usage

Use `pick()` in your app.

```php
Route::get('/', function () {
    pick(time());
    pick(User::first());
    pick(time());

    return 'calm down';
});
```

Open `pick-server.test` and whatever `laravel-pick` sends will appear here.

<img src="image.png" />
