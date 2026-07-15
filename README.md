# Theme

## Deployment

This platform consists of both a backend, Wordpress, and frontend, Next.js, in a standard headless setup. 

### Backend - Wordpress

Please ensure your hosting enviroment meets the following requirements:

- PHP version 7.4 or greater.
- MySQL version 5.7 or greater OR MariaDB version 10.3 or greater.
- HTTPS support

In the root of this repository you'll find a file called `mysql.sql` which is the latest MySQL database dump of your site at the time of migration. This will need to be uploaded to a hosting provider of your choosing and reachable via standard connection protocols before proceeding. 

In the `/cms` directory you'll find the code and assets necessary to deploy your wordpress backend. These files are to be deployed to your Wordpress install's `/wp-content` folder. 

We don't keep the entire Wordpress architecture under version control as different platforms have varying methods for managing core application files. Instead, we include only the neccesary files to be deployed to `/wp-content`. 

A basic Wordpress install, including all core application files, wp-config.php and connected database, should be in place before installing the site-specific files in `/cms` to `/wp-content`. 

Once those files are in place, ensure all plugins included are enabled. 

### Frontend - Next.js

The frontend of the site runs on [Next.js](https://nextjs.org/).

Please ensure your hosting enviroment meets the following requirements:

- Node.js 14.6.0 or newer

Once your backend is running, you'll need to build and deploy the Next.js frontend. All source code for the frontend is found in the `/app` directory.

All development and deployment commands are provided as standard scripts in the `/app/package.json` file. 

To build the frontend, simply copy `/app/.env.example` file to `/app/.env.local` and fill in the appropriate variables. 

- `NEXT_PUBLIC_WORDPRESS_URL` points to your Wordpress backend
- `FAUSTWP_SECRET_KEY` can be found under Settings -> Faust -> Secret Key. This key is used to authenticate real-time previews. 

Once in place, you can run the standard commands to install, build and run your frontend. 

```
npm install 
npm build
npm start
```



