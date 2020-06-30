# Module Test Sales

    ``test/module-sales``

## Main Functionalities
Sales order grid

1> Remove Signifyd Guarantee Status from Admin->Sales (Menu Item) -> Order grid<br>
2> Added Column Products which is combintation of "sales_order_item.sku / sales_order_item.name" it can be searched in filter as per sku or name<br>
3> Optimize query for Sales Order Grid<br>

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






