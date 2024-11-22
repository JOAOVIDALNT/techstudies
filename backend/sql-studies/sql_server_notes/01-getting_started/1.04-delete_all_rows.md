```sql
DELETE
FROM Helloworlds
```
- This will delete all the data from the table. The table will contain no rows after you run this code. Unlike DROP TABLE, this preserves the table itself and its structure and you can continue to insert new rows into that table

Difference with DELETE operation are several:
1. Truncate operation doesn't store in transaction log file
2. If exists IDENTITY field, this will be reset
3. TRUNCATE can be applied on whole table and no on part of it (instead with DELETE command you can
associate a WHERE clause)

> ## Restrictions Of TRUNCATE
> - Cannot TRUNCATE a table if there is a FOREIGN KEY reference
> - If the table is participated in an INDEXED VIEW
> - If the table is published by using TRANSACTIONAL REPLICATION or MERGE REPLICATION
> - It will not fire any TRIGGER defined in the table

