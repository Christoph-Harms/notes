# Notes
## What is this?
Just a simple demo project. An app that let's you take notes, save, edit, and delete them. The notes can have different colors.
The backend is a [Lumen](https://lumen.laravel.com) app serving a simple JSON api, the frontend is a very simple [Vue js](https://vuejs.org) SPA. It's my first go at the Lumen
framework (I am experienced with Laravel, though).

## How do I run it?
1. Clone the repo: `git clone <repourl>`
2. Change to project dir: `cd notes`
3. Install the dependencies: `php composer.phar install`
4. Migrate and seed the database: `php artisan migrate --seed`
5. Start PHP development server, serve from the `public/` directory on port 6060: `php -S localhost:6060 -t public`
6. Open `frontend/index.html` with your browser

## How do I run the tests?
Follow steps 1 to 3 from "How do I run it?", then execute `vendor/bin/phpunit`

## Room for improvement
* `GET /notes` currently simply returns _all_ notes in the database (sorted newest to oldest), which can potentially lead to very large payloads (and DB loads) 
when there is a large number of notes. It should return a paginated result.
* There is no authentication / log in, so all users see, can add to, and delete from the same set of notes. This should be handled and displayed per-user.
* There are no indexes in the database except for the primary keys. Sensible indexes should be added to columns that are queried often.
* For a more complicated app, the closure based routes should be refactored to point to controller actions
* The frontend is currently a Vue SPA, all in one `index.html` file with the Vue framework and all other 3rd party dependencies included via CDN. For a more 
complicated app, it should be its own project, using Node.js build tools, Single File Components, etc.
* Also, the frontend is currently styled using only Bulma classes and inline styles. This should be done with a preprocessor like SASS together with a build 
tool like webpack.
* The app is served over http. Obviously, this should be changed to https for production.
* The base URL for api requests from the frontend is currently hardcoded to `http://localhost:6060`. This should be made configurable.
* The font for the notes could be selectable by the user.
* If an api call from the frontend to the backend produces an error, that error is currently logged to console. This should be made mor user-friendly for 
errors like validation errors and less telling for errors that do not concern the user directly.
* To keep the app simple, it currently uses the color classes from the Bulma CSS framework for the note color. Thus, the 'color' property is not called 
'color', but 'type' and can hold one of `['primary', 'info', 'success', 'warning', 'danger']`. This way, the value of this column can easily be used like 
this: `:class="'card is-rounded has-background-' + type"`. This could be refactored to hold arbitrary predefined hex-values.
* The 'color' picker is functional, but really ugly.
* Notes could be made sortable via drag & drop.
* There are only tests for the backend at the moment, no tests for the frontend. Once the frontend is built with Node.js build tools, it will be easily 
possible to test vue components in isolation with a testing framework like Jasemine.
* The `.env` file is currently under version control, just to save an additional step when running the app. This is OK because it does not contain any 
credentials or otherwise sensitive data. Normally, this file should be excluded from git and generated during deployment.
* Surely much more. ;)


