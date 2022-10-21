# Property System

This task is to test your knowledge of PHP, MySQL & Javascript, not of HTML or any
frameworks specifically. You are welcome to use any 3rd party libraries.

This is an open-book task - please do feel free to contact us with any questions or queries,
and use the internet to find answers.

### Your Task

Use the following API to populate a database with properties.
http://trialapi.craig.mtcdevserver.com/

1) API Integration
   The following information should be saved from the API into the database.
   * County
   * Country
   * Town
   * Description
   * Full Details URL
   * Displayable Address
   * Image URL
   * Thumbnail URL
   * Latitude
   * Longitude
   * Number of bedrooms
   * Number of bathrooms
   * Price
   * Property Type
   * For Sale / For Rent
    

Your script should update the details in the database if any changes are made to the details of the property in the API.

2) Property Admin Area.
   Create an admin area (no auth required) that would allow adding real estate agents that are in charge of a property. One agent can be in charge of multiple properties. One property can have multiple estate agents, one for conducting viewing and the others for selling.

A real estate agent has to have:
 * Name
 * Contact information (phones, email, address)

The form should contain suitable validation.

3) Create a rest API endpoint to return the list of agents in json with the properties and a total price.

Pls include the agent’s full name, total value of the properties they are in charge of and list of the properties.

| **Agent Name** | **Properties**        | **Total Price** |
|----------------|-----------------------|-----------------|
| John Smith     | PropName1, PropName2, | 5000.00         |
| Ian Smith      | PropName4, PropName5  | 5000.00         |


__Bonus:__

4) Create an API endpoint to return competing agents. A competing agent is an one that has minimum  two properties in common with at least two other agents. The properties in common with the other agents can be different (see example).
   Example:
   
   ```
   Agent 1 (propr1, propr2, propr3)
   Agent 2 (propr2, propr3)
   Agent 3 (propr1, propr 3, propr5)
   Agent 4 (propr3, propr4, propr6)
   Agent 5 (propr1, propr2, propr5)
   Agent 6 (propr4, propr6)
   ```
   
   The endpoint should return
   
    ```
    Agent 1 (two properties in common with agent 2 and two with agent 3)
    Agent 3 (two properties in common with agent 1 and two with agent 5)
    Agent 5 (two properties in common  with agent 1 and two with agent 3) 
    ```


### Solution

```
./vendor/bin/sail up -d
./vendor/bin/sail php artisan migrate
```

You can optionally run `alias sail='bash vendor/bin/sail'` to avoid using `./vendor/bin/sail` every time.

To install composer packages:

```
./vendor/bin/sail composer install
```

To build the front end assets, you can either run

```
./vendor/bin/sail npm run dev
```

which will keep the process running and watching for any changes, or alternatively:

```
./vendor/bin/sail npm run build
```

which will run as a one off.

To run tests, run:

```
./vendor/bin/sail phpunit
```

1) Properties are imported using a Command class. Run:

```
./vendor/bin/sail php artisan properties:sync
```

2) http://localhost:8086/

3) http://localhost:8086/api/agents

4) http://localhost:8086/api/competing-agents

The initial version above uses php and collections to generate the results, but there is 
another endpoint available at http://localhost:8086/api/competing-agents/query
which uses a cte to generate the results.

See https://www.db-fiddle.com/f/7vzcbFTUZiNi22mxsagybB/0
