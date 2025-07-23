# Blogify – A Custom CMS Built with PHP, MySQL, and JavaScript

Blogify is a lightweight content management system (CMS) developed using core web technologies: PHP for backend logic, MySQL for data storage, and JavaScript for basic interactivity. This project simulates the foundational structure of a typical CMS and is intended as an educational resource to understand how systems like WordPress work under the hood.

---

## Features

- Admin dashboard for content creation
- Posts stored securely in a MySQL database using PDO
- Server-side rendering of posts on the homepage
- Clean, modular code with reusable components
- Simple routing logic based on URL parameters
- Responsive design for basic mobile support
- Includes JavaScript for improving user experience

---

## Technologies Used

| Layer         | Technology        |
|---------------|-------------------|
| Frontend      | HTML, CSS, JavaScript |
| Backend       | PHP                |
| Database      | MySQL (via phpMyAdmin) |
| Server        | Apache (XAMPP recommended) |

---

## Learning Objectives

This project was built to deepen understanding of:

- Core PHP logic and templating
- Secure MySQL interaction using PDO
- File organization in backend projects
- How CMS platforms are structured internally
- Separation of concerns (backend logic vs presentation)
- Handling HTTP GET parameters for routing
- Basic use of JavaScript in enhancing UI

---

## File Structure
Blogify/
├── index.php # Homepage: displays all blog posts
├── dashboard.php # Admin dashboard entry point
├── create-page.php # Form to create new blog posts
├── includes/
│ └── db.php # Reusable database connection file
├── css/
│ └── style.css # Styling for all pages
