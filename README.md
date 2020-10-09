# Find beer and food to pair it
Filtered beers by food pairing.Get a simplified json view from  [PUNK API](https://punkapi.com/)
## How to install?

- *download the repository*
- *composer install*
- *create your own .env file with your config*


## Endpoints
 *We have two endpoints*
### Get Beers

Get the list of `beers`. 

**`GET` `/api/v1/beers`**

Query Params:

- **`food `**: Filter beers by food pairing (use underscore '_' to add spaces).

Response:

```json
{
    "results": [
            {
                "id": 1,
                "name": "Beer 1",
                "description": "Beer one description"
            },
            {
                "id": 2,
                "name": "Beer 2",
                "description": "Beer two description"
            }
            ... 
     ]
}
```

### Get Beers Extended

Get a list of `beers` with `extended` details. 

**`GET` `/api/v1/beers/extended`**

Query Params:

- **`food `**: Filter beers by food pairing (use underscore '_' to add spaces).

Response:

```json
{
    "results": [
            {
                "id": 1,
                "name": "Beer 1",
                "description": "Beer one description",
                "image": "https://images.punkapi.com/1",
                "slogan": "Beer slogan",
                "first_brewed": "01/2012"
            },
            {
                "id": 2,
                "name": "Beer 2",
                "description": "Beer two description",
                "image": "https://images.punkapi.com/2",
                "slogan": "Beer slogan",
                "first_brewed": "01/2011"
            }
            ... 
     ]
}
```

## How to test?

- *create your own .env.test file with your config*
- *create your own .phpunit.xml.dist file with your config*
- *in your proyect folder, launch php bin/phpunit in terminal to install tests dependencies*
- *launch again php bin/phpunit to test it*