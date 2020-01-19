CREATE TABLE login (
  id bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  login_id varchar(255) unique NOT NULL,
  password varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;