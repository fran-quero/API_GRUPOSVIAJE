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

INSERT INTO plans VALUES (1, 'Málaga', 'Visitar el centro histórico / Paseo en moto de agua');
INSERT INTO plans VALUES (2, 'Paris', 'Visitar la Torre Eiffel/ Tres días en DisneyLand Paris');
INSERT INTO plans VALUES (3, 'Amsterdam', 'Visitar el barrio rojo / Paseo en bicicleta');
INSERT INTO plans VALUES (4, 'Roma', 'Conocer al Papa / Visitar el Coliseo Romano');
INSERT INTO plans VALUES (5, 'Maldivas', 'Nadar con tiburones / Noche en una cabaña');