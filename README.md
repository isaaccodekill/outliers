# Outliers - Asset Management

We make use of an Apache server with a php preprocessor.

Employee Portal: /employee/
HR Portal: /hr/
Management Portal: /management/

## Windows Setup
Please refer to https://www.sitepoint.com/how-to-install-php-on-windows/ for setup and serve asset-mgmt/ as your home directory.

## MacOS Setup
Please refer to https://gist.github.com/dreamsparkx/45fba1a25d6b175283a456b19f935ca3 for setup and serve asset-mgmt/ as your home directory.


## Docker Setup
```
docker-compose up
```

## Problem Statement
The purpose of this system is to allow the employees in an organization to make requests for needed items. An employee can request for office items such as laptop, printer, office furniture, cabinet, AC, Refrigerator etc. The request is forwarded to the Human Resource (HR) department where it is redirected to the manager of the organization who either grants or declines the request. The HR unit keeps track of items that have been assigned to each employee for record purposes and makes it easy to retrieve assets under the custody of an employee when he/she decides to resign.

You are required to design and develop a Web application using HTML, CSS, JavaScript and PHP that meets the objectives of the proposed system. Your application should have a dashboard for the employees to request for office items. They should also be able to view all assets that have been assigned to them. The HR unit should have a dashboard to see all requests that have been made by the employees. The manager should have a dashboard and should be able to approve or decline a request. S/he should be able to see the statuses of all requests that have been made. The HR unit is responsible for managing employees i.e., adding new employees, updating their profile etc.
