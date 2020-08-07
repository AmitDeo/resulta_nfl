# A Drupal 8 module "NFL Manager".

## Requirements

Drupal 8

## How to install? 
1. Place Module inside modules/custom/ folder.
2. Go to /admin/modules. Find the module "NFL Manager" and install it.
3. Create a basic page to show this module.
4. Go to /admin/structure/block and place "NFL Team List block" in content section(most preferable) and under Visibility > Pages tab show only for the page you created in step 3. 

## Features

1. This module consumes the REST API hosted at http://delivery.chalk247.com/team_list/NFL.JSON?api_key=74db8efa2a6db279393b433d97c2bc843f8e32b0 to show the NFL teams in user friendly UI.
2. This module initiate the Block to be used on various regions created by theme.
3. This module uses TableSorter(https://mottie.github.io/tablesorter/) on frontend for sorting, pagination and filtering purpose.

## Limitation

1. The ajax pagination would be efficient if API supported the pagination. 
2. The CSS could be extended to make table user friendly on mobile devices.


## DEMO 

The demo of this plugin could be seen at https://dev-pdeo.pantheonsite.io/nfl-team-list

