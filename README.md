# Routers
Fetch data from routes to permissions table and create pivot table between permissions and routes

### Requirements
    Laravel >=9
    PHP >= 8.0
    Laravel-Admin >= dev-main
    
## Features
- Routes Table
- Permissions Table
- permission_routes Table

## Installation
1. Run
    ```
    composer require derbala/routers
    ```
2. Publish vendor
    ```
    php artisan vendor:publish --provider="derbala\routers\RouterServiceProvider"
    ```
3. Add routes function to the permission model:
    ```
    public function routes(){
        return $this->belongsToMany(Route::class)->withTimestamps();
    }
    ```
3. Run migrate:
    ```
    php artisan migrate
    ```
4. Run the following command to fetch data to routes and permissions tables:
    ```
    php artisan fetch:routes {route name} {allow translate}
    ```
    if you want to fetch many routes so you need to put '_' between routes name.
    to allow translate put 1 in second arugment, otherwise, put 0.
    For example, if you have 3 routes called admin, metadata and dashboard and you want to fetch them you will run the follwing command:
    ```    
    php artisan fetch:routes admin_metadata_dashboard 1
    ```
5. Run the following command to create pivot table between permissions and routes:
    ```    
    php artisan fetch:permission_routes
    ```
