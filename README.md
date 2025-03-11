
# Sprout Custom WordPress Theme

This WordPress theme is built on the [Sage (v10)](https://roots.io/sage) WordPress theme framework. It uses:

## Environment Setup

Install the following:

- [Lando](https://lando.dev/)
- [Docker](https://www.docker.com/)
- [Volta](https://docs.volta.sh/guide/getting-started) (Optional)
- [Node.js](http://nodejs.org) version `>=20` (Install with Volta, if using)
- [Lando SSL](https://docs.lando.dev/core/v3/security.html#macos)

Once everything is installed, from the command line:

1. Extract the contents from the LandoRoot folder (in the theme) and paste them in the root folder.
2. CD to `/wp-content/uploads` (create this directory if it doesn't exist)
3. Ensure you have a `storage` directory with `framework` and `logs` as children directories. `framework` should have `cache` as a child directory. 
   1. See bottom of this document for visual layout.  
4. CD to theme directory
5. Run `npm i` to install JavaScript dependencies. The Node version we are using is 20.11.1.
6. Run `lando composer install` to install PHP dependencies. 
7. CD to root directory
8. Run `lando start` to launch the Docker environment 
9. Navigate to one of the working Appserver URLs and go through WordPress setup
   1. When asked for database details, run `lando info` in the console to find the database connection info
10. Copy `bud.config.js` to `bud.local.config.js` and edit with your local environment info.
11. Run `npm run dev` to compile css/js assets and set a watch for future file changes.

### Windows-Specific Considerations

If installing on a Windows machine, it will be necessary to use WSL (Windows Subsystem for Linux) in order to properly compile the theme. This is due to Sage's use of Bud which will not run on Windows architecture.
[Learn more about WSL](https://learn.microsoft.com/en-us/windows/wsl/about)

The Ubuntu distribution is recommended as it has been tested and verified to work as expected.

Once WSL has been installed, all repository files should be cloned into the WSL/Ubuntu file system rather than the Windows file system. This is important to ensure that all features work as expected, including hot reloading with the `npm run dev` command.

## Required WordPress Plugins

-  [Advanced Custom Fields Pro](https://www.advancedcustomfields.com)


## Theme Development

- Edit `app/setup.php` to enable or disable theme features, setup navigation menus, post thumbnail sizes, and sidebars.
- Update `bud.config.js` settings:
    - `setProxyUrl` should reflect your local development hostname (`http://localhost.lndo.site`).

Run one of the following commands from the `wp-content/themes/sprout-theme` directory to compile assets:

| Command                | Description                              |
| ---------------------- | ---------------------------------------- |
| `npm run dev`          | _Compile assets when file changes are made, start Browsersync session._ |
| `npm run build`        | _Compile and optimize the files in your assets directory._ |

Assets are compiled into `wp-content/themes/sprout-v2-theme/public` directory.


## Development Workflow & Deploying Changes to the Webserver

You do not need to deploy/upload these compiled css/js assets to the webserver. When code is pushed onto the `develop`, `staging`, or `main` branches a GitHub action is started to build the assets and copy all the theme files to the appropriate environment at Kinsta.

> [!WARNING]  
> **NOTE: Above will be future state - for now merging to `main` will push to Pantheon. The notes below related to `develop` or `staging` do not apply until WPEngine is in play.**



1. In general, all dev work should be created as branches off the `develop` branch and named with a categorizing folder like:
   `bug/EHI-{ticketNumber}_branch-description` or `feature/EHI-{ticketNumber}_branch-description`. The only exception is a hotfix scenario where a change needs to be quickly addressd in Production. Hotfix branches should be branched off of the `main` branch and named like `hotfix/EHI-{ticketNumber}_some-descriptive-title`. These should be used sparingly and is the only time a branch should fork directly off of `main`. 
2. Once work on a local branch is complete and pushed, a pull request should be created to merge that branch into the `develop` branch (or `main` if is a hotfix).
3. Once a merge is complete on `develop`, a dedicated GitHub action is triggered to deploy the `develop` branch's code to the Dev server's theme.
4. When you are ready to push the changes to the Staging environment, create a pull request to merge `develop` into `staging`.
5. Once a merge is complete on `staging`, a dedicated GitHub action is triggered to deploy the `staging` branch's code to the Staging server's theme.
6. Once changes are tested and confirmed on the Staging server, a similar process is followed to merge the changes from `staging` to `main` (via a pull request).
7. Once a merge is complete on `main`, a dedicated GitHub action is triggered to deploy the `main` branch's code to the Production server's theme.
8. The Production environment should then be smoke tested to confirm changes are working as expected.

This process will ensure that the theme code running in a given environment (Dev, Stg, Prd) always matches the code found in the theme repo branches (`develop`, `staging`, `main`). 

**NOTE:** The GitHub actions use rsync to perform a sync _and delete_. So any files not in the relevant repo will be deleted on the target server. For this reason it is advised that you never use sFTP to upload files directly to a server's theme directory (or modify the theme files using the WordPress theme editor tools), as those changes will get removed/overwritten during the next deploy/sync operation.


## Theme Structure

```shell
themes/reliance_theme/    # → Root of your Sage based theme
├── app/                  # → Theme PHP
│   ├── Controllers/      # → Controller files
│   ├── admin.php         # → Theme customizer setup
│   ├── filters.php       # → Theme filters
│   ├── helpers.php       # → Helper functions
│   └── setup.php         # → Theme setup
├── composer.json         # → Autoloading for `app/` files
├── composer.lock         # → Composer lock file (never edit)
├── dist/                 # → Built theme assets (never edit)
├── node_modules/         # → Node.js packages (never edit)
├── package.json          # → Node.js dependencies and scripts
├── resources/            # → Theme assets and templates
│   ├── assets/           # → Front-end assets
│   │   ├── config.json   # → Settings for compiled assets
│   │   ├── build/        # → Webpack and ESLint config
│   │   ├── fonts/        # → Theme fonts
│   │   ├── images/       # → Theme images
│   │   ├── scripts/      # → Theme JS
│   │   └── styles/       # → Theme stylesheets
│   ├── functions.php     # → Composer autoloader, theme includes
│   ├── index.php         # → Never manually edit
│   ├── screenshot.png    # → Theme screenshot for WP admin
│   ├── style.css         # → Theme meta information
│   └── views/            # → Theme templates
│       ├── layouts/      # → Base templates
│       └── partials/     # → Partial templates
└── vendor/               # → Composer packages (never edit)
```

## Needed Uploads Directories
These directories need to be read/write and are required **BEFORE** you run `lando start` or `npm run dev`. 
```shell
├── /wp-content/uploads              
│   ├── 2024/             # → Media files
│   └── storage/           # → Theme customizer setup
│       ├── framework/       # → Theme filters
│       │   ├── cache/
│       │   └── views/
│       └── logs/       # → Helper functions
```


