# E-commerce framework Jednicky

## Aktuální balíček

V budoucnu rozdělit tento jeden balíček "Framework" na jednotlivé, např:
```
- Jednicky/Utils
- Jednicky/Warehouse
- Jednicky/Xyz
```
Entity a repozitáře, fasády.. rozdělit také na jednotlivé balíčky (nikoliv do balíčku "Orm"), např.:
```- Jednicky/Order
- Jednicky/Product # základní věci okolo produktu
- Jednicky/ProductAttribute # vše okolo atributů
- Jednicky/Orm # obecný balíček s vlastním EntityManager (pro překlad poděděných entit), obecné filtry, atd.?
```

## Poznámky

### Namespace

Namespace v PHP začíná vždy Jednicky, aby se nepletlo již se zavedeným. Jen v CA se asi používá Jednicky/Datagrid.

Po změně namespace aktualizovat composer.

### Testování

- Spouštět testy! 
- Nette/Tester vs PHPUnit? Zatím máme Nette/Tester.
- PHPStan zatím nemusíme.
- Databázové věci testovat na SQLite?


https://github.com/nette-intellij/intellij-nette-tester

https://github.com/JetBrains/phpstorm-phpstan-plugin
