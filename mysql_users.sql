/* MYSQL accounts used by our website.
	*The first one used by the store's owner to work on products table and clients table.
	*The second one used by clients to see products, his/her commands, 
		see each product in one of his/her command, check if he/she is a client,
*/ 
CREATE USER 'store_admin'@'%' IDENTIFIED BY 'admin';
GRANT SELECT, INSERT, UPDATE, DELETE ON `store`.`client` TO 'store_admin'@'%';
GRANT SELECT, INSERT, UPDATE, DELETE ON `store`.`article` TO 'store_admin'@'%';

CREATE USER 'store_client'@'%' IDENTIFIED BY 'client';
GRANT SELECT, INSERT, DELETE ON `store`.`ligne` TO 'store_client'@'%';
GRANT SELECT, INSERT, DELETE ON `store`.`commande` TO 'store_client'@'%';
GRANT SELECT ON `store`.`article` TO 'store_client'@'%';
GRANT SELECT ON `store`.`client` TO 'store_client'@'%';
