# BBI - Recruitment Task

## Aim

A project set by Big Brand Ideas (BBI) - To create an application for interacting with an input for to pull data from the Spotify Search API. Using:

-   PHP
-   Laravel
-   A front end framework (React)
-   JSON

## Outline

This project uses Laravel to serve a static search page from the 'web' route in Laravel (made with React.js). The client then submits a search via an API call to the server (and awaits the response using a promise) which is handled by the 'api' route. An API controller uses utility classes to put together a request to Spotify based on the search term supplied, consisting of a first call to the Spotify authorisation endpoint to get an access token, followed by a request to the search endpoint to get the requested data. The data is decoded, the required properties are kept and re-encoded then sent back to the client for display. React then updates the list based on its new state from the resolved promise. All transfer of data between client/server/3rd party API is done with JSON.

## Technologies

-   Laravel
-   React
-   JSON

## Installation & Testing

Fork the repo and run "npm run dev" to build the JavaScript (you will need to add your own Spotify API Client ID and Secret to .env - see env.example for the variable names to use).  
"php artisan serve" will start the Laravel development server, & the application will be accessible at localhost:8000.  
Tests are set up to run with:

-   "php artisan dusk" for end to end testing (requires the server to be running)
-   "php artisan test" for back end unit/feature testing
-   "npm test" for front end testing. Note - this depends on a mock service worker, which will intercept requests when in a DEV environment causing normal use to break. The code applying the msw is therefore commented out at the top of resources/js/index.js - uncomment before running the 'npm' (jest) tests.
    Manual testing - type any reasonable search term in the box and click "Search" - a list of the most relevant tracks, with artist and duration should be displayed.

# State & Improvements

This meets the brief outlined above:

-   PHP arranged in Laravel folder structure utilising routes, views and helpers.
-   External API used to fetch data utilising OAuth 2.0 , built in methods used to encode/decode JSON data.
-   Makes use of MVC basic pattern.
-   React is used for the front end UI.
-   TDD ('Red->Green->Refactor). All tests were written first after installing required testing frameworks and dependencies, then parts of the application were built to make the tests pass. This is at the 'green' stage, and would benefit from some detailed review for refactoring, perhaps also making use of more built in functions or libraries. Time constraints due to learning a new framework meant the project has not yet been optimised. Similarly for further features/improvements.  

<!-- -->

Further steps:
-   Refactoring and simplification as outlined above.
-   Adding a search type feature: this could be done by providing a dropdown input in the form, adding another query parameter to the client API request, adding more specific routing in api.php, adding functions to the SpotifyAPI and SpotifyReturnFormatter classes for handling the different data format. Conditional formatting could be used to render lists on the front end if different properties are returned.
-   The UI could be made much more friendly on the eye, and the whole project could be reviewed for performance improvements.

# Links

Spotify ["Client Credentials Flow"](https://developer.spotify.com/documentation/general/guides/authorization/client-credentials/).   
Laravel [guides and documentation](https://laravel.com/docs/9.x).

## Contact

Created by GNolanDev@gmail.com - comments gratefully received!
