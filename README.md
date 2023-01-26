# CRUD WordPress Sample

Simple example of Create, Read, Update and Delete functionality for a custom table in WordPress

## Usage
- Copy crud folder in your child-theme
- In the *crud-main.php* file change SLUG_PAGE
- Create this custom table:
```php
  CREATE TABLE `custom_fruits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `variety` varchar(50) NOT NULL,
  `type` smallint(6) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
 ```
- In your *functions.php* add:
```php
include_once( get_stylesheet_directory() . '/crud/crud-main.php' );
```
- Optional CSS in *style.css*
```css
.frm-detail-fruits label{
  width: 200px;
  display: inline-block;
}
.frm-detail-fruits > div{
  margin-bottom: 20px;
}
.message{
  border: 1px solid grey;
  padding: 10px 20px;
  margin:20px auto 30px;
}
```

## License

[MIT](https://choosealicense.com/licenses/mit/)