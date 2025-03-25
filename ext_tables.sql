#
# Modifying table 'pages'
#
CREATE TABLE pages
(
    `location`         text         DEFAULT NULL,
    `location_link`    text         DEFAULT NULL,
    `organizer`        text         DEFAULT NULL,
    `organizer_link`   text         DEFAULT NULL,
    `calendarize`      tinytext     DEFAULT NULL
);
