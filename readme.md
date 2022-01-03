# E-commerce framework Jednicky

### Aktuální balíček

V budoucnu rozdělit tento jeden balíček "Framework" na jednotlivé, např:
- Jednicky/Utils
- Jednicky/Warehouse
- Jednicky/Xyz

Entity a repozitáře, fasády.. rozdělit také na jednotlivé balíčky (nikoliv do balíčku "Orm"), např.:
- Jednicky/Order
- Jednicky/Product
- Jednicky/Orm #obecný balíček s vlastním EntityManager (pro překlad poděděných entit), obecné filtry, atd.?

### Poznámky

Po změně namespace aktualizovat composer.

https://github.com/nette-intellij/intellij-nette-tester

https://github.com/JetBrains/phpstorm-phpstan-plugin
