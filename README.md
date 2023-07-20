<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

Laravel Backend Challenge: Blogging API

Your challenge is to create a RESTful API for a blogging platform using Laravel. This platform should include common features such as user registration, authentication, creating blog posts, comments, and more.

1. Setup:
Install a fresh Laravel instance.
Setup a database of your choice (MySQL, SQLite, etc.).

2. User Management:
Use Laravel's built-in authentication to manage user registration and login.
Endpoints:
Register (POST /api/register)
Login (POST /api/login)
Logout (POST /api/logout)
User Info (GET /api/user)

3. Blog Posts:
A blog post should have: title, content, author (user), and timestamps.
Endpoints:
Create a blog post (POST /api/posts)
Retrieve all blog posts (GET /api/posts)
Retrieve a single blog post (GET /api/posts/{id})
Update a blog post (PUT /api/posts/{id})
Delete a blog post (DELETE /api/posts/{id})

4. Comments:
A comment should be related to a blog post and should have: content, author (user), and timestamps.
Endpoints:
Add a comment to a post (POST /api/posts/{id}/comments)
Retrieve all comments for a post (GET /api/posts/{id}/comments)
Update a comment (PUT /api/comments/{id})
Delete a comment (DELETE /api/comments/{id})
                                                                                                                                                




5. Middleware & Authorization:
Only authenticated users can create, update, or delete blog posts and comments.
Users can only update or delete their own blog posts and comments.
Use Laravel's middleware to enforce these rules.
6. Pagination & Filtering:
Implement pagination for the blog posts and comments endpoints.
Allow filtering blog posts by author or date.

7. Error Handling:
Ensure that the API gracefully handles common errors (e.g., 404 Not Found, 401 Unauthorized) and provides clear error messages to the client.

8. Testing:
Use Laravel's built-in testing tools to write unit and feature tests for your API. Ensure all the endpoints and edge cases are covered.
Bonus:

Implement an endpoint that returns the top N users who have the most blog posts.
Add a tagging system where each blog post can have multiple tags, and users can filter blog posts by tags.
