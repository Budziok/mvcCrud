CREATE TABLE `users` ( 
 `id` int(11) NOT NULL AUTO_INCREMENT, 
 `name` varchar(45) DEFAULT NULL, 
 `email` varchar(255) DEFAULT NULL, 
 `password` varchar(60) DEFAULT NULL, 
 PRIMARY KEY (`id`) 
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8; 

CREATE TABLE `ads` ( 
 `id` int(11) NOT NULL AUTO_INCREMENT, 
 `title` varchar(255) DEFAULT NULL, 
 `content` mediumtext, 
 `create_date` datetime DEFAULT CURRENT_TIMESTAMP, 
 `user_id` int(11) DEFAULT NULL, 
 PRIMARY KEY (`id`) 
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;