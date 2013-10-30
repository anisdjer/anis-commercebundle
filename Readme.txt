1) add in the composer.json

requirements : {
 ... 
 "anisdjer/anis-commercebundle" : "dev-master",
 }
2) run composer update
3) add to the appKernel new Anis\CommerceBundle\AnisComemrceBundle(),
4) add the resource import in the routing 
anis_commerce:
    resource : "@AnisCommerceBundle/Resources/config/routing.yml"
    prefix : /commerce
	
5) run php app/console assets:install
6) configure your database parameters


