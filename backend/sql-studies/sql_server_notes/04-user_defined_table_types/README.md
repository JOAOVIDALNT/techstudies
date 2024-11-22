# Chapter 4: User Defined Table Types

User defined table types (UDT) são tipos de dado que permitem que o usuário defina uma estrutura de tabela.
UDT's suportam primary keys, inuque constraints e valores padrão.

## 4.1 - Creating a UDT with a single int column that is also a PK
```sql
    CREATE TYPE dbo.Ids as TABLE
    (
    Id int PRIMARY KEY
    )
```

## 4.2 - Creating a UDT with multiple columns
```sql
    CREATE TYPE MyComplexType as TABLE
    (
    Id int,
    Name varchar(10)
    )
```

## 4.3 - Creating a UDT with a unique constraint
```sql
    CREATE TYPE MyUniqueNamesType as TABLE
    (
    FirstName varchar(10),
    LastName varchar(10),
    UNIQUE (FirstName,LastName)
    )
```

## 4.4 Creating a UDT with a primary key and a column with a default value
```sql
    CREATE TYPE MyUniqueNamesType as TABLE
    (
    FirstName varchar(10),
    LastName varchar(10),
    CreateDate datetime default GETDATE()
    PRIMARY KEY (FirstName,LastName)
    )
```

