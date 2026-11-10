-- Example queries for Exercise 1, to run in phpMyAdmin after importing world.sql.
USE world;

SELECT * FROM countries;

SELECT * FROM cities WHERE country_code = 'JAM';

SELECT DISTINCT language FROM languages WHERE official = 'T' ORDER BY language DESC;

SELECT ci.id, ci.name AS city, ci.country_code, co.name AS country, ci.population
FROM cities ci
JOIN countries co ON ci.country_code = co.code
WHERE ci.population > 6300000;
