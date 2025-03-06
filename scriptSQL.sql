INSERT INTO admins VALUES ('danielamrttz@gmail.com', 'Daniela', 'Martínez','dani');
INSERT INTO admins VALUES ('roberttttt@gmail.com', 'Roberto', 'Bañasco','bañat');
INSERT INTO admins VALUES ('franquerooooo@gmail.com', 'Fran', 'Quero','franco');

INSERT INTO `users`(`email`, `password`, `name`, `surname`, `number`, `id_group`) VALUES ('angelito@gmail.com','1234A','Angel','Nuñez',3,2);
INSERT INTO `users`(`email`, `password`, `name`, `surname`, `number`, `id_group`) VALUES ('miguelito@gmail.com','5678M','Miguel','Diaz',2,1);
INSERT INTO `users`(`email`, `password`, `name`, `surname`, `number`, `id_group`) VALUES ('aitoritis@gmail.com','1234Ai','Aitor','Larru',4,3);
INSERT INTO `users`(`email`, `password`, `name`, `surname`, `number`, `id_group`) VALUES ('xuanesito@gmail.com','1234X','WenXuan','Dong',1,1);


INSERT INTO `groups`(`ID`, `start_day`, `last_day`, `id_plans`) VALUES (1,'2025-03-01','2025-03-15',1);
INSERT INTO `groups`(`ID`, `start_day`, `last_day`, `id_plans`) VALUES (2,'2025-05-03','2025-03-05',2);
INSERT INTO `groups`(`ID`, `start_day`, `last_day`, `id_plans`) VALUES (3,'2025-07-09','2025-03-20',3);

INSERT INTO plans VALUES (1, 'Málaga', '{"actividades": ["Moto de agua", "Visitar el casco histórico", "Subida montes de Málaga"]}');
INSERT INTO plans VALUES (2, 'Paris', '{"actividades": ["Un dia en Disney Land Paris","Paseo en el Senna","Visitar torre Eiffel"]}');
INSERT INTO plans VALUES (3, 'Amsterdam', '{"actividades": ["Paseo en bicicleta", "Visitar el barrio rojo", "Tardeo en sexshop"]}');