# Hostelworld Symfony 4 Bootstrap

## Requirements
If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)

## Getting Started
Clone the project and run the following commands inside the project folder: 
```
cd docker

docker-compose up
```

* When those containers are ready, you can start to open http://localhost
* Three containers will be created: database, php_fpm and nginx.
* The database will be already preloaded with the required data.

## Challenge
* Create a branch using the fistname-lastname-YYYY-MM-DD format and use this branch to put your code
* Create an endpoint that given 2 airports IDs, it returns the best route with the minimum layovers, including the start and ending cities. 
* Both parameters are integers and should be validated for errors.
* The code should have the necessary **unit tests**.
* The response should be in **JSON** format following this format:
```
{
    sucess: true|false
    data: object
    message: 'error message if any'
}
```
### Examples:
* http://localhost/best-route?from=111&to=222
 ```
 {
     sucess: true
     data: [
        {
            airportId:111,
            cityId:123,
            cityName: 'abc',
            countryName: 'xyz'
        },
        {
            airportId:555,
            cityId:345,
            cityName: 'foo',
            countryName: 'bar'
        },
        {
            airportId:222,
            cityId:456,
            cityName: 'zzz',
            countryName: 'yyy'
        }
    ]
 }
 ```
* http://localhost/best-route?from=aaa&to=222
 ```
 {
     sucess: false
     data: null,
     message: 'Invalid parameter From ID'
 }
 ```
