#[Just Tom](http://www.justtom.me) - Planets Rest API
---

Current Version: `1.0.0`


### Description
---
This is a simpe REST API project I saw tasked with. I decided to use Silex as my framework to build the API on due to it being lightweight and easy to implement API's with. The brief was to create a stand-alone API using a given database. The only other requirement was to determine the format of the response by a query parameter of `lang` within the URI and to build with expansion in mind.

### Requirements
---
* PHP 5.3 =<
* [Composer](https://getcomposer.org/)

 
### Installation
---

 * Clone the repo to your local machine
 * `cd` into the root of the directory
 * Run `git remote rm origin` to remove my remote
 * Run `git remote -v` to double check there are no remotes
 * If you want to, remove the `.git` directory (if you don't and then you commit to your own repo then all my git history will also show)
 * Run `git remote add origin git@github.com:username/repo-name.git` to add a new point of origin to your repository. (Please replace `username` & `repo-name` with your own credentials)
 * Add and commit all the files to the `master` branch
 * Run `git push -u origin master` to create the upstream
 
### Setup
---
 * `cd` into the root of the directory
 * run `composer install` to install dependencies
 * update database configuration in `src/Config/Providers.yml`
 
N.B. you can also update debug settings for the app in `src/Config/Config.yml` 

### Usage
---

To use, host the API wherever you want. Create your 3rd party application, and to request the data make a `cURL` request to the API server or run cURL from the command line e.g. 

`curl http://api.com/planets/earth/gases`

More about cURL [here](http://codular.com/curl-with-php) 

#### Response Language
The URI you request via cURL can have an extra query parameter appended to the end of the URI string called `lang`. This can take one of two values:

* `xml`
* `json`

The default response format is `json` if no `lang` parameter is appended. The query string will look like:

`curl http://api.com/planets/earth/gases?lang=xml`

### Available Resources
---

Here is a list of the available resources for the API that can be used to retrieve data:

** PLANETS **

| Method | Resource URI | Description |
| ------ | ------------ | ----------- |
| GET    | /planet/all  | Retrieve data for all planets |
| GET    | /planet/{name}  | Retrieve data for specific planet |
| GET    | /planet/{name}/gases  | Retrieve all gases associated with the planet |
| GET    | /planet/{name}/gases/{formula}  | Retrieve all data for a gas associated with the planet |
| GET    | /planet/{name}/satellites  | Retrieve all satellites associated with the planet |
| GET    | /planet/{name}/satellites/{satellite}  | Retrieve all data for a satellite associated with the planet |
| GET    | /planet/{name}/planet-types  | Retrieve all planet-types associated with the planet |
| GET    | /planet/{name}/planet-types/{type}  | Retrieve all data for a planet-type associated with the planet |

** GASES **

| Method | Resource URI | Description |
| ------ | ------------ | ----------- |
| GET    | /gases/all  | Retrieve data for all gases |
| GET    | /gases/{formula}  | Retrieve data for specific gas |
| GET    | /gases/{formula}/planets  | Retrieve all planets associated with the gas |
| GET    | /gases/{formula}/planets/{name}  | Retrieve all data for a planet associated with the gas |

** SATELLITES **

| Method | Resource URI | Description |
| ------ | ------------ | ----------- |
| GET    | /satellites/all  | Retrieve data for all satellites |
| GET    | /satellites/{satellite}  | Retrieve data for specific satellite |
| GET    | /satellites/{satellite}/planets  | Retrieve all planets associated with the satellite |
| GET    | /satellites/{satellite}/planets/{name}  | Retrieve all data for a planet associated with the satellite |

** PLANET TYPES **

| Method | Resource URI | Description |
| ------ | ------------ | ----------- |
| GET    | /planet-types/all  | Retrieve data for all planet types |
| GET    | /planet-types/{type}  | Retrieve data for specific planet typee |
| GET    | /planet-types/{type}/planets  | Retrieve all planets associated with the planet type |
| GET    | /planet-types/{type}/planets/{name}  | Retrieve all data for a planet associated with the planet type |

 		
### Author
---
 * Tom Burman
 * [http://www.justtom.me](http://www.justtom.me)
 * [@tom_burman](https://twitter.com/tom_burman)