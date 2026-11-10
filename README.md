# INFO2180 Lab 5

This is Lab 5 for Caudillo Jones on PHP and MySQL.

## About

A country and city lookup application built with PHP, MySQL, HTML, CSS and JavaScript. It makes asynchronous requests to `world.php` and displays matching results in tables.

## Features

- Search for countries by their full or partial name.
- Leave the search box empty to see all countries.
- Display country name, continent, independence year, and head of state.
- Look up the cities in matching countries and display city name, district, and population.

## Running locally

1. Install XAMPP and start **Apache** and **MySQL**.
2. Put this `info2180-lab5` folder inside `C:\xampp\htdocs`.
3. Download the lecturer's full `world.sql` starter database with `get-world-sql.ps1` or from the official GitHub URL below. **Warning:** the supplied SQL file drops and re-creates any existing `world` database.
4. In `http://localhost/phpmyadmin/`, use **Import** to import `world.sql`.
5. Run `database-user.sql` on the SQL tab in phpMyAdmin. The app uses the local lab account `lab5_user` with password `password123`.
6. Open `http://localhost/info2180-lab5/index.html` in your browser.

Official database source: https://raw.githubusercontent.com/uwi-info2180/info2180-lab5/master/world.sql

For the full terminal and GitHub steps, see `SUBMISSION_GUIDE.txt` in the downloadable package.
