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
- Jednicky/Product
- Jednicky/Orm #obecný balíček s vlastním EntityManager (pro překlad poděděných entit), obecné filtry, atd.?
```

## Poznámky

### Namespace

Namespace v PHP začíná vždy Jednicky, aby se nepletlo již se zavedeným. Jen v CA se asi používá Jednicky/Datagrid.

Po změně namespace aktualizovat composer.

### Testování

https://github.com/nette-intellij/intellij-nette-tester

https://github.com/JetBrains/phpstorm-phpstan-plugin
