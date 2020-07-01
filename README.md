# Module Test Sales

    ``test/module-sales``

## Main Functionalities
Sales order grid

- Remove Signifyd Guarantee Status from Admin->Sales (Menu Item) -> Order grid<br>
- Added Column Products which is combintation of "sales_order_item.sku / sales_order_item.name" it can be searched in filter as per sku or name<br>
- Optimize query for Sales Order Grid<br>

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/Test`
 - Enable the module by running `php bin/magento module:enable Test_Sales`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require test/module-sales`
 - enable the module by running `php bin/magento module:enable Test_Sales`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### In my opnion 
- Details of sorting fields,limits can be set via url if required it could be encrypted and later on provided to the query.
- If we are not going to upgrade DB server to Amazon Aurora we can even try for Split database. 
- Split database is not available in Magento C.E but we can develop to implement these feature
- Even if the optimize query does not work as expected and it's having load we can move old orders to other tables and purge it from main database.

### Steps to improve server performance.

### Check Load of the server and DB (Both CPU and RAM). It can be due to following things
  - CPU might getting max
  - Disk I/O is low and Magento is not able to write to disc quickly enough
  - DB may not have enough juice (CPU or RAM)

### HIGH LEVEL
  - if it’s the DB issue, you should look to scale it (have a master and slave DBs to optimize the read/write. Amazon offers it through Aurora.
  - if it’s the server CPU /Ram = upgrade the server or also look to scale it via a load balancer
  - if it’s disk - try getting a solid state drive for higher I/O

### Why Amazon Aurora
  Aurora automatically increases the number of replicas when demand increases during traffic jumps, or on schedule to maintain performance and availability, and decreases capacity during off hours to reduce costs. 




