anis-commercebundle
===================


1) Installing the Standard Edition
----------------------------------
1) add in the composer.json

### Use Composer (*recommended*)

requirements : {
 ... 
 "anisdjer/anis-commercebundle" : "dev-master",
 }
### run 
--------
    composer update
### AppKernel
Add to the appKernel
-
    new Anis\CommerceBundle\AnisComemrceBundle(),
### add the resource import in the routing 
    anis_commerce:
        resource : "@AnisCommerceBundle/Resources/config/routing.yml"
        prefix : /commerce
	
### run 
    php app/console assets:install
### configure your database parameters