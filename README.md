# Neto Tech LTD | Take home PHP test

Hello and thank you for taking the time to do this test. Please don't let all the text below scare you,
we added many descriptive details so you can finish this test within a reasonable amount of time.

During this test we want to see what you're capable of by demonstrating the following:
1. Create a simple database structure | ~ 1-2 hours
2. Populate the database with fake data | ~ 4-10 hours
3. Create a couple of API endpoints | ~ 2-4 hours
4. Optional stuff to impress us | ~ 1-3 hours

**Finished?**

Please push the project to a public Git repository and mail the URL to `simo.jakovic@iplayplatform.com`.
Send Postman collection with all routes from assignment.

**Questions?**

We left a few tips at the bottom of this document, this might help you. If the tips are not of any help, please send over your question(s) to `simo.jakovic@iplayplatform.com` and we'll try to reply ASAP.

![Alt Text](https://media3.giphy.com/media/3oeSAz6FqXCKuNFX6o/giphy.gif?cid=ecf05e4705jxwmp125egx2mqtl9vt6rm2ezmontqbsa7repd&rid=giphy.gif&ct=g)

## The assignment

We are going to build a simplified CMS that has the following:
- 2 database models (post, comment)
- a fixed amount of posts, and each post has a bunch of comments.
- a few API endpoints for GETTING, CREATING, and DELETING records.

**The following technical requirements are mandatory:**

- PHP 8
- Framework - Choose any that you want or no framework. We prefer Symfony or Laravel
- Composer 2
- MySQL 5.7

## 1. Database models

Please create the following models and tables

### 1.1 Post

- `id` (int, pk)
- `topic` (string, unique)
- `created_at` (timestamp)
- `updated_at` (timestamp)

### 1.2 Comment

- `id` (int, pk)
- `post_id` (int, foreign key: posts)
- `content` (string)
- `abbreviation` (string, unique)
- `created_at` (timestamp)
- `updated_at` (timestamp)

## 2 Fake data

Both tables have to be populated with fake data. It's up to you to decide how or where this should be done.

### 2.1 Fake posts

Populate the `posts` table with 5 unique records, you can pick your own topics.

### 2.2 Fake comments

Populate the `comments` table with **8191** records. This number might seem oddly specific but you should be able to figure this out ;)

Every record in this table has the following fields:
- `post_id` | random ID of an existing post
- `content` | string of words (generated using the random words we provided for you)
- `abbreviation` | short (unique) version of the content

**How to generate the fake content**

Use the variable `$words` to generate a list of all the possible combinations (`content` column)

```php
$words = "Cool,Strange,Funny,Laughing,Nice,Awesome,Great,Horrible,Beautiful,PHP,Vegeta,Italy,Joost"
```

When using the first 3 words, `cool, strange, funny` you can create the following **7** combinations:

```html
1. cool
2. cool funny
3. cool strange
4. funny
5. strange
6. strange cool funny
7. strange funny
```

- Using the first 2 words, you would be able to generate 3 combinations
- Using the first 5 words, you would be able to generate 31 combinations
- Using the first 8 words, you would be able to generate 255 combinations
- Using the first 11 words, you would be able to generate 2047 combinations
- .......

The list of unique combinations has the following requirements:

- Empty strings are not allowed
- Words are always lower cased
- Every possible combination has to be generated
- Words may only be used once in a combination
- The order of the words does NOT matter
- A different order does NOT make the combination unique
- - `cool strange` &`strange cool` are considered **duplicates**.

**How to generate the abbreviation of the content**

Every comment record also has an `abbreviation`. The abbreviation is not generated randomly but is based on the content. Use the example below to figure out how abbreviations are created.

|content  | abbreviation |
|:------- |:------------- |
|alfa                | a |
|bravo               | b | 
|bravo alfa          | ab | 
|charlie             | c |
|alfa charlie        | ac |
|bravo charlie       | bc |
|alfa bravo charlie  | abc |

Now that you have a list of all the possible combinations, populate the `comments` table by inserting them.

Random tip: `Please consider that the MySQL server also has "feelings".`

## 3. API endpoints

### 3.1  Basic requirements

These requirements apply to every GET endpoint

- Default limit is set to 10
- Every response is returned in the following format

 ```javascript
{
    "result": [], // the matching records
    "count": 324 // the total count*    
}
// * total count is applied before the limit/pagination
```

### 3.1.1 Pagination & limitting

- Default page is 1
- If no limit is sent, use the default limit of 10

###### Pagination examples

- `endpoint?page=1&limit=5` returns the first 5 records
- `endpoint?page=2&limit=5` returns the first 5 records (after skipping the first 5)

### 3.1.2 Filtering

- Every fillable field (+ ID & timestamps) are filterable
- ID filter is exact, the rest is partial
- Multiple fields are filterable at the same time

###### Filtering examples

- `endpoint?id=1` returns record with ID 1
- `endpoint?foo=bar` returns record(s) where foo = bar
- `endpoint?foo=bar&bar=foo` returns record(s) where foo = bar AND bar = foo

### 3.1.3 Sorting

- Every fillable field (+ ID & timestamps) are sortable
- Only one field is sortable at the same time
- The direction can be adjusted using `?direction=asc|desc`
- Default direction is `asc`

###### Sorting examples

- `endpoint?sort=field` sorts by field, ascending (default)
- `endpoint?sort=field&direction=desc` sorts by field, descending

### 3.1.3 Including relational data

- Every relation of a model can be included in the JSON response
- Optional: only relations that exist can be included (to avoid exceptions)

###### Include relation example

- `comments?with=post` includes the post relation of the comment record

### 3.3 GET `/posts`
Returns posts
- `?comment=laughing` returns posts that have one or multiple comments that contain the word `laughing` (partial match, content field)

### 3.4 DELETE `/posts/{id}` (optional!)
This endpoint is optional and open for interpretation

### 3.3 GET `/comments`
Returns comments

### 3.4 DELETE `/comments/{id}`
Delete a comment by passing an ID.
- returns `true` if the comment was deleted
- returns an error if the comment does not exist

### 3.5 CREATE `/comments` (optional!)
This endpoint is optional and open for interpretation

## Things that we :heart:

- Automated tests
- Latest PHP features
- Performance (waiting more than 3 seconds for test data to be inserted is not fun)
- Readability
- Reusability
- Useful comments
- Happy surprises

## Tips
- Writing an algorithm to create a list of unique combinations from a given set of words is fun, but can take a lof of time. No need to reinvent the wheel.
