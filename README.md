## Project Proposal: Price-Tracker Web-Based System

---

**Team Members: Joshua Farwig and Mackenzie Kudrenecky**  

### Project Description:

For our project, we will be creating a web-based system that will track price drops from an e-commerce stores. We are contemplating on scraping price data from grocery stores (save-on-foods), second-hand e-commerce services (facebook marketplace), or eletronic e-commerce stores (newegg). Despite the difference in product content, all functionalities will be the same.  

[**Reference Website:](https://camelcamelcamel.com) Camel Camel Camel**

[**Reference Website:](https://grocerytracker.ca) Grocery Tracker** 

### Languages:

**Client Side:**  

- HTML, CSS, JavaScript, React.JS

**Server Side:** 

- LAMP Stack (Linus, Apache, MySql, PHP)

### Project Frameworks:

**React.JS**

- Can improve client-side time efficiency in query based page reloads

**Boostrap.CSS**

- Will aid in CSS layout for dynamic web-pages

### User Requirements:

*User functionalities are aggregated top-down (User inherits non-user functionality, Admin inherits user and non-user functionality)*

- Non-user functionalities
    - Set stores and their respective locations
    - Search for items with search bar query
    - View “Hot” products (biggest price-drop or most-commented on)
    - Filter options for product search
- User functionalities
    - Register account with unique username, password, personal image, and email
    - Password recovery (via email)
    - View / edit profile
    - View product details: description, comments, price history, image, external URL to actual product page on store, etc.
    - Comment / rating on product detail
    - User Saved product page with graphs of price history
        - Email alerts for item price-drops with user set price parameters
        - Product price comparison between different stores
    - Hot Item Tab: products with most comments and largest price-drops
- Admin functionalities
    - Search and filter for user info by username or email
        - User activity
        - Saved Products List
        - Products commented on
    - Be able to delete / create users
    - Be able to delete / create comments
