# Volodex

This web application built using the Laravel PHP framework is for creating, storing, and sharing contact information. All contact info is stored in the .vcard/.vcf format.

## Getting Started

### Prerequisites

```json
"devDependencies": {
   "axios": "^0.18",
   "bootstrap": "^4.1.0",
   "cross-env": "^5.1",
   "jquery": "^3.2",
   "laravel-mix": "^2.0",
   "lodash": "^4.17.4",
   "popper.js": "^1.12",
   "vue": "^2.5.7"
}
```

### Installation Instructions

1. Download the project or clone the Github repository.
2. In terminal navigate to the project directory.
3. With the project as your present working directory execute `composer install`. This will process the files required to load Laravel in the web browser.
4. Next, execute `npm install` to download all the projects dependencies.
5. Finally, execute `npm run dev` to use Laravel Mix. Mix will preprocess the SCSS and JS files and place the results in the `/public` directory.
6. The project is now fully built and ready to use. Run `php artisan serve` to use PHP's built in web server. Open your browser and navigate to `localhost:8000` to view the application.

## Deployment

I deployed my application on [Heroku](https://www.heroku.com/). To view instructions visit [my blog.](https://github.com/rcbrowder/rcbrowder.github.io/blob/master/_posts/2018-07-12-Deploying-Laravel-5-Applications-to-Heroku.md)

## Built With

* [Laravel](https://laravel.com/) - PHP framework
* [Vue.js](https://vuejs.org/) - Javascript framework
* [Bootstrap](https://getbootstrap.com/) - Frontend framework
* [npm](https://www.npmjs.com/) - Dependency management

## Authors

* __Chris Browder__ - _Creator_
* __Christian Wolfe__ - _Creator_

## Acknowledgments

* Janine Hempy and Matthew Gidcomb at the Awesome Inc. Web Developer Bootcamp. Thanks for teaching us everything we know. You're welcome for making you look good.
